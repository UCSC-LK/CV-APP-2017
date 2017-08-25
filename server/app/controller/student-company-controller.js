/**
 * Created by vibodha on 8/24/17.
 */

var StudentCompany = require('../model/student-company');

module.exports.getStudentsForCompany = function (req, res) {
    StudentCompany.find({'student': req.params.query},"company", function (err, result) {
        res.json(result);
    });
};

module.exports.getCompaniesForStudent = function (req, res) {
    StudentCompany.find({'company': req.params.query},"student", function (err, result) {
        res.json(result);
    });
};

module.exports.addStudentCompany = function (req, res) {
    var studentCompany = new StudentCompany(req.body);
    studentCompany.save(function (err, result) {
        res.json(result);
    });
};