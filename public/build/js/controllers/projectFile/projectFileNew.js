//$scope = Recupera todos os valores do formulario
//$location = Redirecionados
//$routeParams = Recupera valor da URL
//Client = Aqui e a entidade de dados

angular.module('app.controllers').controller('ProjectFileNewController',['$scope','$routeParams','$location', 'appConfig','url','Upload',function ($scope,$routeParams,$location, appConfig, url, Upload) {

  // $scope.projectFile = { project_id:$routeParams.id};

    $scope.saveProjectFile = function () {

        if($scope.form.$valid) {
             var URL = appConfig.baseUrl + url.getUrlFromUrlSymbol(appConfig.urls.projectFile,{
                     id: $routeParams.id,
                     idFile: ''
                 });
            console.log(URL);
            Upload.upload({
                url: URL,
                fields:{
                    name: $scope.projectFile.name,
                    description: $scope.projectFile.description,
                    project_id:$routeParams.id

                },
                file: $scope.projectFile.file,
              
            }).success(

                function (data, status, headers, config) {
                    $location.path("/project/"+$routeParams.id+"/files");

                }
            )


        }
    }
}]);