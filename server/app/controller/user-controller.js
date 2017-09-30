var User = require('../model/user'),
    Student = require('../model/student'),
    StudentCompany = require('../model/student-company'),
    _ = require('lodash');

// Return all students
module.exports.getStudentUsers = function (req, res, next) {
    User.find({"usertype": 0}, function (err, result1) {
        if (err) return next(err);

        var userIDs = _.map(result1, '_id');
        Student.find({"userID": {"$in": userIDs}}, function (err, result2) {
            if (err) return next(err);

            StudentCompany.find({"student": {"$in": userIDs}}, function (err, result3) {
                if (err) return next(err);

                var final = [];
                _.forEach(result1, function (user) { //for each user object
                    var e = {};
                    var found = false;
                    e.username = user.username;
                    _.forEach(result2, function (student) { //for each student object
                        if (user._id == student.userID) {
                            e._id = student._id;
                            e.name = student.name;
                            e.phone = student.phone;
                            e.year = student.year;
                            e.email = student.email;
                            e.stream = student.stream;
                            e.isAvailable = student.isAvailable;
                            found = true;
                            return false;
                        }
                    });
                    if (!found) {
                        e._id = "";
                        e.name = "";
                        e.phone = "";
                        e.year = "";
                        e.email = "";
                        e.stream = "";
                        e.isAvailable = "";
                    }

                    // set apply count
                    var applyCount = 0;
                    _.forEach(result3, function (stdcompany) {
                        if (user._id == stdcompany.student) {
                            applyCount ++;
                        }
                    });
                    e.applyCount = applyCount;
                    final.push(e);
                });

                var temp = {
                    "result": final
                };
                res.json(temp);
            });
        });
    });
};
