/**
 * Created by vibodha on 8/26/17.
 */
app.controller('companyController', ['$scope', '$resource', function($scope, $resource) {
  var Company = $resource('/company');
  var Student = $resource('/student');

  $scope.companies = [];
  var userID = "59a13d0fc80fd5df48df032b";

  Company.query(function(results) {
    $scope.companies = results;
  });

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
}]);
