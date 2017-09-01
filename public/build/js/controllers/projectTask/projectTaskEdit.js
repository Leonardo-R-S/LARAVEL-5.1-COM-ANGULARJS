//$scope = Recupera todos os valores do formulario
//$location = Redirecionados
//$routeParams = Recupera valor da URL
//Client = Aqui e a entidade de dados

angular.module('app.controllers').controller('ProjectTaskEditController',['$scope','$routeParams','$location','ProjectTask','appConfig',function ($scope,$routeParams,$location,ProjectTask,appConfig) {

    var id = $routeParams.id;
    var idTask = $routeParams.idTask;


   // var valor = JSON.stringify(ProjectNote.query({id:id,idNote:idNote}));
    $scope.projectTask =  ProjectTask.get({id:id,idTask:idTask});

    $scope.status = appConfig.project.status;



   // console.log($scope.projectTask.id);

    $scope.saveTaskEdit = function () {

        if($scope.form.$valid) {

            ProjectTask.update({id:id,idTask:idTask},$scope.projectTask, function () {
                $location.path("/project/"+id+"/task");
            });
        }
    };

    $scope.due_date = {
        status:{
            opened:false
        }
    };

    $scope.openDue = function ($event) {

        $scope.due_date.status.opened = true;
    };

    $scope.start_date = {
        status:{
            opened:false
        }
    };

    $scope.openStart = function ($event) {

        $scope.start_date.status.opened = true;
    };

}]);