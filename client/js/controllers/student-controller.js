app.controller('studentController', ['$scope', '$resource', function ($scope, $resource) {
    var Student = $resource('/student');

    $scope.students = [];

    Student.query(function (results) {
        $scope.students = results;
    });

    $scope.createStudent = function (isValid) {
        if (isValid) {
            var student = new Student();
            student.name = $scope.studentName;
            student.phone = $scope.studentPhone;
            student.year = $scope.studentYear;
            student.email = $scope.studentEmail;
            student.stream = $scope.studentStream;
            student.$save(function (result) {
                console.log(result);
                $scope.students.push(result);
                $scope.studentName = "";
                $scope.studentPhone = "";
                $scope.studentYear = "";
                $scope.studentEmail = "";
                $scope.studentStream = "";
            });
        }
    }
}]);
