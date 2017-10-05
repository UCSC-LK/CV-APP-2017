var express = require('express'),
    router = express.Router(),
    studentScheduleController = require('../controller/student-schedule-controller');

var jwt = require('express-jwt');
var config = require('../config/conf');
var auth = jwt({
    secret: config.secret,
    userProperty: 'payload'
});

router.get('/student_schedule/:query', auth, studentScheduleController.getScheduleByStudent);
router.get('/company_schedule/:query', auth, studentScheduleController.getScheduleByCompany);
router.post('/', auth, studentScheduleController.updateSchedule);
router.post('/:query', auth, studentScheduleController.deleteScheduleItem);
router.get('/all', studentScheduleController.getShortlisted);

module.exports = router;
