var StudentSchedule = require('../model/student-schedule');


// Return student by schedule by student id
module.exports.getSchedule = function (req, res) {
    StudentSchedule.find({
        'student': req.params.query
    }, function (err, result) {
        if (err) {
            return res.json({
                success: false,
                error: err
            });
        }
        var temp = {
            "result": result
        };
        res.json(temp);
    });
};