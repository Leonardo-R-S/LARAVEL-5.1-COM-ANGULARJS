//$scope = Recupera todos os valores do formulario
//$location = Redirecionados
//$routeParams = Recupera valor da URL
//Client = Aqui e a entidade de dados

angular.module('app.controllers').controller('ProjectListController',['$scope','Project',function ($scope,Project) {


    $scope.project = Project.query();

}]);