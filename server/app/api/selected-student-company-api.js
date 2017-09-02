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
router.get('/companies/:query', SelectedStudentCompanyController.getCompaniesBySelectedStudent);
router.get('/students/:query', SelectedStudentCompanyController.getSelectedStudentsByCompany);
router.get('/students', SelectedStudentCompanyController.getSelectedStudentsByCompanyPosition);
router.post('/', SelectedStudentCompanyController.addSelectedStudentCompany);
router.delete('/:query', SelectedStudentCompanyController.deleteSelectedStudentCompany);

module.exports = router;
