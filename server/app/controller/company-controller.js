/**
 * Created by vibodha on 8/24/17.
 */

var Company = require('../model/company');
var _ = require('lodash');
var jsend = require('jsend');

module.exports.getCompanies = function (req, res) {
    Company.find({}, function (err, result) {
        res.json({result});
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
