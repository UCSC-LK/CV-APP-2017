var express = require('express'),
    router = express.Router(),
    userController = require('../controller/user-controller');

var jwt = require('express-jwt');
var config = require('../config/conf');

var auth = jwt({
    secret: config.secret,
    userProperty: 'payload'
});

router.get('/students',auth, userController.getStudentUsers);

module.exports = router;
