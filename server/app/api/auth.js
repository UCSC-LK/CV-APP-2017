var User    = require('../model/user');
var jwt     = require('jsonwebtoken');
var config  = require('../config/conf');
// getToken = function (headers) {
//   if (headers && headers.authorization) {
//     var parted = headers.authorization.split(' ');
//     if (parted.length === 2) {
//       return parted[1];
//     } else {
//       return null;
//     }
//   } else {
//     return null;
//   }
// };

module.exports = function(app, passport) {
	//Delete this
	// process the login form
	// app.post("/login", passport.authenticate('local-login'), function(req, res) {
	//   res.json(req.user);
	// });

	// process the login form  -  //OK
	app.post('/login', function(req, res) {
		console.log("auth.login");
		User.findOne({
			username: req.body.username
			}, function(err, user) {
				if (err) throw err;
				if (!user) {
				// res.status(401).send({success: false, msg: 'Authentication failed. User not found.'});
					res.json({success: false, msg: 'Authentication failed.'});
				} else {
					// check if password matches
					user.comparePassword(req.body.password, function (err, isMatch) {
						if (isMatch && !err) {
							// if user is found and password is right create a token
							var token = jwt.sign(user, config.secret);
							// return the information including token as JSON
							res.json({success: true, token: 'JWT ' + token ,id:user.id, path: './views/student'});
						} else {
							// res.status(401).send({success: false, msg: 'Authentication failed. Wrong password.'});
							res.json({success: false, msg: 'Authentication failed.'});
						}
					});
				}
			});
		});

	// handle logout - Todo
	app.post("/logout", function(req, res) {
	  req.logOut();
	  res.send({success: true, msg: 'Loged out.', path :'../../index.html'});
	})

	// loggedin - Todo
	app.get("/loggedin", function(req, res) {
	  res.send(req.isAuthenticated() ? req.user : '0');
	});
	// remove send
	// app.get("/loggedin", function(req, res) {
	//   if (req.isAuthenticated()){
	//     res.send({success: true, user:req.user});
	//   }else{
	//     // res.status(401).send({success: false, msg: 'user not loged.'});
	//     res.send({success: false, msg: 'user not loged.'});
	//   }
	// });

	// // signup
	// app.post("/signup", function(req, res) {
	//   User.findOne({
	//     username: req.body.username
	//   }, function(err, user) {
	//     if (user) {
	//       res.json(null);
	//       return;
	//     } else {
	//       var newUser = new User();
	//       newUser.username = req.body.username.toLowerCase();
	//       // newUser.password = newUser.generateHash(req.body.password);
	//       newUser.username = req.body.username.toLowerCase();
	//       newUser.password = req.body.password;
	//       newUser.save(function(err, user) {
	//         req.login(user, function(err) {
	//           if (err) {
	//             return next(err);
	//           }
	//           res.json(user);
	//         });
	//       });
	//     }
	//   });
	// });

	// OK
	app.post('/signup', function(req, res) {
		console.log(req);
	  if (!req.body.username || !req.body.password) {
		res.json({success: false, msg: 'Please pass username and password.'});
	  } else {
		var newUser = new User({
		  username: req.body.username,
		  password: req.body.password
		});
		// save the user
		newUser.save(function(err) {
		  if (err) {
			return res.json({success: false, msg: 'Username already exists.'});
		  }
		  res.json({success: true, msg: 'Successful created new user.'});
		});
	  }
	});

	//ok
	app.post('/changepass', function(req, res) {
	  if (!req.body.username || !req.body.password || !req.body.newpassword) {
		res.json({success: false, msg: 'Please pass username , password & new password.'});
	  }else {
	  User.findOne({
		  username: req.body.username
		  }, function(err, user) {
		  if (err) throw err;
		  if (!user) {
			// res.status(401).send({success: false, msg: 'Authentication failed. User not found.'});
			res.json({success: false, msg: 'Authentication failed. User not found.'});

		  } else {
		  // check if password matches
		  user.comparePassword(req.body.password, function (err, isMatch) {
			if (isMatch && !err) {
			  user.password = req.body.newpassword;
			  user.save(function(err) {
				if (err) {
				  return res.json({success: false, msg: 'Some thing went wrong.Try again'});
				}
				res.json({success: true, msg: 'Password updated successfully'});
			  });
			} else {
			  // res.status(401).send({success: false, msg: 'Authentication failed. Wrong password.'});
			  res.json({success: false, msg: 'Authentication failed. Wrong password.'});
			}
		});
	  }
	});
  }
});

};
