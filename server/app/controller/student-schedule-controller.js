var StudentSchedule = require('../model/student-schedule');


// Return student by schedule by student id
module.exports.getSchedule = function (req, res, next) {
    StudentSchedule.find({
        'student': req.params.query
    }, { schedule: 1}, function (err, result) {
        if (err) return next(err);
        if (result.length > 0) {
            var res1 = result[0]['schedule'];

            var temp = {
                "result": res1
            };
            res.json(temp);
        }
    });
};
