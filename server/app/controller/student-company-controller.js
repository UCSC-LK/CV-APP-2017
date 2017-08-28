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

module.exports.getCompaniesForStudent = function (req, res) {
    StudentCompany.find({'company': req.params.query},"student", function (err, result) {
        Student.find({'student': result.student}, function (err, result1) {
            var temp = {"result":result1};
            res.json(temp);
        });
    });
};

module.exports.addStudentCompany = function (req, res) {
    var studentCompany = new StudentCompany(req.body);
    studentCompany.timeStamp = Date.now();
    studentCompany.save(function (err, result) {
        res.json(jsend.fromArguments(err, result));
    });
};

module.exports.deleteStudentCompany = function (req, res) {
    StudentCompany.findByIdAndRemove({'_id': req.params.query}, function (err, result) {
      res.json(jsend.fromArguments(err, result));
    });
};
