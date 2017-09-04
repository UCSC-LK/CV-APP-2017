app.controller('studentController', ['$scope', '$resource', function($scope, $resource) {
  var Student = $resource('/student');

  $scope.student = {};
  $scope.message = "";

  // todo should come from a session
  var userID = "59a13d0fc80fd5df48df032b";

  Student.query({
    userID: userID
  }, function(result) {
    $scope.student = result[0];
    $scope.studentName = $scope.student.name;
    $scope.studentPhone = $scope.student.phone;
    $scope.studentYear = $scope.student.year;
    $scope.studentEmail = $scope.student.email;
    $scope.studentStream = $scope.student.stream;
    $scope.studentUserID = $scope.student.userID;
  });

  $scope.createStudent = function(isValid) {
    if (isValid) {
      var student = new Student();
      student.name = $scope.studentName;
      student.phone = $scope.studentPhone;
      student.year = $scope.studentYear;
      student.email = $scope.studentEmail;
      student.stream = $scope.studentStream;
      student.userID = $scope.studentUserID;
      student.$save(function(result) {
        $scope.message = result.msg;
      });
    } else {
      console.log("In valid data");
    }
  };
}]);
