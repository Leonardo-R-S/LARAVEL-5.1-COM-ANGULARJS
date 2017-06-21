//$scope = Recupera todos os valores do formulario
//$location = Redirecionados
//$routeParams = Recupera valor da URL
//Client = Aqui e a entidade de dados

angular.module('app.controllers').controller('ProjectFileEditController',['$scope','$routeParams','$location','ProjectFile',function ($scope,$routeParams,$location,ProjectFile) {

    var id = $routeParams.id;
    var idFile= $routeParams.idFile;


   // var valor = JSON.stringify(ProjectNote.query({id:id,idNote:idNote}));
    $scope.projectFile=  ProjectFile.get({id:id,idFile:idFile});

    //console.log(valor);

    $scope.saveFileEdit = function () {

        if($scope.form.$valid) {

            ProjectFile.update({id:id,idFile:idFile},$scope.projectFile, function () {
                $location.path('/project/'+id+'/files');
            });
        }
    }
}]);