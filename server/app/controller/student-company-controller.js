var StudentCompany = require('../model/student-company'),
    SelectedStudentCompany = require('../model/selected-student-company'),
    Student = require('../model/student'),
    Company = require('../model/company'),
    Cv = require('../model/cv'),
    jsend = require('jsend'),
    _ = require('lodash');

function keyVal(n) {
    return {
        [n._id]: n.name
    };
}

function toObj(arr) {
    return arr.reduce(function (p, c, i) {
        p[names[i]] = c;
        return p;
    }, {});
}

module.exports.getCompaniesByStudent = function (req, res, next) {
    // Get companies for the given student
    StudentCompany.find({
        'student': req.params.query
    }, function (err, result1) {
        if (err) return next(err);
        var arr = _.map(result1, 'company');
        //Get company details for resulted companies
        Company.find({
            "_id": {
                "$in": arr
            }
        }, function (err, result2) {
            if (err) return next(err);
            var arr2 = _.map(result2, keyVal);
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
                value.company = resultObject[value.company];
                final.push(value);
            });
            var temp = {
                result: final
            };
            res.json(temp);
        });
    });
};

//http://localhost:3000/student_company/students => data : {company, position}
module.exports.getStudentsByCompanyPosition = function (req, res, next) {
    StudentCompany.find({
        'company': req.query.company,
        'position': req.query.position
    }, "student -_id", function (err, result) {
        if (err) return next(err);
        var studentsInStudentCompany = [];
        result.forEach(function (item) {
            studentsInStudentCompany.push(item.student);
        });
        SelectedStudentCompany.find({
            'company': req.query.company
        }, "student position -_id", function (err, result1) {
            if (err) return next(err);
            var studentsInSelectedStudentCompany = [];
            result1.forEach(function (item) {
                if (item.position == req.query.position)
                    studentsInSelectedStudentCompany.push(item.student);
            });

            //students = studentsInStudentCompany - studentsInStudentCompany
            var students = studentsInStudentCompany.filter(function (x) {
                return studentsInSelectedStudentCompany.indexOf(x) < 0;
            });

            //Get student data
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

                    //construct final data array
                    var final = [];
                    _.forEach(result2, function (value) {
                        var e = {};
                        e.userID = value.userID;
                        e.name = value.name;
                        e.phone = value.phone;
                        e.email = value.email;
                        e.year = value.year;
                        e.stream = value.stream;
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
    });
};

//http://localhost:3000/student_company/students/company
module.exports.getAllStudentsByCompanyPosition = function (req, res, next) {
    StudentCompany.find({
        'company': req.query.company,
        'position': req.query.position
    }, "student position -_id", function (err, result) {
        if (err) return next(err);
        var students = [];
        result.forEach(function (item) {
            students.push(item.student);
        });
        //Get student data
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

                //construct final data array
                var final = [];
                _.forEach(result2, function (value) {
                    var e = {};
                    e.userID = value.userID;
                    e.name = value.name;
                    e.phone = value.phone;
                    e.email = value.email;
                    e.year = value.year;
                    e.stream = value.stream;
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

module.exports.addStudentCompany = function (req, res, next) {
    var positions = req.body.position.split(',');
    var errr, result;
    positions.forEach(function (position) {
        var params = {};
        params.student = req.body.student;
        params.company = req.body.company;
        params.choice = req.body.choice;
        params.position = position;
        var studentCompany = new StudentCompany(params);
        studentCompany.timeStamp = Date.now();
        studentCompany.save(function (err, result1) {
            if (err) return next(err);
            errr = err;
            result = result1;
        });
    });
    res.json({
        status: 'success',
        result: result
    });
};

module.exports.deleteStudentCompany = function (req, res) {
    console.log("student-company-controller.deleteStudentCompany: Deleting studentCompany record - " + req.params.query);
    StudentCompany.findByIdAndRemove({
        '_id': req.params.query
    }, function (err, result) {
        res.json(jsend.fromArguments(err, result));
    });
};
