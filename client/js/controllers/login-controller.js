app.controller('loginController', ['$scope', '$resource', function ($scope, $resource) {
    var Login = $resource('/login');

    // Student.query(function (results) {
    //     $scope.students = results;
    // });

    $scope.login = function (isValid) {
        console.log("loginController.login");
        if (isValid) {
            var login = new Login();
            login.username = $scope.username;
            login.password = $scope.password;
            login.$save(function (response) {
                if(response.success == true){
                    document.getElementById("sign_in").reset();
                    sessionStorage.setItem('jwt_token', response.token);
                    sessionStorage.setItem('user_id', response.id);
                    window.location.replace(response.path);
                }else{
                    $("#respond").hide().html('<div class="alert bg-red" >'+ response.msg+ '</div>').slideDown("slow");
                }
            });
        }
    }
}]);
