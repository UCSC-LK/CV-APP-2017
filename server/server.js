var express = require('express'),
    path = require('path'),
    bodyParser = require('body-parser'),
    // api = require('./app/api2'),
    student = require('./app/api/student-api'),
    cv = require('./app/api/cv-api'),
    company = require('./app/api/company-api'),
    studentCompany = require('./app/api/student-company-api'),
    app = express(),
    mongoose = require('mongoose'),
    port = 3000,
    passport = require('passport');


mongoose.connect('mongodb://localhost:27017/ucsc-cvapp-2017', {
    useMongoClient: true
});

///////////////////////////////////////////
// // view engine setup
// app.set('views', path.join(__dirname, '../client'));
// app.set('view engine', 'ejs');
// app.engine('html',require('ejs').renderFile);

//Set Static Folder
app.use(express.static(path.join(__dirname, '../client')));
// app.use(express.static(path.join(__dirname, '../client2')));

app.use('/assets', express.static('../client/assets'));


require('./app/config/passport')(passport); // pass passport for configuration

//Cookie and session
var cookieParser = require('cookie-parser');
var session = require('express-session');
app.use(session({
  secret: 'keyboard cat',
  resave: false,
  saveUninitialized: true,
  // cookie: { secure: true }
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
app.use('/compnay', company);
app.use('/student_company', studentCompany);

app.listen(port, function() {
    console.log('Server started on port : ' + port);
});
