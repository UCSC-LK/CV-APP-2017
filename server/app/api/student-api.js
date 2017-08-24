var express = require('express'),
    router = express.Router(),
    studentController = require('../controller/student-controller');

router.get('/', studentController.getStudents);

router.post('/', studentController.addStudent);

module.exports = router;
