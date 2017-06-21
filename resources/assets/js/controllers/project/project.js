//$scope = Recupera todos os valores do formulario
//$location = Redirecionados
//$routeParams = Recupera valor da URL
//Client = Aqui e a entidade de dados

angular.module('app.controllers').controller('ProjectController',['$scope','$routeParams','Project',function ($scope,$routeParams,Project) {



    $scope.project = Project.get({id:$routeParams.id});

}]);