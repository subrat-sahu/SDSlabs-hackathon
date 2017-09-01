var express = require('express');
var router = express.Router();
var Complaint = require('../models/complaints');

// Get Homepage
router.get('/', ensureAuthenticated, function(req, res){
	res.render('index');
});
router.get('/admins/dash',ensureAuthenticated2,function(req,res){

	console.log("  f   f f f f f ");
Complaint.find({},function(err,docs){
	res.render("dashboard", {
     "entries" : docs
});
	});
});
router.get('/complaint',ensureAuthenticated, function(req, res){
	res.render('complaint');
});

router.get('/man', ensureAuthenticated2,function(req,res){

	res.send("hello");
});

function ensureAuthenticated(req, res, next){
	if(req.isAuthenticated()){
		return next();
	} else {
		//req.flash('error_msg','You are not logged in');
		res.redirect('/users/login');
	}
}
function ensureAuthenticated2(req, res, next){
	if(req.isAuthenticated()){
		return next();
	} else {
		res.render('404');
	}
}



module.exports = router;
