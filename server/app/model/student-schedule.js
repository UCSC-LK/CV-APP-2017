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

studentScheduleSchema.pre("save",function(next) {
    if (this.isNew) {
        this.schedule = [];
        var i = 0;
        while(this.schedule.length < defaultSlots) {
            this.schedule.push({
                "slot": ++i,
                "company": "-"
            })
        }
    }
    next();
});

module.exports = mongoose.model('StudentSchedule', studentScheduleSchema);
