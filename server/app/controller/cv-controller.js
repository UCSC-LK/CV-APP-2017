var Cv = require('../model/cv'),
    fs = require('fs'),
    path = require('path');

// Add entry to cv collection
module.exports.saveCv = function (data, callback) {
    var cv = new Cv(data);

    // Check if cv exists
    Cv.findOne({userID:cv.userID}, function (err, result) {
        if (result) {
            console.log("Updating cv info"); // update info
            // delete old file
            var filePath = path.join(__dirname, '..', '..', 'assets', 'uploads', result.filename);
            fs.unlink(filePath);
            // update db
            result.filename = cv.filename;
            result.type = cv.type;
            result.path = cv.path;
            result.save(function (err) {
                if (err) {
                    callback({success: false, msg: 'Some thing went wrong. Try again', error: err, data: data});
                }
                callback({success: true, msg: 'Your cv updated successfully', data: data});
            });
        } else {
            console.log("Adding new cv"); // add new
            cv.save(function (err) {
                if (err) {
                    callback({success: false, msg: 'Some thing went wrong. Try again', error: err});
                }
                callback({success: true, msg: 'Your cv uploaded successfully', data: data});
            });
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
