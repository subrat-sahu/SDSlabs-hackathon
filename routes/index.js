var express = require('express');
var router = express.Router();
var Complaint = require('../models/complaints');


router.get('/complaint',ensureAuthenticated, function(req, res){
	res.render('complaint');
});
router.get('/api/photo', function(req, res){
	res.render('try');
});
router.post('/admins/delete',function(req,res){
     var id = req.body.complid;
     Complaint.remove({_id:id},function(err,docs){
			 if(err) throw err


			 console.log(id);
			 res.redirect('/admins/dash');
		 });
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
	if(req.user)
{	if(req.isAuthenticated() && (req.user.isAdmin)){
	 res.redirect('/admins/dash');
	}
  else if(!req.user.isAdmin && req.isAuthenticated()){
   next();
	 }
	else {
		res.redirect('/users/login');
	}}
	else{
		if(req.isAuthenticated()){
			next()
		}
		else{
			res.redirect('/users/login');
		}
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
