var express = require('express'),
    router = express.Router(),
    multer = require('multer'),
    crypto = require('crypto'),
    mime = require('mime'),
    cvController = require('../controller/cv-controller');

var storage = multer.diskStorage({
    destination: function (req, file, cb) {
        cb(null, './assets/uploads/')
    },
    filename: function (req, file, cb) {
        crypto.pseudoRandomBytes(16, function (err, raw) {
            cb(null, raw.toString('hex') + Date.now() + '.' + mime.extension(file.mimetype));
        });
    }
});
var upload = multer({ storage: storage });

router.get('/', cvController.getCvDetails);

router.get('/pdf', cvController.getCvPdf);

router.post('/upload', upload.any(), function (req, res) {
    var data = {
        userID: req.body.userID,
        filename: req.files[0].filename,
        type: req.files[0].mimetype,
        path: req.files[0].path
    };
    cvController.saveCv(data, function (result, err) {
        if (err) {
            return res.json({success: false, error: err});
        }
        res.json({success: true, data:result});
    });

});

module.exports = router;
