//$scope = Recupera todos os valores do formulario
//$location = Redirecionados
//$routeParams = Recupera valor da URL
//Client = Aqui e a entidade de dados

angular.module('app.controllers').controller('ClientListController',['$scope','Client',function ($scope,Client) {

  
  $scope.clients = Client.query();
 
}]);