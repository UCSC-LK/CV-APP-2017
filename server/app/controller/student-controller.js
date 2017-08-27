var Student = require('../model/student');

// Return all students
module.exports.getStudents = function (req, res) {
    Student.find({}, function (err, result) {
        if (err) {
            res.send(err);
        } else {
            res.json(result);
        }
    });
};

// Return student by userid
module.exports.getStudent = function (req, res) {
    Student.find({userID: req.query.userID}, function (err, result) {
        if (err) {
            res.send(err);
        } else {
            res.json(result);
        }
    });
};

// Insert a student
module.exports.addStudent = function (req, res) {
    var student = new Student(req.body);
    // Check if student exists
    Student.findOne({userID:student.userID}, function (err, result) {
        if (result) {
            console.log("Updating student info"); // update info
            result.name = student.name;
            result.phone = student.phone;
            result.year = student.year;
            result.email = student.email;
            result.stream = student.stream;
            result.save(function (err) {
                if (err) {
                    return res.json({success: false, msg: 'Some thing went wrong.Try again', error: err});
                }
                res.json({success: true, msg: 'Details updated successfully'});
            });
        } else {
            console.log("Adding student info"); // add new
            student.save(function (err) {
                if (err) {
                    return res.json({success: false, msg: 'Some thing went wrong.Try again', error: err});
                }
                return res.json({success: true, msg: 'Details added successfully'});
            });
        }
    });
};
