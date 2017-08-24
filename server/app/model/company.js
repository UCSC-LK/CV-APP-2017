/**
 * Created by vibodha on 8/24/17.
 */

var mongoose = require('mongoose');

module.exports = mongoose.model('Company', {
    name: String,
    logo: String,
    panels: [String]
});