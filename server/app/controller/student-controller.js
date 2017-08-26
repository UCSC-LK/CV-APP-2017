var Student = require('../model/student');

module.exports.getStudents = function (req, res) {
    Student.find({}, function (err, result) {
        if (err) {
            res.send(err);
        } else {
            res.json(result);
        }
    });
};

module.exports.addStudent = function (req, res) {
    var student = new Student(req.body);
    student.save(function (err, result) {
        if (err) {
            res.send(err);
        } else {
            res.json(result);
        }
    });
};
