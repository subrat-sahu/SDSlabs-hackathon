var express = require('express');
var router = express.Router();
var Complaint = require('../models/complaints');


router.get('/complaint',ensureAuthenticated, function(req, res){
	res.render('complaint');
});
router.get('/api/photo', function(req, res){
	res.render('try');
});


// Get Homepage
router.get('/', ensureAuthenticated, function(req, res){
	Complaint.find({'details.id':req.user._id},function(err,docs){
		res.render("index", {
	     "data" : docs
	});
		});
});
router.get('/users/update/profile',function(req,res,next){
  res.render('updateProfile');
});
router.get('/admins/dash',ensureAuthenticated2,function(req,res){

   Complaint.find({compType:req.user.compType},function(err,docs){
	 res.render("dashboard", {
     "entries" : docs,
		 "len":docs.length
});
	});
});



function ensureAuthenticated(req, res, next){
	if(req.isAuthenticated() ){
		return next();
	} else {
		//req.flash('error_msg','You are not logged in');
		res.redirect('/users/login');
	}
}
function ensureAuthenticated2(req, res, next){
	if(req.isAuthenticated() && req.user.isAdmin){
		return next();
	} else {
		res.render('404');
	}
}



module.exports = router;
