var mongoose = require('mongoose');

// define the schema for student model
var studentSchema = mongoose.Schema({
    name: {
        type: String,
        required: true
    },
    phone: {
        type: String,
        required: true
    },
    year: {
        type: String,
        required: true
    },
    email: {
        type: String,
        required: true
    },
    stream: {
        type: String,
        required: true
    }
});

// Check if student name exists
// studentSchema.pre('save', function (next) {
//     var student = this;
//     console.log(student);
//     if (this.isModified('name') || this.isNew) {
//         return next();
//     } else {
//         console.log('user exists: ',student.name);
//         next(new Error("User exists!"));
//     }
// }) ;

module.exports = mongoose.model('Student', studentSchema);