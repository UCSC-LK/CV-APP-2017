var mongoose = require('mongoose');

module.exports = mongoose.model('Student', {
    name: String,
    phone: String,
    year: String,
    email: String,
    stream: String,
    cv: String,
    photo: String
});
