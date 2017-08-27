var app = angular.module('cvApp', ['ngResource']);

// app.config(function($routeProvider) {
//     $routeProvider
//         .when('/student/details', {
//             templateUrl: 'views/student-data-form.html'
//         })
        // .when('/login', {
        //     templateUrl: 'views/login.html',
        //     controller: 'LoginCtrl'
        // })
        // .when('/signup', {
        //     templateUrl: 'views/signup.html',
        //     controller: 'SignUpCtrl'
        // })
        // .when('/profile', {
        //     templateUrl: 'views/profile.html',
        //     resolve: {
        //         logincheck: checkLoggedin
        //     }
        // })
        // .otherwise({
        //     redirectTo: '/login'
        // })
// });
//
// var checkLoggedin = function($q, $timeout, $http, $location, $rootScope) {
//   var deferred = $q.defer();
//   $http.get('/loggedin').success(function(user) {
//     console.log('Hello login check');
//     $rootScope.errorMessage = null;
//     // User is Authenticated
//     if (user !== '0') {
//       console.log('login complete');
//       $rootScope.currentUser = user;
//       deferred.resolve();
//     } else { //User is not Authenticated
//       $rootScope.errorMessage = 'You need to log in.';
//       console.log('You need to log in.');
//       deferred.reject();
//       $location.url('/login');
//     }
//     console.log(user);
//   }).error(function(err){
//       console.log(err);
//   });
//   return deferred.promise;
// }
