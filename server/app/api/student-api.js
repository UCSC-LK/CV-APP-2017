var express = require('express'),
    router = express.Router(),
    mongojs = require('mongojs'),
    _ = require('lodash'),
    jsend = require('jsend'),
    db = mongojs('mongodb://localhost:27017/soms', ['camp', 'ot', 'student']);

router.get('/', function(req, res, next) {
    res.send('I am a student');
});

router.get('/get_student', function(req, res, next) {
    res.send('student 1');
});

module.exports = router;
