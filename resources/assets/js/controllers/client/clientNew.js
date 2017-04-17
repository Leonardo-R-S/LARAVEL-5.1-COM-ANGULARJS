//$scope = Recupera todos os valores do formulario
//$location = Redirecionados
//$routeParams = Recupera valor da URL
//Client = Aqui e a entidade de dados

angular.module('app.controllers').controller('ClientNewController',['$scope','$location','Client',function ($scope,$location,Client) {

    $scope.client = new Client();

    $scope.save = function () {
        if($scope.form.$valid) {
            $scope.client.$save().then(function () {
                $location.path('/clients');
            })
        }
    }
}]);