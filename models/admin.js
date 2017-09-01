var mongoose = require('mongoose');
var bcrypt = require('bcryptjs');

var AdminSchema = mongoose.Schema({
	username: {
		type: String,
		index:true,
		unique:true

	},
	password: {
		type: String
	},
complaints:[],
isAdmin: {
	type: Boolean
}
});

var Admin = module.exports = mongoose.model('Admin', AdminSchema);

module.exports.createAdmin = function(newUser, callback){
	bcrypt.genSalt(10, function(err, salt) {
	    bcrypt.hash(newUser.password, salt, function(err, hash) {
	        newUser.password = hash;
	        newUser.save(callback);
	    });
	});
}


module.exports.getAdmin = function(username, callback){
	var query = {username: username};
	Admin.findOne(query, callback);
}

module.exports.getAdminById = function(id, callback){
	Admin.findById(id, callback);
}

module.exports.comparePassword = function(candidatePassword, hash, callback){
	bcrypt.compare(candidatePassword, hash, function(err, isMatch) {
    	if(err) throw err;
    	callback(null, isMatch);
	});
}
