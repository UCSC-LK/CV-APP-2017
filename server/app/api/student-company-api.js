/**
 * Created by vibodha on 8/24/17.
 */

var express = require('express'),
    router = express.Router(),
    studentCompanyController = require('../controller/student-company-controller');

var jwt = require('express-jwt');
var config  = require('../config/conf');
var auth = jwt({
      secret: config.secret,
      userProperty: 'payload'
});


// router.get('/companies/:query', auth, studentCompanyController.getStudentsForCompany);
router.get('/companies/:query', studentCompanyController.getCompaniesByStudent);
router.get('/students/:query', studentCompanyController.getStudentbyCompanies);
router.post('/', studentCompanyController.addStudentCompany);
router.delete('/:query', studentCompanyController.deleteStudentCompany);

module.exports = router;
