//$scope = Recupera todos os valores do formulario
//$location = Redirecionados
//$routeParams = Recupera valor da URL
//Client = Aqui e a entidade de dados

angular.module('app.controllers').controller('ProjectFileRemoveController',['$scope','$routeParams','$location','ProjectFile',function ($scope,$routeParams,$location,ProjectFile) {

    var id = $routeParams.id;
    var idFile = $routeParams.idFile;
    $scope.projectFile=  ProjectFile.get({id:id,idFile:idFile});

    $scope.remove = function () {
        $scope.projectFile.$delete({id:id,idFile:idFile}).then(function () {
            $location.path('/project/'+id+'/files');
        });


    }
}]);