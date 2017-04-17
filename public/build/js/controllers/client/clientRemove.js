//$scope = Recupera todos os valores do formulario
//$location = Redirecionados
//$routeParams = Recupera valor da URL
//Client = Aqui e a entidade de dados

angular.module('app.controllers').controller('ClientRemoveController',['$scope','$routeParams','$location','Client',function ($scope,$routeParams,$location,Client) {

    $scope.client = Client.get({id:$routeParams.id});
  
    $scope.remove = function () {
        $scope.client.$delete().then(function () {
            $location.path('/clients');
        });


    }
}]);