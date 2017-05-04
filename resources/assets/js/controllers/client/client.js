//$scope = Recupera todos os valores do formulario
//$location = Redirecionados
//$routeParams = Recupera valor da URL
//Client = Aqui e a entidade de dados

angular.module('app.controllers').controller('ClientController',['$scope','$routeParams','Client',function ($scope,$routeParams,Client) {



    $scope.clients = Client.get({id:$routeParams.id});
    
}]);