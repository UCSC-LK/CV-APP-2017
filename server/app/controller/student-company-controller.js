/**
 * Created by vibodha on 8/24/17.
 */

var StudentCompany = require('../model/student-company');
var Student = require('../model/student');
var Company = require('../model/company');
var jsend = require('jsend');

module.exports.getStudentsForCompany = function (req, res) {
    StudentCompany.find({'student': req.params.query},"company", function (err, result) {
        Company.find({'company': result.company}, function (err, result1) {
            var temp = {"result":result1};
            res.json(temp);
        });
    });
};

module.exports.getStudentsByCompany = function (req, res) {
    StudentCompany.find({'company': req.params.query},"student -_id", function (err, result) {
        if (err) {
            return res.json({success: false, error: err});
        }
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

module.exports.addStudentCompany = function (req, res) {
    var studentCompany = new StudentCompany(req.body);
    studentCompany.timeStamp = Date.now();
    studentCompany.save(function (err, result) {
        res.json(jsend.fromArguments(err, result));
    });

// need remove  StudentCompany objcet. provid it _id
};

module.exports.deleteStudentCompany = function (req, res) {
    StudentCompany.findByIdAndRemove({'_id': req.params.query}, function (err, result) {
      res.json(jsend.fromArguments(err, result));
    });
};
