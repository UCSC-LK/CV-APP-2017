/**
 * Created by vibodha on 8/28/17.
 */

var mongoose = require('mongoose');

module.exports = mongoose.model('SelectedStudentCompany', {
    student: String,
    company: String,
    timeStamp: String
});