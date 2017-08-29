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
    },
    userID: {
        type: String,
        required: true
    }
});

module.exports = mongoose.model('Student', studentSchema);
