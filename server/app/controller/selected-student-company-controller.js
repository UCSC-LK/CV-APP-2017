var SelectedStudentCompany = require('../model/selected-student-company');
var Student = require('../model/student');
var jsend = require('jsend');
var _ = require('lodash');

function keyVal(n) {
    return {[n.userID]: n.name};
}

module.exports.getSelectedStudentsForCompany = function (req, res) {
    SelectedStudentCompany.find({'student': req.params.query}, "company", function (err, result) {
        var temp = {"result": result};
        res.json(temp);
    });
};

// Return all student details that are short listed to a company
module.exports.getSelectedStudentsByCompany = function (req, res) {
    SelectedStudentCompany.find({'company': req.params.query}, function (err, result1) {
        if (err) {
            return res.json({success: false, error: err});
        }

        //Getting student data
        var students = _.map(result1, 'student');
        Student.find({'userID': {$in: students}}, function (err, result2) {
            if (err) {
                return res.json({success: false, error: err});
            }
            var arr2 = _.map(result2, keyVal);

            // Map selectedStudentCompany id with student name => [{selectedStudentCompany._id: student.name}]
            var resultObject = arr2.reduce(function (result, currentObject) {
                for (var key in currentObject) {
                    if (currentObject.hasOwnProperty(key)) {
                        result[key] = currentObject[key];
                    }
                }
                return result;
            }, {});
            var final = [];
            _.forEach(result1, function (value) {
                value.student = resultObject[value.student];
                final.push(value)
            });
            res.json({success: true, result: final});
        });
    });
};

// Return student details that are short listed to a company for a specific position
module.exports.getSelectedStudentsByCompanyPosition = function (req, res) {
    SelectedStudentCompany.find({'company': req.query.company, 'position': req.query.position}, function (err, result1) {
        if (err) {
            return res.json({success: false, error: err});
        }

        //Getting student data
        var students = _.map(result1, 'student');
        Student.find({'userID': {$in: students}}, function (err, result2) {
            if (err) {
                return res.json({success: false, error: err});
            }
            var arr2 = _.map(result2, keyVal);

            // Map selectedStudentCompany id with student name => [{selectedStudentCompany._id: student.name}]
            var resultObject = arr2.reduce(function (result, currentObject) {
                for (var key in currentObject) {
                    if (currentObject.hasOwnProperty(key)) {
                        result[key] = currentObject[key];
                    }
                }
                return result;
            }, {});
            var final = [];
            _.forEach(result1, function (value) {
                value.student = resultObject[value.student];
                final.push(value)
            });
            res.json({success: true, result: final});
        });
    });
};

module.exports.addSelectedStudentCompany = function (req, res) {
    console.log('Adding selectedStudentCompany record');
    var selectedStudentCompany = new SelectedStudentCompany(req.body);
    selectedStudentCompany.timeStamp = Date.now();
    selectedStudentCompany.save(function (err, result) {
        res.json(jsend.fromArguments(err, result));
    });
};

module.exports.deleteSelectedStudentCompany = function (req, res) {
    console.log('Deleting selectedStudentCompany record: ' + req.params.query);
    SelectedStudentCompany.findByIdAndRemove({'_id': req.params.query}, function (err, result) {
        res.json(jsend.fromArguments(err, result));
    });
};
