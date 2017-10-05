var StudentSchedule = require('../model/student-schedule'),
    Student = require('../model/student'),
    Company = require('../model/company'),
    Selectedstudentcompany = require('../model/selected-student-company'),
    _ = require('lodash');


// Return schedule by student id
module.exports.getScheduleByStudent = function (req, res, next) {
    StudentSchedule.find({
        'student': req.params.query
    }, {schedule: 1}, function (err, result) {
        if (err) return next(err);
        var res1;
        // if result is null make it empty array.to avoid DataTable error.
        if (result.length === 0) {
            res1 = [];
        }
        else {
            res1 = result[0]['schedule'];
        }

        res.json({result: res1});
    });
};

// Return schedule by company
module.exports.getScheduleByCompany = function (req, res, next) {
    StudentSchedule.find({
        'comapny': req.params.query
    }, {schedule: 1}, function (err, result) {
        if (err) return next(err);
        var res1;
        // if result is null make it empty array.to avoid DataTable error.
        if (result.length === 0) {
            res1 = [];
        }
        else {
            res1 = result[0]['schedule'];
        }

        res.json({result: res1});
    });
};

// Update student schedule
module.exports.updateSchedule = function (req, res, next) {

    var record = new StudentSchedule(req.body);

    // Check if schedule exists
    StudentSchedule.findOne({
        'student': record['student']
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
            while (record.schedule.length < defaultSlots) {
                record.schedule.push({
                    "slot": ++i,
                    "company": "-"
                })
            }
            console.log("Updating schedule info"); // update info
            record.schedule[req.body.slot - 1].company = req.body.company;
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
        'student': req.params.query
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


module.exports.getShortlisted = function (req, res, next) {
    var finalResult = [];
    var finalStudentsOrderd = [];

    function totalSum(arr){
        var numbers = _.cloneDeep(arr);
        numbers.shift();
        var total = 0;
        _.forEach(numbers,function(num){
            total += num;
        });
        return total;
    }

    var allStudents = new Promise(function (resolve, reject) {
        Student.find({isAvailable: {$in: [null, true]}}, function (err, result) {
            if (result) {
                // console.log(result);
                resolve(result);
            }
            else {
                reject(err);
            }
        });
    });
    //
    var allCompanies = new Promise(function (resolve, reject) {
        Company.find({}, function (err, result) {
            if (result) {
                // console.log(result);
                resolve(result);
            }
            else {
                reject(err);
            }
        });
    });
    //
    Promise.all([allStudents, allCompanies])
        .then(function (results) {
            var allStudents = results[0];
            var allCompanies = results[1];
            var allSubqueries = [];

            allStudents.forEach(function (item) {

                var subPromise = new Promise(function (resolve, reject) {
                    Selectedstudentcompany.find({'student': item.userID}, function (err, result) {
                        if (err) reject(err);
                        var temp = [item];
                        var shortlistedCompany = {};
                        _.forEach(result, function (items) {
                            shortlistedCompany[items.company] = items;
                        });
                        allCompanies.forEach(function (company) {
                            // console.log(shortlistedCompany.hasOwnProperty(company._id));
                            if (shortlistedCompany.hasOwnProperty(company._id)) {
                                temp.push(0);
                            } else {
                                temp.push(-1);
                            }
                        });
                        finalResult.push(temp);
                        resolve(temp);
                    });
                });

                allSubqueries.push(subPromise);
            });

            Promise.all(allSubqueries).then(function functionName() {
                var sortedResult = _.sortBy(finalResult, [totalSum]);
                _.forEach(sortedResult,function(rows) {
                    finalStudentsOrderd.push(rows.shift());
                    //console.log(name.name);
                    //console.log(rows.toString());
                });

                return res.json({
                    success: true,
                    dataMatrix: sortedResult,
                    students: finalStudentsOrderd,
                    companies: allCompanies
                });
            }).catch(function (err) {
                console.log("Failed:", err);
                return next(err);
            });
        })
        .catch(function (err) {
            console.log("Failed:", err);
            return next(err);
        });
};
