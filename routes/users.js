var express = require('express');
var router = express.Router();
var app = express();
var passport = require('passport');
var LocalStrategy = require('passport-local').Strategy;
var isadmin=false;
var User = require('../models/user');
var Admin = require('../models/admin');
var Complaint = require('../models/complaints');
var asynC = require('async');
var crypto = require('crypto');
var nodemailer = require('nodemailer');
var bcrypt = require('bcryptjs');

// Register
router.get('/register', function(req, res){
	res.render('register');
});

// Login
router.get('/login', function(req, res){
	res.render('login');
});


//router.get('/add',ensureAuthenticated, user.addComplaint);

// Register User
router.post('/register', function(req, res){
	var name = req.body.name;
	var room = req.body.room;
	var enrollment = req.body.enrollment;
	var email = req.body.email;
	var username = req.body.username;
	var password = req.body.password;
	var password2 = req.body.password2;
	var phone = req.body.phone;

	req.checkBody('email', 'Email is required').notEmpty();
	req.checkBody('email', 'Email is not valid').isEmail();
	req.checkBody('phone','Phone Not Provided').notEmpty();
	req.checkBody('phone','Phone Not Valid').isMobilePhone("en-IN");
	req.checkBody('room', 'room is required').notEmpty();
	req.checkBody('enrollment', 'enrollment is required').notEmpty();
	req.checkBody('enrollment', 'Username is required').notEmpty();
	req.checkBody('password', 'Password should be Minimum 8 charachters').isLength({ min: 8 });
	req.checkBody('password2', 'Password should be Minimum 8 charachters').isLength({ min: 8 });
	req.checkBody('password2', 'Passwords do not match').equals(req.body.password);



	var errors = req.validationErrors();

	if(errors){
		res.render('register',{
			errors:errors
		});
	} else {
		var newUser = new User({
			name: name,
			email:email,
			userType:"user",
			username: username,
			password: password,
			room: room,
			phone:phone,
			enrollment: enrollment,
			complaints: []
		});


		User.createUser(newUser, function(err, user){

			if (err) {
      if (err.name === 'MongoError' && err.code === 11000) {
        // Duplicate username
        return res.status(500).send({ succes: false, message: 'User already exist!' });
      }
			else throw err;

      // Some other error
      return res.status(500).send(err);


    res.json({
      success: true
    });
}

		req.flash('success_msg', 'You are registered and can now login');

		res.redirect('/users/login');

});
}
});

passport.use('userStrategy',new LocalStrategy(
  function(username, password, done) {
   User.getUserByUsername(username, function(err, user){
   	if(err) throw err;
   	if(!user){
   		return done(null, false, {message: 'Unknown User'});
   	}

	User.comparePassword(password, user.password, function(err, isMatch){
   		if(err) throw err;
   		if(isMatch){
   			return done(null, user);
   		} else {
   			return done(null, false, {message: 'Invalid password'});
   		}
   	});
   });
  }));

  passport.use('adminStrategy',new LocalStrategy(
	  function(username, password, done) {
	   Admin.getAdmin(username, function(err, user){
	   	if(err) throw err;
	   	if(!user){
	   		return done(null, false, {message: 'Unknown Admin'});
	   	}

	   	Admin.comparePassword(password, user.password, function(err, isMatch){
	   		if(err) throw err;
	   		if(isMatch){
	   			return done(null, user);
	   		} else {
	   			return done(null, false, {message: 'Invalid password'});
	   		}
	   	});
	   });
	  }));


passport.serializeUser(function(user, done) {
	var key = {
    id: user.id,
    type: user.userType
  }

done(null, key);
isadmin = user.isAdmin;
});

passport.deserializeUser(function(key, done) {

	var Model = key.type === 'user' ? User : Admin;
Model.findOne({
_id: key.id
}, '-salt -password', function(err, user) {
done(err, user);
}
)});

//router.get('/addfriend', User.addComplaint);
router.post('/newdata',function(req,res){
  var usernameNew = req.body.username;
	var roomNew = req.body.room;
	var phoneNew = parseInt(req.body.phone);
  console.log(req.user.phone);
  User.findOneAndUpdate({_id:req.user._id},   { $set:
      {
      "username":usernameNew,
			"room":roomNew,
			"phone":phoneNew
      }
   },function(err,docs){
		 if(err) throw err;
  console.log("chala");
	res.redirect('/users/update/profile');
});

});

router.post('/update/password',function(req,res){
var currpass = req.body.curpassword;
var newpass = req.body.newpassword;
var newpass2 = req.body.confpassword;


req.checkBody('curpassword', 'Password is required').notEmpty();
req.checkBody('newpassword', 'Email is not valid').notEmpty();
req.checkBody('confpassword','Phone Not Provided').notEmpty();
req.checkBody('confpassword', 'confirm is required').equals(req.body.newpassword);

User.getUserById(req.user.id,function(err,user){
  User.comparePassword(currpass,user.password,function(err,res){


	});

});
});

//------------------------------------------------------

