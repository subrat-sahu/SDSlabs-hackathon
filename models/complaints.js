var mongoose = require('mongoose');

var ComplaintSchema = mongoose.Schema({
	complaint: {
		type: String,
		index:true

	},
	username: {
		type: String
	},
  enrollment:{
    type: String
  },
  date:{
    type: String
  },
  room:{
    type:String
  },
  status:{
    type:Boolean
  }

});

var Complaint = module.exports = mongoose.model('Complaint', ComplaintSchema);

module.exports.createComplaint = function(newComplaint, callback){
	bcrypt.genSalt(10, function(err, salt) {
	    bcrypt.hash(newUser.password, salt, function(err, hash) {
	        newUser.password = hash;
	        newUser.save(callback);
	    });
	});
}


module.exports.getComplaintByUser = function(username, callback){
	var query = {username: username};
	Complaint.findOne(query, callback);
}

module.exports.getComplaintById = function(id, callback){
	Complaint.findById(id, callback);
}
