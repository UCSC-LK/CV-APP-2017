var StudentCompany = require('../model/student-company');
var SelectedStudentCompany = require('../model/selected-student-company');
var Student = require('../model/student');
var Company = require('../model/company');
var jsend = require('jsend');
var _ = require('lodash');

function keyVal(n) {
  return {[n.id]:n.name};
}

function toObj(arr) {
  return arr.reduce(function(p, c, i) {
    p[names[i]] = c;
    return p;
  }, {});
}

module.exports.getCompaniesByStudent = function (req, res,next) {
    StudentCompany.find({'student': req.params.query}, function (err, result1) {
      if(err) return next(err);
      var arr =_.map(result1, 'company');
      Company.find({ "_id": { "$in": arr } } ,function (err, result2) {
        if(err) return next(err);
        var arr2 =_.map(result2, keyVal);
        var resultObject = arr2.reduce(function(result, currentObject) {
            for(var key in currentObject) {
                if (currentObject.hasOwnProperty(key)) {
                    result[key] = currentObject[key];
                }
            }
            return result;
        }, {});
        // console.log(resultObject);
        var final = [];
        _.forEach(result1, function(value) {
          value.company = resultObject[value.company];
          final.push(value)
        });
        // console.log(final);
        var temp = {result:final}
        res.json(temp);
      });
    });
};


module.exports.getStudentsByCompany = function (req, res) {
    StudentCompany.find({'company': req.params.query},"student -_id", function (err, result) {
        if (err) {
            return res.json({success: false, error: err});
        }
        var studentsInStudentCompany = [];
        result.forEach(function(item){
            studentsInStudentCompany.push(item.student);
        });

        SelectedStudentCompany.find({'company': req.params.query},"student -_id", function (err, result) {
            if (err) {
                return res.json({success: false, error: err});
            }
            var studentsInSelectedStudentCompany = [];
            result.forEach(function(item){
                studentsInSelectedStudentCompany.push(item.student);
            });

            //students = studentsInStudentCompany - studentsInStudentCompany
            var students = studentsInStudentCompany.filter(function(x) { return studentsInSelectedStudentCompany.indexOf(x) < 0 });

            //Get student data
            Student.find({'userID': {$in:students}}, function (err, result1) {
                if (err) {
                    return res.json({success: false, error: err});
                }
                res.json({success: true, result:result1});
            });
        });
    });
};

module.exports.addStudentCompany = function (req, res) {
    var studentCompany = new StudentCompany(req.body);
    studentCompany.timeStamp = Date.now();
    studentCompany.save(function (err, result) {
        res.json(jsend.fromArguments(err, result));
    });
};

module.exports.deleteStudentCompany = function (req, res) {
    StudentCompany.findByIdAndRemove({'_id': req.params.query}, function (err, result) {
      res.json(jsend.fromArguments(err, result));
    });
};
