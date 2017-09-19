var User = require('../model/user'),
    Student = require('../model/student'),
    _ = require('lodash');

// Return all students
module.exports.getStudentUsers = function (req, res, next) {
    User.find({"usertype": 0}, function (err, result1) {
        if (err) return next(err);

        var userIDs = _.map(result1, '_id');
        Student.find({"userID": {"$in": userIDs}}, function (err, result2) {
            if (err) return next(err);

            var final = [];
            _.forEach(result1, function (user) { //for each user object
                var e = {};
                var found = false;
                e.username = user.username;
                _.forEach(result2, function (student) { //for each student object
                    if (user._id == student.userID) {
                        e.name = student.name;
                        e.phone = student.phone;
                        e.year = student.year;
                        e.email = student.email;
                        e.stream = student.stream;
                        found = true;
                        return false;
                    }
                });
                if (!found) {
                    e.name = "";
                    e.phone = "";
                    e.year = "";
                    e.email = "";
                    e.stream = "";
                }
                final.push(e);
            });

            var temp = {
                "result": final
            };
            res.json(temp);
        });
    });
};
