var mongoose = require('mongoose');

var ComplaintSchema = mongoose.Schema(
	{complaint:String,compType:String,dateTime:String,compType:String,details:{
		username:String,
		enrollment:String,
		room: String,
		id: String
	}}

);

var Complaint = module.exports = mongoose.model('Complaint', ComplaintSchema);

module.exports.getcomplaints = function (req,res) {
  var dat; Complaint.find({},function(err,data){
		  res.locals.data = data || null;
	 });
};

module.exports.getComplaintByUser = function(username, callback){
	var query = {username: username};
	Complaint.findOne(query, callback);
}

module.exports.getComplaintById = function(id, callback){
	Complaint.findById(id, callback);
}
