var StudentSchedule = require('../model/student-schedule');


// Return student by schedule by student id
module.exports.getSchedule = function (req, res) {
    StudentSchedule.find({
        'student': req.params.query
    }, { schedule: 1}, function (err, result) {
        if (err) {
            return res.json({
                success: false,
                error: err
            });
        }
        var res1;
        // if result is null make it empty array.to avoid DataTable error.
        if (result.length === 0){
            res1 = [];
        }
        else {
            res1 = result[0]['schedule'];
        }

        var temp = {
            "result": res1
        };
        res.json(temp);
    });
};

// Update student schedule
module.exports.updateSchedule = function (req, res) {

    var record = new StudentSchedule(req.body);

    // Check if schedule exists
    StudentSchedule.findOne({
        'student' : record['student']
    }, function (err, result) {
        if (result) {
            console.log("Updating schedule info"); // update info
            result.student = record.student;

            // Updating the schedule slot
            result.schedule[req.body.slot - 1].company = req.body.company;
            result.save(function (err) {
                if (err) {
                    return res.json({
                        success: false,
                        msg: 'Something went wrong.Try again',
                        error: err
                    });
                }
                res.json({
                    success: true,
                    msg: 'Your schedule updated successfully'
                });
            });
        } else {
            return res.json({
                success: true,
                msg: 'Your do not have a schedule'
            });

        }
    });
};