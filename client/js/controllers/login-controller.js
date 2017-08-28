app.controller('loginController', ['$scope', '$resource', function ($scope, $resource) {
    var Login = $resource('/login');

    function getToken(){
      return sessionStorage.getItem('jwt_token');
    }

    function isLoggedIn()  {
      var token = getToken();
      var payload;

      if(token){
        payload = token.split('.')[1];
        payload = window.atob(payload);
        payload = JSON.parse(payload);

        console.log(payload);
        return payload.exp > Date.now() / 1000;
      } else {
        return false;
      }
    };

    function currentUser (){
      if(isLoggedIn()){
          var token = getToken();
          var payload = token.split('.')[1];
          payload = window.atob(payload);
          payload = JSON.parse(payload);
          return {
              name : payload.name,
              _id: payload._id,
              isfirst: payload.isfirst,
              usertype:payload.usertype,
              name: payload.username,
          };
      }
    };

    function homeRedirect(){
      user_info = currentUser();

      if (user_info.usertype == 0){
        window.location.replace('./views/student');
      }else if (user_info.usertype == 1){
        window.location.replace('./views/company');
      }else if (user_info.usertype == 99){
        window.location.replace('./views/super_user');
      }else{
        alert("Invalid User");
        sessionStorage.removeItem('jwt_token');
      }
    }


    if(isLoggedIn()){
      // need to update according to user
      // window.location.replace('./views/student');
      // username
      homeRedirect();

    }



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
                    // sessionStorage.setItem('user_id', response.id);
                    // window.location.replace(response.path);
                    homeRedirect();
                }else{
                    $("#respond").hide().html('<div class="alert bg-red" >'+ response.msg+ '</div>').slideDown("slow");
                }
            });
        }
    }
}]);
