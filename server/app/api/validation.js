var express = require('express');
var router = express.Router();
var Cv = require('../model/cv');
var Student = require('../model/student');

var jwt = require('express-jwt');
var config = require('../config/conf');
var auth = jwt({
    secret: config.secret,
    userProperty: 'payload'
});

router.get('/validStudent/:query',auth, function (req, res,next) {
    Student.find({
        userID: req.params.query
    }, function (err, result) {
        if (err) return next(err);
        if (result && result.length > 0) {
            res.json({
                success: true,
                isValid: true
            });
        } else {
            res.json({
                success: true,
                isValid: false
            });
        }
    });
});

router.get('/validCv/:query',auth, function (req, res, next) {
    var isValid = false;
    var isValidStudent = false;
    Cv.find({
        userID: req.params.query
    }, function (err, result) {
        if (err) return next(err);
        if (result && result.length > 0) {
            isValid = true;
        }
        Student.find({
            userID: req.params.query
        }, function (err, result) {
            if (err) return next(err);
            if (result && result.length > 0) {
                isValidStudent = true;
            }
            res.json({
                success: true,
                isValid: isValid,
                isValidStudent: isValidStudent
            });
        });
    });
});

module.exports = router;
