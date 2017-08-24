var express = require('express'),
    router = express.Router(),
    _ = require('lodash'),
    jsend = require('jsend'),
    studentController = require('../controller/student-controller');

router.get('/', studentController.getStudents);

router.post('/', studentController.addStudent);

module.exports = router;
