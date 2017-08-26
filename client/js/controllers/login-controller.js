app.controller('loginController', ['$scope', '$resource', function ($scope, $resource) {
    var Login = $resource('/login');

    // Student.query(function (results) {
    //     $scope.students = results;
    // });

    $scope.login = function (isValid) {
        console.log("login");
        if (isValid) {
            var login = new Login();
            login.name = $scope.userame;
            login.password = $scope.password;
            login.$save(function (result) {
                console.log(result);
            });
        }
    }
}]);
