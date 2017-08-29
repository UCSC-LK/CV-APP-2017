var mongoose = require('mongoose');

module.exports = mongoose.model('SelectedStudentCompany', {
    student: String,
    company: String,
    timeStamp: String
});