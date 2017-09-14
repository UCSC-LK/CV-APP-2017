var Student = require('../model/student');

// Return all students
module.exports.getStudents = function (req, res, next) {
    Student.find({}, function (err, result) {
      if (err) return next(err);
      var temp = {
          "result": result
      };
      res.json(temp);
    });
};

// Return student by userid
module.exports.getStudent = function (req, res, next) {
    // console.log('Sending student info...');
    Student.find({
        userID: req.query.userID
    }, function (err, result) {
        if (err) return next(err);
        res.json({
            success: true,
            data: result
        });
    });
};

// Insert a student
module.exports.addStudent = function (req, res, next) {
    var student = new Student(req.body);
    // Check if student exists
    Student.findOne({
        userID: student.userID
    }, function (err, result) {
        if (result) {
            console.log("Updating student info"); // update info
            result.name = student.name;
            result.phone = student.phone;
            result.year = student.year;
            result.email = student.email;
            result.stream = student.stream;
            result.save(function (err) {
                if (err) {
                    return res.json({
                        success: false,
                        msg: 'Something went wrong. Please try again',
                        error: err
                    });
                }
                res.json({
                    success: true,
                    msg: 'Your details updated successfully'
                });
            });
        } else {
            console.log("Adding student info"); // add new
            student.save(function (err) {
                if (err) {
                    return res.json({
                        success: false,
                        msg: 'Something went wrong. Please try again',
                        error: err
                    });
                }
                return res.json({
                    success: true,
                    msg: 'Your details added successfully'
                });
            });
        }
    });
};
