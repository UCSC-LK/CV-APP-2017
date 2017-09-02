var mongoose = require('mongoose');

module.exports = mongoose.model('SelectedStudentCompany', {
  student: String,
  company: String,
  position: String,
  timeStamp: String
});
