var express = require('express'),
    router = express.Router(),
    studentScheduleController = require('../controller/student-schedule-controller');

var jwt = require('express-jwt');
var config = require('../config/conf');
var auth = jwt({
    secret: config.secret,
    userProperty: 'payload'
});

router.get('/schedule/:query', studentScheduleController.getSchedule);
router.post('/', studentScheduleController.updateSchedule);
router.post('/:query', studentScheduleController.deleteScheduleItem);


module.exports = router;
