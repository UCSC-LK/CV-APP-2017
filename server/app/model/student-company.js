/**
 * Created by vibodha on 8/24/17.
 */

var mongoose = require('mongoose');

module.exports = mongoose.model('StudentCompany', {
    student: String,
    company: String,
    position: [String],
    choice: String,
    timeStamp:String
});
