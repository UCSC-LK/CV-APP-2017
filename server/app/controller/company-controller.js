var Company = require('../model/company');
var _ = require('lodash');
var jsend = require('jsend');
var StudentCompany = require('../model/student-company');

// Return company by userid
module.exports.getCompany = function (req, res, next) {
    // console.log('Sending company info...');
    Company.find({
        userID: req.query.userID
    }, function (err, result) {
        if (err) return next(err);
        res.json({
            success: true,
            data: result
        });
    });
};


module.exports.getCompanies = function (req, res, next) {
    Company.find({}, function (err, result) {
        if (err) return next(err);
        res.json(result);
    });
};

// {"_id": 1}
module.exports.getCompaniesWithoutSelected = function (req, res, next) {
    StudentCompany.find({
        "student": req.params.query
    }, {
        "company": 1,
        "_id": 0
    }, function (err, result) {
        if (err) return next(err);
        var arr = _.map(result, 'company');
        console.log("company-controller.getCompaniesWithoutSelected: " + arr);
        Company.find({
            "_id": {
                "$nin": arr
            }
        }, function (err, result) {
            if (err) return next(err);
            var tempresult = {
                "result": result
            };
            res.json(tempresult);
        });
    });
};

module.exports.addCompany = function (req, res, next) {
    var comp = req.body;
    var company1 = new Company(comp);
    if (_.isEmpty(comp)) {
        res.send(jsend.error('Bad Data'));
    } else {
        company1.save(function (err, data) {
          if (err) return next(err);
          res.send(jsend.fromArguments(err, data));
        });
    }
};
