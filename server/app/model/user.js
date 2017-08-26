// load the things we need
var mongoose = require('mongoose');
var bcrypt   = require('bcrypt-nodejs');


// define the schema for our user model
var userSchema = mongoose.Schema({
  username: {
        type: String,
        unique: true,
        required: true
    },
  password: {
        type: String,
        required: true
    },
  email: String,
  lastName: String
});


// methods ======================
// generating a hash
userSchema.methods.generateHash = function(password) {
    return bcrypt.hashSync(password, bcrypt.genSaltSync(8), null);
};

//Delete this
// // checking if password is valid
// userSchema.methods.validPassword = function(password) {
//     return bcrypt.compareSync(password, this.password);
// };

userSchema.methods.comparePassword = function (passw, cb) {
    bcrypt.compare(passw, this.password, function (err, isMatch) {
        if (err) {
            return cb(err);
        }
        cb(null, isMatch);
    });
};

userSchema.pre('save', function (next) {
    var user = this;
    if (this.isModified('password') || this.isNew) {
        bcrypt.genSalt(10, function (err, salt) {
            if (err) {
                return next(err);
            }
            bcrypt.hash(user.password, salt, null, function (err, hash) {
                if (err) {
                    return next(err);
                }
                user.password = hash;
                next();
            });
        });
    } else {
        return next();
    }
});

// create the model for users and expose it to our app
module.exports = mongoose.model('User', userSchema);
