var Cv = require('../model/cv');

module.exports.saveCv = function (data, callback) {
    console.log("cv controller");
    var cv = new Cv(data);
    cv.save(function (err, result) {
        if (err) {
            callback(err, 'Error');
        } else {
            callback(result);
        }
    });
};
