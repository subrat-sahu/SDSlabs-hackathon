var express = require('express');
var router = express.Router();
var passport = require('passport');
var LocalStrategy = require('passport-local').Strategy;
var isadmin=false;
var usr;
var User = require('../models/user');
var Admin = require('../models/admin');

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

	req.checkBody('name', 'Name is required').notEmpty();
	req.checkBody('email', 'Email is required').notEmpty();
	req.checkBody('email', 'Email is not valid').isEmail();
	req.checkBody('room', 'room is required').notEmpty();
	req.checkBody('password', 'enrollment is required').notEmpty();
	req.checkBody('enrollment', 'Username is required').notEmpty();
	req.checkBody('password', 'Password is required').notEmpty();
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
			username: username,
			password: password,
			room: room,
			enrollment: enrollment,
			complaints: []
		});


		User.createUser(newUser, function(err, user){
			if(err) throw err;
			console.log(user);
		});

		req.flash('success_msg', 'You are registered and can now login');

		res.redirect('/users/login');
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
  done(null, user.id);
isadmin = user.isAdmin;
});

passport.deserializeUser(function(id, done) {
	if(isadmin){
		Admin.getAdminById(id, function(err, user) {
			done(err, user);
		});}else{
			User.getUserById(id, function(err, user) {
				done(err, user);
				usr = user;
		});
	};
});
//router.get('/addfriend', User.addComplaint);

router.post('/register/complaint', function(req, res){
	var nameC = req.user.username;
	var roomC = req.user.room;
	var enrollmentC = req.user.enrollment;
	var usernameC = req.body.username;
	var dateTimeC = req.body.password;
  var compC =req.body.comp;
	var idC = req.user._id;
	var compType = req.body.compType;

	var complaint = {complaint:compC,dateTime:Date(),details:{
		username:nameC,
		enrollment:enrollmentC,
		room: roomC,
		id : idC,
		compType: compType
	}};
/*	console.log(req.user._id);
	User.findByIdAndUpdate(
    req.user._id,
    {$push: {"complaints": complaint}},
    {safe: true, upsert: true},
    function(err, model) {
        console.log(err);
    }
);*/
User.addComplaint(complaint, function(err, doc) {
	if(err) throw err;
	console.log(doc);
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



module.exports = router;