/**
 * Created by vibodha on 8/24/17.
 */

var StudentCompany = require('../model/student-company');
var jsend = require('jsend');

module.exports.getStudentsForCompany = function (req, res) {
    StudentCompany.find({'student': req.params.query},"company", function (err, result) {
        var temp = {"result":result};
        res.json(temp);
    });
};

module.exports.getCompaniesForStudent = function (req, res) {
    StudentCompany.find({'company': req.params.query},"student", function (err, result) {
        res.json(result);
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

// module.exports.deleteStudentCompany = function (req, res) {
//     StudentCompany.find({'_id': req.params.query}, function (err, result) {
//         StudentCompany.remove({ _id: req.params.query }, function(err) {
//             if (!err) {
//                 res.json(jsend.fromArguments(err, result));
//             }
//         });
//     });
// };

module.exports.deleteStudentCompany = function (req, res) {
    StudentCompany.findByIdAndRemove({'_id': req.params.query}, function (err, result) {
      res.json(jsend.fromArguments(err, result));
    });
};
