//$scope = Recupera todos os valores do formulario
//$location = Redirecionados
//$routeParams = Recupera valor da URL
//Client = Aqui e a entidade de dados

angular.module('app.controllers').controller('ProjectEditController',['$scope','$routeParams','$location','Project','Client',function ($scope,$routeParams,$location,Project,Client) {

    $scope.project = Project.get({id:$routeParams.id});
    $scope.clients = Client.query();

    $scope.saveProject = function () {

        if($scope.form.$valid) {

            Project.update({id:$scope.project.project_id},$scope.project, function () {
                $location.path('/projects');
            });
        }
    }
}]);