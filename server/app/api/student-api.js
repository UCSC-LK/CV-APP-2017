var express = require('express'),
    router = express.Router(),
    studentController = require('../controller/student-controller');

var jwt = require('express-jwt');
var config = require('../config/conf');

var auth = jwt({
    secret: config.secret,
    userProperty: 'payload'
});


router.get('/',auth, studentController.getStudent);

router.get('/all', studentController.getStudents);

router.post('/', studentController.addStudent);

module.exports = router;
