var mongoose = require('mongoose');

module.exports = mongoose.model('Student', {
<<<<<<< HEAD
    name: String
});
=======
    name: String,
    phone: String,
    year: String,
    email: String,
    stream: String,
    cv: String,
    photo: String
});
>>>>>>> bfddfa546fca9e795d6c6f28195b70e43a936e86
