// selected_student_company

var express = require('express'),
    router = express.Router(),
    SelectedStudentCompanyController = require('../controller/selected-student-company-controller');

var jwt = require('express-jwt');
var config = require('../config/conf');
var auth = jwt({
    secret: config.secret,
    userProperty: 'payload'
});


// router.get('/companies/:query', auth, studentCompanyController.getCompaniesBySelectedStudent);
router.get('/companies/:query', auth,SelectedStudentCompanyController.getCompaniesBySelectedStudent);
router.get('/students/:query', auth,SelectedStudentCompanyController.getSelectedStudentsByCompany);
router.get('/students', auth,SelectedStudentCompanyController.getSelectedStudentsByCompanyPosition);
router.get('/student_count', auth,SelectedStudentCompanyController.getSelectedStudentsCountByCompany);
router.post('/', auth,SelectedStudentCompanyController.addSelectedStudentCompany);
router.delete('/:query', auth,SelectedStudentCompanyController.deleteSelectedStudentCompany);

module.exports = router;
