var mongoose = require('mongoose');
var bcrypt = require('bcryptjs');

// User Schema
var UserSchema = mongoose.Schema({
	username: {
		type: String,
		index:true

	},
	password: {
		type: String
	},
	enrollment: {
		type: String,
		unique:true
	},
	room: {
		type: String,
		unique:true
		},
	email: {
		type: String,
		unique:true
	},
	name: {
		type: String
	},
	complaints:[{complaint:String,dateTime:String,compType:String,details:{
		username:String,
		enrollment:String,
		room: String,
		id: String
	}}]
});

var User = module.exports = mongoose.model('User', UserSchema);

module.exports.createUser = function(newUser, callback){
	bcrypt.genSalt(10, function(err, salt) {
	    bcrypt.hash(newUser.password, salt, function(err, hash) {
	        newUser.password = hash;
	        newUser.save(callback);
	    });
	});
}

module.exports.getUserByUsername = function(username, callback){
	var query = {username: username};
	User.findOne(query, callback);
}

module.exports.getUserById = function(id, callback){
	User.findById(id, callback);
}

module.exports.comparePassword = function(candidatePassword, hash, callback){
	bcrypt.compare(candidatePassword, hash, function(err, isMatch) {
    	if(err) throw err;
    	callback(null, isMatch);
	});
}
module.exports.addComplaint= function (compl, callback)
{
User.findOneAndUpdate({_id :compl.details.id }, {$push: {complaints: compl}},{returnOriginal: false, upsert: true},callback)
};
