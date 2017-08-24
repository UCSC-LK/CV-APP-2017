var express = require('express'),
    path = require('path'),
    bodyParser = require('body-parser'),
    api = require('./app/api2'),
    student = require('./app/api/student-api'),
    company = require('./app/api/company-api'),
    studentCompany = require('./app/api/student-company-api'),
    app = express(),
    mongoose = require('mongoose'),
    port = 3000;

mongoose.connect('mongodb://localhost:27017/ucsc-cvapp-2017', {
    useMongoClient: true
});

// // view engine setup
// app.set('views', path.join(__dirname, '../client'));
// app.set('view engine', 'ejs');
// app.engine('html',require('ejs').renderFile);

//Set Static Folder
// app.use(express.static(path.join(__dirname, '../client')));
app.use(express.static(path.join(__dirname, '../client')));

//Body Parser MW
app.use(bodyParser.json());
app.use(bodyParser.urlencoded({
    extended: true
}));

app.use('/api2', api);
app.use('/student', student);
app.use('/student_company', studentCompany);

app.listen(port, function() {
    console.log('Server started on port : ' + port);
});
