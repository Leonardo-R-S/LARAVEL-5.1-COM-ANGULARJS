//$scope = Recupera todos os valores do formulario
//$location = Redirecionados
//$routeParams = Recupera valor da URL
//Client = Aqui e a entidade de dados

angular.module('app.controllers').controller('ProjectTaskRemoveController',['$scope','$routeParams','$location','ProjectTask',function ($scope,$routeParams,$location,ProjectTask) {

    var id = $routeParams.id;
    var idTask = $routeParams.idTask;
    $scope.projectTask =  ProjectTask.get({id:id,idTask:idTask});
  
    $scope.remove = function () {
        $scope.projectTask.$delete({id:id,idTask:idTask}).then(function () {
            $location.path("/project/"+id+"/task");
        });


    }
}]);