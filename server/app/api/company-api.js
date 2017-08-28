/**
 * Created by vibodha on 8/24/17.
 */

var express = require('express'),
    router = express.Router(),
    companyController = require('../controller/company-controller');

router.get('/withoutselected/:query', companyController.getCompaniesWithoutSelected);
router.get('/', companyController.getCompanies);
router.post('/', companyController.addCompany);

module.exports = router;
