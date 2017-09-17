
var express = require('express'),
    router = express.Router(),
    companyController = require('../controller/company-controller');


var jwt = require('express-jwt');
var config = require('../config/conf');
var auth = jwt({
    secret: config.secret,
    userProperty: 'payload'
});


router.get('/withoutselected/:query', auth, companyController.getCompaniesWithoutSelected);

router.get('/', auth, companyController.getCompany);

router.get('/all', auth, companyController.getCompanies);

router.post('/', auth, companyController.addCompany);

module.exports = router;
