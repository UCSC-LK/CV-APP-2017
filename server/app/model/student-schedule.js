var mongoose = require('mongoose');
var defaultSlots = 8;

var scheduleSchema = mongoose.Schema({
    slot: {
        type: Number,
        required: true
    },
    company: {
        type: String,
        default: "-",
        required: true
    }
}, { _id : false });

var studentScheduleSchema = mongoose.Schema({
    student: {
        type: String,
        required: true
    },
    schedule: {
        type: [scheduleSchema],
        required: false
    }
});

module.exports = mongoose.model('StudentSchedule', studentScheduleSchema);
