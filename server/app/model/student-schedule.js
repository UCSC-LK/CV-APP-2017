var mongoose = require('mongoose');

var studentScheduleSchema = mongoose.Schema({
    student: {
        type: String,
        required: true
    },
    schedule: {
        type: String,
        required: false
    }
});


module.exports = mongoose.model('StudentSchedule', studentScheduleSchema);
