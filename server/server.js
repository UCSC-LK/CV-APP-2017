var express = require('express'),
    path = require('path'),
    bodyParser = require('body-parser'),
    // api = require('./app/api2'),
    student = require('./app/api/student-api'),
    cv = require('./app/api/cv-api'),
    company = require('./app/api/company-api'),
    studentCompany = require('./app/api/student-company-api'),
    selectedStudentCompany = require('./app/api/selected-student-company-api'),
    app = express(),
    mongoose = require('mongoose'),
    port = 3000,
    passport = require('passport');

    var jwt = require('express-jwt');
    var config  = require('./app/config/conf');

mongoose.connect(config.database, {
    useMongoClient: true
});



///////////////////////////////////////////////

//Set Static Folder
app.use(express.static(path.join(__dirname, '../client')));
// app.use(express.static(path.join(__dirname, '../client2')));

app.use('/assets', express.static('../client/assets'));
app.use('/uploads', express.static('assets/uploads'));

require('./app/config/passport')(passport); // pass passport for configuration

//Cookie and session
var cookieParser = require('cookie-parser');
var session = require('express-session');
app.use(session({
  secret: config.secret,
  resave: false,
  saveUninitialized: true,
}));

app.use(cookieParser());
app.use(passport.initialize());
app.use(passport.session());

//Body-parser
app.use(bodyParser.json()); //for parsing application/json
app.use(bodyParser.urlencoded({
    extended: true
}));


// routes ======================================================================
// Load our routes and pass in our app and fully configured passport
require('./app/api/auth.js')(app, passport);

// app.use('/api2', api);
app.use('/student', student);
app.use('/cv', cv);
app.use('/company', company);
app.use('/student_company', studentCompany);
app.use('/selected_student_company', selectedStudentCompany);

// error handlers
// Catch unauthorised errors
app.use(function (err, req, res, next) {
  if (err.name === 'UnauthorizedError') {
    res.status(401);
    res.json({"message" : err.name + ": " + err.message});
    console.log("Log - UnauthorizedError");
  }else{
    console.log("Log - Unhandlied");
    console.log("message" + err.name + ": " + err.message);
    res.json({"message" : err.name + ": " + err.message});
  }
});


app.listen(port, function() {
    console.log('Server started on port : ' + port);
});
