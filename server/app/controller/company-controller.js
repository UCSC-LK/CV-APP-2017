/**
 * Created by vibodha on 8/24/17.
 */

var Company = require('../model/company');
var _ = require('lodash');
var jsend = require('jsend');
var Student = require('../model/student');
var StudentCompany = require('../model/student-company');

module.exports.getCompanies = function (req, res) {
    Company.find({}, function (err, result) {
        res.json(result);
    });
};
// {"_id": 1}
module.exports.getCompaniesWithoutSelected = function (req, res,next) {
    StudentCompany.find({"student":req.params.query},{"company": 1,"_id":0} ,function (err, result) {
      if(err) return next(err);
      var arr =_.map(result, 'company');
      console.log("company-controller.getCompaniesWithoutSelected: " + arr);
      Company.find({ "_id": { "$nin": arr } } ,function (err, result) {
        if(err) return next(err);
        var tempresult = {"result":result};
        res.json(tempresult);
      });
    });
};

module.exports.addCompany = function (req, res) {
    var comp = req.body;
    var company1 = new Company(comp);
    if (_.isEmpty(comp)) {
        res.send(jsend.error('Bad Data'));
    } else {
        company1.save(function(err, data) {
            res.send(jsend.fromArguments(err, data));
        });
    }
};
