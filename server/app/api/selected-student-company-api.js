/**
 * Created by vibodha on 8/28/17.
 */

var express = require('express'),
    router = express.Router(),
    SelectedStudentCompanyController = require('../controller/selected-student-company-controller');

var jwt = require('express-jwt');
var config  = require('../config/conf');
var auth = jwt({
    secret: config.secret,
    userProperty: 'payload'
});


// router.get('/companies/:query', auth, studentCompanyController.getSelectedStudentsForCompany);
router.get('/companies/:query', SelectedStudentCompanyController.getSelectedStudentsForCompany);
router.get('/students/:query', SelectedStudentCompanyController.getSelectedCompaniesForStudent);
router.post('/', SelectedStudentCompanyController.addSelectedStudentCompany);
router.delete('/:query', SelectedStudentCompanyController.deleteSelectedStudentCompany);

module.exports = router;