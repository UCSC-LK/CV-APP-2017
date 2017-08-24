/**
 * Created by vibodha on 8/24/17.
 */

var express = require('express'),
    router = express.Router(),
    studentCompanyController = require('../controller/student-company-controller');

router.get('/companies/:query', studentCompanyController.getStudentsForCompany);
router.get('/students/:query', studentCompanyController.getCompaniesForStudent);

router.post('/', studentCompanyController.addStudentCompany);

module.exports = router;