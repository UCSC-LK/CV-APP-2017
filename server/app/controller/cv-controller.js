var Cv = require('../model/cv'),
    fs = require('fs'),
    path = require('path'),
    archiver = require('archiver'),
    _ = require('lodash');

// Add entry to cv collection
module.exports.saveCv = function (data, next, callback) {
    var cv = new Cv(data);

    // Check if cv exists
    Cv.findOne({userID: cv.userID}, function (err, result) {
      if (err) return next(err);
        // set new file name using student name
        var newFileName = data.studentName.split(" ").join("-") + ".pdf";
        data.filename = newFileName;

        if (result) {
            // delete old file
            var filePath = path.join(__dirname, '..', '..', 'assets', 'uploads', result.filename);
            console.log("Deleting old file " + result.filename);
            fs.unlink(filePath, function (err) {
                if (err) return next(err);
                // rename new file to student name
                var curPath = path.join(__dirname, '..', '..', 'assets', 'uploads', cv.filename);
                var newPath = path.join(__dirname, '..', '..', 'assets', 'uploads', newFileName);
                console.log("Renaming new file to " + newFileName);
                fs.rename(curPath, newPath, function (err) {
                    if (err) return next(err);
                    console.log("Updating cv info..."); // update db
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
                });
            });

        } else {
            // rename new file to student name
            var curPath = path.join(__dirname, '..', '..', 'assets', 'uploads', cv.filename);
            var newFileName = data.studentName.split(" ").join("-") + ".pdf";
            var newPath = path.join(__dirname, '..', '..', 'assets', 'uploads', newFileName);
            console.log("Renaming new file to " + newFileName);
            fs.rename(curPath, newPath, function (err) {
                if (err) return next(err);
                console.log("Adding new cv info..."); // add new cv
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
            });
        }
    });
};

// Return cv by userid
module.exports.getCvDetails = function (req, res, next) {
    Cv.find({
        userID: req.query.userID
    }, function (err, result) {
        if (err) return next(err);
        res.json({
            success: true,
            data: result
        });
    });
};

// Return a zip of CVs
module.exports.getCVZip = function (req, res, next) {

    var outputZipName = decodeURIComponent(req.body.position).split(' ').join('-') + '-All-CVs.zip';

    // create folder for the company
    var dirPath = path.join(__dirname, '..', '..', 'assets', 'uploads', req.body.company);
    if (!fs.existsSync(dirPath)){
        fs.mkdirSync(dirPath);
    }

    // create a file to stream archive data to.
    var output = fs.createWriteStream(path.join(dirPath, outputZipName));
    var archive = archiver('zip');

    // catching errors
    archive.on('error', function(err) {
        return next(err);
    });

    // listen for archive to finish
    archive.on('end', function() {
        console.log('Zipping finished: ' + archive.pointer() + ' total bytes');
        res.json({
            success: true,
            data: 'uploads/' + req.body.company + '/' + outputZipName
        });
    });

    // pipe archive data to the file
    archive.pipe(output);

    // iterate through all cvs and add them to the archive
    _.forEach(req.body.cvs, function (cv) {
        // console.log(cv);
        var cvPath = path.join(__dirname, '..', '..', 'assets', 'uploads', cv);

        // append a file
        archive.file(cvPath, { name: cv });
    });

    archive.finalize();
};