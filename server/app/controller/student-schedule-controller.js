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
            var i = 0;
            var defaultSlots = 8;
            while(record.schedule.length < defaultSlots) {
                record.schedule.push({
                    "slot": ++i,
                    "company": "-"
                })
            }
            console.log(record);
            console.log("Updating schedule info"); // update info
            record.schedule[req.body.slot - 1].company = req.body.company;
            console.log(record);
            record.save(function (err) {
                if (err) {
                    return res.json({
                        success: false,
                        msg: 'Something went wrong.Try again',
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

module.exports.deleteScheduleItem = function (req, res) {
    console.log(req.body);
    StudentSchedule.findOne({
        'student' : req.params.query
    }, function (err, result) {
        console.log("Updating schedule info"); // update info
        // Updating the schedule slot
        result.schedule[req.body.slot - 1].company = "-";
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
    });
};