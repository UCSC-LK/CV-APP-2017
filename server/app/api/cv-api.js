var express = require('express'),
    router = express.Router(),
    multer = require('multer'),
    crypto = require('crypto'),
    mime = require('mime'),
    cvController = require('../controller/cv-controller');

var storage = multer.diskStorage({
    destination: function (req, file, cb) {
        cb(null, './assets/images/uploads/')
    },
    filename: function (req, file, cb) {
        crypto.pseudoRandomBytes(16, function (err, raw) {
            cb(null, raw.toString('hex') + Date.now() + '.' + mime.extension(file.mimetype));
        });
    }
});
var upload = multer({ storage: storage });

router.post('/upload', upload.any(), function (req, res) {
    console.log(req.body);
    var data = {
        student: '59a1394f87fcd81f0b006983',
        filename: req.files[0].filename,
        type: req.files[0].mimetype,
        path: req.files[0].path
    };
    cvController.saveCv(data, function (result, error) {
        if (error) {
            res.send(result);
        } else {
            res.redirect('/views/cvView.html');
        }
    });

});

module.exports = router;
