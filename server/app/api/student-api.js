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

router.get('/all',auth, studentController.getStudents);

router.post('/',auth, studentController.addStudent);

router.post('/updateAvailability',auth, studentController.updateAvailability);

module.exports = router;
