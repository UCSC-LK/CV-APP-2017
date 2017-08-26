var mongoose = require('mongoose');

// define the schema for our cv model
var cvSchema = mongoose.Schema({
    student: {
        type: String,
        required: true
    },
    filename: {
        type: String,
        required: true
    },
    type: {
        type: String,
        required: true
    },
    path: {
        type: String,
        required: true
    }
});

module.exports = mongoose.model('Cv', cvSchema);