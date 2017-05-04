angular.module('app.controllers').controller('LoginController',['$scope','$location','ipCookie','User','OAuth',function ($scope,$location,ipCookie,User,OAuth) {
    $scope.user = {
        username:'',
        password:''
    };

    $scope.error = {
      message:'',
      error:false
    };

    $scope.login = function () {
       if($scope.form.$valid) {
           OAuth.getAccessToken($scope.user).then(function () {
               User.authenticated({},{},function (data) {
                   ipCookie('user',data);
                   $location.path('home');
               });

           }, function (data) {
               $scope.error.error = true;
               $scope.error.message = data.data.error_description;
           });
       }
    };
}]);