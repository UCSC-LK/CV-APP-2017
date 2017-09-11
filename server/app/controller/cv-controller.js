var Cv = require('../model/cv'),
    fs = require('fs'),
    path = require('path');

// Add entry to cv collection
module.exports.saveCv = function (data, callback) {
    var cv = new Cv(data);

    // Check if cv exists
    Cv.findOne({userID: cv.userID}, function (err, result) {
        // set new file name using student name
        var newFileName = data.studentName.split(" ").join("-") + ".pdf";
        data.filename = newFileName;

        if (result) {
            console.log("Updating cv info..."); // update info
            // delete old file
            var filePath = path.join(__dirname, '..', '..', 'assets', 'uploads', result.filename);
            console.log("Deleting old file " + result.filename);
            fs.unlink(filePath, function (err) {
                if (err) {
                    console.log("Deleting file failed!");
                    return;
                }
            });

            // rename new file to student name
            var curPath = path.join(__dirname, '..', '..', 'assets', 'uploads', cv.filename);
            var newPath = path.join(__dirname, '..', '..', 'assets', 'uploads', newFileName);
            console.log("Renaming new file to " + newFileName);
            fs.rename(curPath, newPath, function (err) {
                if (err) {
                    console.log("Renaming file failed!");
                    return;
                }
            });

            // update db
            result.filename = newFileName;
            result.type = cv.type;
            result.path = cv.path;
            result.save(function (err) {
                if (err) {
                    callback({
                        success: false,
                        msg: 'Something went wrong. Please try again',
                        error: err
                    });
                }
                callback({
                    success: true,
                    msg: 'Your cv updated successfully',
                    data: data
                });
            });
        } else {
            // rename new file to student name
            var curPath = path.join(__dirname, '..', '..', 'assets', 'uploads', cv.filename);
            var newFileName = data.studentName.split(" ").join("-") + ".pdf";
            var newPath = path.join(__dirname, '..', '..', 'assets', 'uploads', newFileName);
            console.log("Renaming new file to " + newFileName);
            fs.rename(curPath, newPath, function (err) {
                if (err) {
                    console.log("Renaming file failed!");
                    return;
                }
            });

            console.log("Adding new cv info..."); // add new
            cv.filename = newFileName;
            cv.save(function (err) {
                if (err) {
                    callback({
                        success: false,
                        msg: 'Something went wrong. Please try again',
                        error: err
                    });
                }
                callback({
                    success: true,
                    msg: 'Your cv uploaded successfully',
                    data: data
                });
            });
        }
    });
};

// Return cv by userid
module.exports.getCvDetails = function (req, res) {
    Cv.find({
        userID: req.query.userID
    }, function (err, result) {
        if (err) {
            return res.json({
                success: false,
                error: err
            });
        }
        res.json({
            success: true,
            data: result
        });
    });
};
