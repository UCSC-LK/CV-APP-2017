var SelectedStudentCompany = require('../model/selected-student-company'),
    Student = require('../model/student'),
    Company = require('../model/company'),
    Schedule = require('../model/schedule'),
    jsend = require('jsend'),
    Cv = require('../model/cv'),
    mongoose = require('mongoose'),
    _ = require('lodash');

function keyVal(n) {
    return {
        [n.userID]: n.name
    };
}

module.exports.getCompaniesBySelectedStudent = function (req, res, next) {
    SelectedStudentCompany.find({
        'student': req.params.query
    }, function (err, result) {
        if (err) return next(err);

        // find out already scheduled companies
        Schedule.find({
            'student': req.params.query
        }, function (err, result1) {
            if (err) return next(err);
            var scheduledComapnies = _.map(result1, function (data) {
                return data.company + "/" + data.position;
            });

            //Getting company data
            var companies = _.map(result, 'company');
            Company.find({
                '_id': {
                    $in: companies
                }
            }, function (err, result2) {
                if (err) return next(err);

                var final = [];
                // Loop through the two array results
                _.forEach(result2, function (compObj) {
                    _.forEach(result, function (selectedCompObj) {
                        // Check company ids and update company name in the returned object
                        if(selectedCompObj.company == compObj._id){
                            var temp = {};
                            temp.timeStamp = selectedCompObj.timeStamp;
                            temp.company = selectedCompObj.company;
                            temp.student = selectedCompObj.student;
                            temp.position = selectedCompObj.position;
                            temp.companyName = compObj.name;
                            var check = selectedCompObj.company + "/" + selectedCompObj.position;
                            temp.scheduled = (scheduledComapnies.indexOf(check) !== -1);
                            final.push(temp);
                        }
                    });
                });
                final.sort({timeStamp: -1});
                res.json({"result": final});
            });
        });


    });
};

// Return all student details that are short listed to a company
module.exports.getSelectedStudentsByCompany = function (req, res, next) {
    SelectedStudentCompany.find({
        'company': req.params.query
    }, function (err, result1) {
        if (err) return next(err);
        //Getting student data
        var students = _.map(result1, 'student');
        Student.find({
            'userID': {
                $in: students
            }
        }, function (err, result2) {
            if (err) return next(err);
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
                final.push(value);
            });
            res.json({
                success: true,
                result: final
            });
        });
    });
};

// Return student details that are short listed to a company for a specific position
module.exports.getSelectedStudentsByCompanyPosition = function (req, res, next) {
    SelectedStudentCompany.find({
        'company': req.query.company,
        'position': req.query.position
    }, function (err, result1) {
        if (err) return next(err);

        //Getting student data
        var students = _.map(result1, 'student');
        Student.find({
            'userID': {
                $in: students
            }
        }, function (err, result2) {
            if (err) return next(err);
            // get cv data
            Cv.find({
                'userID': {
                    $in: students
                }
            }, "userID filename -_id", function (err, result3) {
                if (err) return next(err);
                var arr = _.map(result3, function (n) {
                    return {
                        [n.userID]: n.filename
                    };
                });
                // convert array of object in to a single object
                var resultObject = arr.reduce(function (result, currentObject) {
                    for (var key in currentObject) {
                        if (currentObject.hasOwnProperty(key)) {
                            result[key] = currentObject[key];
                        }
                    }
                    return result;
                }, {});

                //Array to get selectedStudentCompany entry id
                var arr2 = _.map(result1, function (n) {
                    return {
                        [n.student]: n._id
                    };
                });
                // convert array of object in to a single object
                var resultObject2 = arr2.reduce(function (result, currentObject) {
                    for (var key in currentObject) {
                        if (currentObject.hasOwnProperty(key)) {
                            result[key] = currentObject[key];
                        }
                    }
                    return result;
                }, {});

                //construct final data array
                var final = [];
                _.forEach(result2, function (value) {
                    var e = {};
                    e._id = resultObject2[value.userID];
                    e.userID = value.userID;
                    e.name = value.name;
                    e.phone = value.phone;
                    e.email = value.email;
                    e.year = value.year;
                    e.stream = value.stream;
                    e.isAvailable = value.isAvailable;
                    e.cv = resultObject[value.userID];
                    final.push(e);
                });

                res.json({
                    success: true,
                    result: final
                });
            });
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
    SelectedStudentCompany.findByIdAndRemove({
        '_id': req.params.query
    }, function (err, result) {
        res.json(jsend.fromArguments(err, result));
    });
};

module.exports.getSelectedStudentsCountByCompany = function (req, res) {
    SelectedStudentCompany.count({
        'company': req.query.company
    }, function (err, result) {
        res.json(jsend.fromArguments(err, result));
    });
};
