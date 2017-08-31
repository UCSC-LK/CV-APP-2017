var mongoose = require('mongoose');

module.exports = mongoose.model('Company', {
    name: String,
    logo: String,
    userID:String,
    panels: [String],
    positions: [String]
});