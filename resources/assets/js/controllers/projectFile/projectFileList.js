//$scope = Recupera todos os valores do formulario
//$location = Redirecionados
//$routeParams = Recupera valor da URL
//Client = Aqui e a entidade de dados

angular.module('app.controllers').controller('ProjectFileListController',['$scope','$routeParams','ProjectFile',function ($scope,$routeParams,ProjectFile) {

    $scope.projectFiles = ProjectFile.query({id:$routeParams.id});
  
}]);