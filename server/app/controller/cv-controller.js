var Cv = require('../model/cv'),
    fs = require('fs'),
    path = require('path');

// Add entry to cv collection
module.exports.saveCv = function (data, callback) {
    console.log("Saving new CV");
    var cv = new Cv(data);
    cv.save(function (err, result) {
        if (err) {
            callback(err, 'Error');
        } else {
            callback(result);
        }
    });
};

// Return cv by userid
module.exports.getCvDetails = function (req, res) {
    Cv.find({userID: req.query.userID}, function (err, result) {
        if (err) {
            return res.json({success: false, error: err});
        }
        res.json({success: true, data:result});
    });
};

// Return cv by userid
module.exports.getCvPdf = function (req, res) {
    console.log(req.query);
    var filePath = path.join(__dirname, '..', '..', 'assets', 'uploads', req.query.filename);
    console.log(filePath);
    fs.readFile(filePath, function (err, data){
        if (err) {
            return res.json({success: false, error: err});
        }
        res.json({success: true, data:data});
        // res.contentType("application/pdf");
        // res.send(data);
    });
};