router.post('/forgot', function(req, res, next) {
  asynC.waterfall([
    function(done) {
      crypto.randomBytes(20, function(err, buf) {
        var token = buf.toString('hex');
        done(err, token);
      });
    },
    function(token, done) {
      User.findOne({ email: req.body.email }, function(err, user) {
        if (!user) {
          req.flash('error', 'No account with that email address exists.');
          return res.redirect('/forgot');
        }

        user.resetPasswordToken = token;
        user.resetPasswordExpires = Date.now() + 3600000; // 1 hour

        user.save(function(err) {
          done(err, token, user);
        });
      });
    },
    function(token, user, done) {
      var smtpTransport = nodemailer.createTransport({
        service: 'SendGrid',
        auth: {
          user: 'subr47',
          pass: '1234qwer'
        }
      });
      var mailOptions = {
        to: user.email,
        from: 'Noreply@noreply.noreply',
        subject: 'BCRS Password Reset',
        text: 'You are receiving this because you (or someone else) have requested the reset of the password for your account.\n\n' +
          'Please click on the following link, or paste this into your browser to complete the process:\n\n' +
          'http://' + req.headers.host + '/users/reset/' + token + '\n\n' +
          'If you did not request this, please ignore this email and your password will remain unchanged.\n'
      };
      smtpTransport.sendMail(mailOptions, function(err) {
        res.flash('success_msg', 'An e-mail has been sent to ' + user.email + ' with further instructions.');
        done(err, 'done');
      });
    }
  ], function(err) {
    if (err) return next(err);
    res.redirect('/users/forgot');
  });
});

router.get('/reset/:token', function(req, res) {
  User.findOne({ resetPasswordToken: req.params.token, resetPasswordExpires: { $gt: Date.now() } }, function(err, user) {
    if (!user) {
      req.flash('error_msg', 'Password reset token is invalid or has expired.');
      return res.redirect('/users/forgot');
    }
    res.render('reset', {
      user: req.user
    });
  });
});





//-------------------------------------------------------
router.get('/forgot',function(req,res){
	res.render('forgot');
});
//--------------------------------------------------------
//--------------------------------------------------------

router.post('/reset/:token', function(req, res) {
  asynC.waterfall([
    function(done) {
      User.findOne({ resetPasswordToken: req.params.token, resetPasswordExpires: { $gt: Date.now() } }, function(err, user) {
        if (!user) {
          req.flash('erro_msg', 'Password reset token is invalid or has expired.');
          return res.redirect('back');
        }

        user.password = req.body.password;
        user.resetPasswordToken = undefined;
        user.resetPasswordExpires = undefined;

				bcrypt.genSalt(10, function(err, salt) {
						bcrypt.hash(user.password, salt, function(err, hash) {
								user.password = hash;
								user.save(function(err) {
				          req.logIn(user, function(err) {
				            done(err, user);
				          });
				        });
						});
				});
      });
    },
    function(user, done) {
      var smtpTransport = nodemailer.createTransport({
        service: 'SendGrid',
        auth: {
          user: 'subr47',
          pass: '1234qwer'
        }
      });
      var mailOptions = {
        to: user.email,
        from: 'noreply@noreply.noreply',
        subject: 'Your password has been changed',
        text: 'Hello,\n\n' +
          'This is a confirmation that the password for your account ' + user.email + ' has just been changed.\n'
      };
      smtpTransport.sendMail(mailOptions, function(err) {
        req.flash('success_msg', 'Success! Your password has been changed.');
        done(err);
      });
    }
  ], function(err) {
    res.logout();
  });
});


//---------------------------------------------------------
//---------------------------------------------------------







router.post('/change',function(req,res){
var completeduser = req.body.check;
 Complaint.update({_id:req.body.complid},{$set:{"completedUser":completeduser}},{new: true},function(err,docs){
if(err) throw err,
console.log(docs);
  res.redirect('/');
});
});

router.post('/register/complaint', function(req, res){
	var nameC = req.user.username;
	var roomC = req.user.room;
	var enrollmentC = req.user.enrollment;
	var usernameC = req.body.username;
	var dateTimeC = req.body.password;
  var compC =req.body.comp;
	var idC = req.user._id;
	var compType = req.body.compType;
	//console.log(compType   +  " compType");
  var d =new Date();
	var complaint = {complaint:compC,
		completedUser:false,
		completedAdmin:false,
		complaintId:"RandomShit",
		compType: compType,
		dateTime:d.getTime(),
		details:{
			username:nameC,
			enrollment:enrollmentC,
			room: roomC,
			id : idC,}};
	var myData = new Complaint(complaint);

	complaint.complaintId=myData._id;
	myData.save()
		.then(item => {
			console.log('done');
			req.flash('success_msg','complaint logged succesfully');
		})
		.catch(err => {
		console.log('error');
		});
		console.log(req.user.id);




User.addComplaint(complaint, function(err, doc) {
	if(err) throw err;
	res.redirect('/');
});
});









router.post('/login',
  passport.authenticate('userStrategy', {successRedirect:'/', failureRedirect:'/users/login',failureFlash: true}),
  function(req, res) {
    res.redirect('/');
  });

router.get('/logout', function(req, res){
	req.logout();

	req.flash('success_msg', 'You are logged out');
if(!isadmin)
{	res.redirect('/users/login');}
else
	{res.redirect('/admins/signin');}
});
//===========================================================================--=-=-=-=-=-=-=-=-=-



module.exports = router;
