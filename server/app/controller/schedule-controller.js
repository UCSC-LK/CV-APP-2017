var StudentSchedule = require('../model/student-schedule'),
    Schedule = require('../model/schedule'),
    Student = require('../model/student'),
    Company = require('../model/company'),
    Selectedstudentcompany = require('../model/selected-student-company'),
    _ = require('lodash');


// Update student-company schedule
module.exports.updateSchedule = function (req, res, next) {

    var record = new Schedule(req.body);

    // Check if schedule exists
    Schedule.findOne({
        'student': record['student'],
        'company': record['company']
    }, function (err, result) {
        if (err) return next(err);
        if (result) {
            console.log("Updating schedule..."); // update info
            // Updating the schedule slot
            result.slot = record['slot'];
            result.save(function (err) {
                if (err) return next(err);
                res.json({
                    success: true,
                    msg: 'Schedule updated successfully'
                });
            });
        } else {
            console.log("Adding new schedule..."); // update info
            record.save(function (err) {
                if (err) return next(err);
                return res.json({
                    success: true,
                    msg: 'Schedule added successfully'
                });
            });
        }
    });

};

// Return schedule by student id
module.exports.getScheduleByStudent = function (req, res, next) {
    Schedule.find({
        'student': req.params.query
    }, function (err, result) {
        if (err) return next(err);
        var companies = _.map(result, 'company');
        Company.find({
            '_id': {
                $in: companies
            }
        }, function (err, result1) {
            if (err) return next(err);

            // Loop through the two array results
            _.forEach(result1, function (compObj) {
                _.forEach(result, function (scheduleCompObj) {
                    // Check company ids and update company name in the returned object
                    if(scheduleCompObj.company == compObj._id){
                        scheduleCompObj.company = compObj.name;
                    }
                });
            });
            res.json({result: result});
        });
    });
};

// Return schedule by company todo
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


module.exports.deleteScheduleItem = function (req, res, next) {
    console.log(req.params.query);
    Schedule.findByIdAndRemove({
        '_id': req.params.query
    }, function (err, result) {
        if (err) return next(err);
        res.json({
            success: true,
            msg: 'Your schedule updated successfully'
        });
    });
};


module.exports.getShortlisted = function (req, res, next) {
    var finalResult = [];
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
                        var temp = [];
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
                // console.log("###########_____________#############");
                // _.forEach(finalResult,function(test) {
                //   console.log(test.toString());
                // });
                // console.log("###########_____________#############");
                return res.json({
                    success: true,
                    dataMatrix: finalResult,
                    students: allStudents,
                    companies: allCompanies
                });
            });
        })
        .catch(function (err) {
            console.log("Failed:", err);
            return next(err);
        });
};
