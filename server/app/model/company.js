var mongoose = require('mongoose');

module.exports = mongoose.model('Company', {
    name: String,
    logo: String,
    panels: [String],
    positions: [String]
});