//$scope = Recupera todos os valores do formulario
//$location = Redirecionados
//$routeParams = Recupera valor da URL
//Client = Aqui e a entidade de dados

angular.module('app.controllers').controller('ProjectNoteNewController',['$scope','$routeParams','$location','ProjectNote',function ($scope,$routeParams,$location,ProjectNote) {

    $scope.projectNote = new ProjectNote();

    $idProject = {id:$routeParams.id};

    $scope.saveProjectNote = function () {

        if($scope.form.$valid) {

            $scope.projectNote.$save($idProject).then(function () {
                $location.path("/project/"+$idProject.id+"/notes");
            })
        }
    }
}]);