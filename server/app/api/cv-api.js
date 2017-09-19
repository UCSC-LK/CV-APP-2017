var express = require('express'),
    router = express.Router(),
    multer = require('multer'),
    crypto = require('crypto'),
    mime = require('mime'),
    cvController = require('../controller/cv-controller');

var jwt = require('express-jwt');
var config = require('../config/conf');
var auth = jwt({
    secret: config.secret,
    userProperty: 'payload'
});


// Init multer storage object
var storage = multer.diskStorage({
    destination: function (req, file, cb) {
        cb(null, './assets/uploads/');
    },
    filename: function (req, file, cb) {
        crypto.pseudoRandomBytes(16, function (err, raw) {
            cb(null, raw.toString('hex') + Date.now() + '.' + mime.extension(file.mimetype));
        });
    }
});
var upload = multer({
    storage: storage
}).any();

router.get('/', auth,cvController.getCvDetails);

router.post('/upload', auth,function (req, res, next) {
    // Begin upload
    console.log("Uploading file...");
    upload(req, res, function (err) {
        if (err) {
            console.log("Uploading file failed!");
            res.json({
                success: false,
                msg: 'Some thing went wrong. Please contact site admin.',
                error: err
            });
            return;
        }
        console.log("Uploading file complete.");
        var data = {
            userID: req.body.userID,
            studentName: req.body.studentName,
            filename: req.files[0].filename,
            type: req.files[0].mimetype,
            path: req.files[0].path
        };
        cvController.saveCv(data, next, function (result) {
            res.json(result);
        });
    });
});

router.post('/download', auth, cvController.getCVZip);

module.exports = router;
