var SelectedStudentCompany = require('../model/selected-student-company');
var Student = require('../model/student');
var jsend = require('jsend');

module.exports.getSelectedStudentsForCompany = function (req, res) {
    SelectedStudentCompany.find({'student': req.params.query},"company", function (err, result) {
        var temp = {"result":result};
        res.json(temp);
    });
};

module.exports.getSelectedStudentsByCompany = function (req, res) {
    SelectedStudentCompany.find({'company': req.params.query},"student -_id", function (err, result) {
        if (err) {
            return res.json({success: false, error: err});
        }
        //Getting student data
        var students = [];
        result.forEach(function(item){
            students.push(item.student);
        });
        Student.find({'userID': {$in:students}}, function (err, result1) {
            if (err) {
                return res.json({success: false, error: err});
            }
            res.json({success: true, result:result1});
        });
    });
};

module.exports.addSelectedStudentCompany = function (req, res) {
    var selectedStudentCompany = new SelectedStudentCompany(req.body);
    selectedStudentCompany.timeStamp = Date.now();
    selectedStudentCompany.save(function (err, result) {
        res.json(jsend.fromArguments(err, result));
    });
};

module.exports.deleteSelectedStudentCompany = function (req, res) {
    StudentCompany.findByIdAndRemove({'_id': req.params.query}, function (err, result) {
        res.json(jsend.fromArguments(err, result));
    });
};
// need remove  StudentCompany objcet. provid it _id
