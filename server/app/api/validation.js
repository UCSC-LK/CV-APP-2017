var express = require('express');
var router = express.Router();
var Cv = require('../model/cv');
var Student = require('../model/student');


router.get('/validStudent/:query', function(req, res) {
  Student.find({
    userID: req.params.query
  }, function(err, result) {
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

router.get('/validCv/:query', function(req, res) {
  var isValid = false;
  var isValidStudent = false;
  Cv.find({
    userID: req.params.query
  }, function(err, result) {
    if (err) return next(err);
    if (result && result.length > 0) {
      isValid = true;
    }
    Student.find({
      userID: req.params.query
    }, function(err, result) {
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
