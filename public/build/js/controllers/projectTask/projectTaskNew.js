//$scope = Recupera todos os valores do formulario
//$location = Redirecionados
//$routeParams = Recupera valor da URL
//Client = Aqui e a entidade de dados

angular.module('app.controllers').controller('ProjectTaskNewController',['$scope','$routeParams','$location','ProjectTask','appConfig',function ($scope,$routeParams,$location,ProjectTask,appConfig) {



    $scope.projectTask = new ProjectTask();

    $idProject = {id:$routeParams.id};


    $scope.status = appConfig.project.status;
    
    $scope.due_date = {
        status:{
            opened:false
        }
    };

    $scope.openDue = function ($eventDue) {

        $scope.due_date.status.opened = true;
    };
    
    $scope.start_date = {
        status:{
            opened:false
        }
    };

    $scope.openStart = function ($eventStart) {

        $scope.start_date.status.opened = true;
    };

    $scope.saveProjectTask = function () {

        if($scope.form.$valid) {

            $scope.projectTask.$save($idProject).then(function () {
                $location.path("/project/"+$idProject.id+"/task");
            })
        }
    }
}]);