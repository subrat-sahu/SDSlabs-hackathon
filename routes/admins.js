var express = require('express');
var router = express.Router();
var passport = require('passport');
var LocalStrategy = require('passport-local').Strategy;

var Admin = require('../models/admin');


router.get('/signin',function(req,res){
	res.render('signin');
});
router.get('/signup',function(req,res){
	res.render('signup');
});

router.post('/signup', function(req, res){
	var name = req.body.name;
	var username = req.body.username;
	var password = req.body.password;
	var password2 = req.body.password2;
	console.log('name');

	req.checkBody('name', 'Name is required').notEmpty();
	req.checkBody('username', 'username is required').notEmpty();
	req.checkBody('password', 'Password is required').notEmpty();
	req.checkBody('password2', 'Passwords do not match').equals(req.body.password);



	var errors = req.validationErrors();

	if(errors){
		res.render('signup',{
			errors:errors
		});
	} else {
		var newAdmin = new Admin({
			username: username,
			password: password,
			isAdmin: true,
			complaints: []
		});

		Admin.createAdmin(newAdmin, function(err, user){
			if(err) throw err;
			console.log(user);
		});

		req.flash('success_msg', 'signup complete and can now login');

		res.redirect('/admins/signin');
	}
});

router.post('/signin',
  passport.authenticate('adminStrategy', {successRedirect:'/admins/dash', failureRedirect:'/admins/signin',failureFlash: true}),
  function(req, res) {
    res.redirect('/admins/dash');
  });

router.get('/logout', function(req, res){
	req.logout();

	req.flash('success_msg', 'You are logged out');

	res.redirect('/admins/signin');
});

module.exports = router;
