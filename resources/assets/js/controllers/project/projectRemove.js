//$scope = Recupera todos os valores do formulario
//$location = Redirecionados
//$routeParams = Recupera valor da URL
//Client = Aqui e a entidade de dados

angular.module('app.controllers').controller('ProjectRemoveController',['$scope','$routeParams','$location','Project',function ($scope,$routeParams,$location,Project) {

    var id = $routeParams.id;


    $scope.project = Project.get({id:id});
  
    $scope.removeProject = function () {
        $scope.project.$delete({id:id}).then(function () {
            $location.path('/projects');
        });


    }
}]);