// var express = require('express'),
//     router = express.Router(),
//     mongojs = require('mongojs'),
//     _ = require('lodash'),
//     jsend = require('jsend'),
//     db = mongojs('mongodb://localhost:27017/soms', ['camp', 'ot', 'student']);
//
//     JSON.flatten = function(data) {
//         var result = {};
//         function recurse (cur, prop) {
//             if (Object(cur) !== cur) {
//                 result[prop] = cur;
//             } else if (Array.isArray(cur)) {
//                  for(var i=0, l=cur.length; i<l; i++)
//                      recurse(cur[i], prop + "[" + i + "]");
//                 if (l == 0)
//                     result[prop] = [];
//             } else {
//                 var isEmpty = true;
//                 for (var p in cur) {
//                     isEmpty = false;
//                     recurse(cur[p], prop ? prop+"."+p : p);
//                 }
//                 if (isEmpty && prop)
//                     result[prop] = {};
//             }
//         }
//         recurse(data, "");
//         return result;
//     }
//
// router.get('/', function(req, res, next) {
//     res.send('Api');
// });
//
// router.get('/test', function (req, res, next) {
//     res.send('test');
// });
//
//
//
// // Register OT
// router.post('/ot', function(req, res, next) {
//     var camp = req.body;
//     if (_.isEmpty(camp)) {
//         res.send(jsend.error('Bad Data'));
//     } else {
//         db.ot.save(camp, function(err, data) {
//             res.send(jsend.fromArguments(err, data));
//         });
//     }
// });
//
//
// // Search Student with Name
// router.get('/student/search/:query', function(req, res, next) {
//         db.student.find({"name" : new RegExp(req.params.query,'i')},
//             function(err, data) {
//         res.send(jsend.fromArguments(err,data ));
//     });
// });
// // Search Student Advanced
// router.post('/student/advanced/', function(req, res, next) {
//     var params =  JSON.flatten(req.body) ;
//         db.student.find(params,
//             function(err, data) {
//         res.send(jsend.fromArguments(err,data ));
//     });
// });
//
//
// // Register Student
// router.post('/student', function(req, res, next) {
//     var student = req.body;
//     if (_.isEmpty(student)) {
//         res.send(jsend.error('Bad Data'));
//     } else {
//         db.student.save(student, function(err, data) {
//             res.send(jsend.fromArguments(err, data));
//         });
//     }
// });
//
//
// // Add document to the student
//
// router.post('/student/:id', function(req, res, next) {
//     var note = req.body;
//     if (_.isEmpty(note)) {
//         res.send(jsend.error('Bad Data'));
//     } else {
//         db.student.update({
//            id: req.params.id
//         }, {
//             $set: note
//         }, {}, function(err, data) {
//             res.send(jsend.fromArguments(err, data));
//         });
//     }
// });
//
//
// // Get All students
// router.get('/students', function(req, res, next) {
//     db.student.find(function(err, data) {
//         res.send(jsend.fromArguments(err, data));
//     });
// });
//
// //Get 1 Student
// router.get('/students/:id', function(req, res, next) {
//     db.student.findOne({
//         id: req.params.id
//     }, function(err, data) {
//         res.send(jsend.fromArguments(err, data));
//     });
// });
//
// // Get All OTs
// router.get('/ots', function(req, res, next) {
//     db.ot.find(function(err, data) {
//         res.send(jsend.fromArguments(err, data));
//     });
// });
//
//
// // Get All Camps
// router.get('/camps', function(req, res, next) {
//     db.camp.find(function(err, data) {
//         res.send(jsend.fromArguments(err, data));
//     });
// });
//
// // Get single camp
// router.get('/camp/:id', function(req, res, next) {
//     db.camp.findOne({
//         _id: mongojs.ObjectId(req.params.id)
//     }, function(err, data) {
//         res.send(jsend.fromArguments(err, data));
//     });
// });
//
// // Save camp
// router.post('/camp', function(req, res, next) {
//     var camp = req.body;
//     if (_.isEmpty(camp)) {
//         res.send(jsend.error('Bad Data'));
//     } else {
//         db.camp.save(camp, function(err, data) {
//             res.send(jsend.fromArguments(err, data));
//         });
//     }
// });
//
//
// //Delete camp
// router.delete('/camp/:id', function(req, res, next) {
//     db.camp.remove({
//         _id: mongojs.ObjectId(req.params.id)
//     }, function(err, data) {
//         res.send(jsend.fromArguments(err, data));
//     });
// });
//
// //Update camp
// router.put('/camp/:id', function(req, res, next) {
//     var camp = req.body;
//     if (_.isEmpty(camp)) {
//         res.send(jsend.error('Bad Data'));
//     } else {
//         db.camp.update({
//             _id: mongojs.ObjectId(req.params.id)
//         }, {
//             $set: camp
//         }, {}, function(err, data) {
//             res.send(jsend.fromArguments(err, data));
//         });
//     }
// });
//
// module.exports = router;
