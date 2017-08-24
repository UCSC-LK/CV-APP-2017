var Student = require('../model/student-model');

module.exports.getStudents = function (req, res) {
    Student.find({}, function (err, result) {
        console.log(result);
        res.json(result);
    });

};

module.exports.addStudent = function (req, res) {
    var student = new Student(req.body);
    student.save(function (err, result) {
        res.json(result);
    });
};