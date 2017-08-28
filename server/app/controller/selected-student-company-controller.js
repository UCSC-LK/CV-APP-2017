/**
 * Created by vibodha on 8/28/17.
 */


var SelectedStudentCompany = require('../model/selected-student-company');
var jsend = require('jsend');

module.exports.getSelectedStudentsForCompany = function (req, res) {
    SelectedStudentCompany.find({'student': req.params.query},"company", function (err, result) {
        var temp = {"result":result};
        res.json(temp);
    });
};

module.exports.getSelectedCompaniesForStudent = function (req, res) {
    SelectedStudentCompany.find({'company': req.params.query},"student", function (err, result) {
        res.json(result);
    });
};

module.exports.addSelectedStudentCompany = function (req, res) {
    var selectedStudentCompany = new SelectedStudentCompany(req.body);
    selectedStudentCompany.save(function (err, result) {
        var d = new Date();
        var n = d.getTime();
        selectedStudentCompany.timeStamp = n;
        res.json(jsend.fromArguments(err, result));
    });

// need remove  StudentCompany objcet. provid it _id
};