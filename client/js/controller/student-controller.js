app.controller('studentController', ['$scope', '$resource', function ($scope, $resource) {
    var Student = $resource('/api/student');

    $scope.students = [];

    Student.query(function (results) {
        $scope.students = results;
    });

    $scope.addStudent = function () {
        console.log("addStudent");
        var student = new Student();
        student.name = $scope.studentName;
        console.log(student.name);
        student.$save(function (result) {
            $scope.students.push(result);
            $scope.studentName = "";
        });
    }
}]);

