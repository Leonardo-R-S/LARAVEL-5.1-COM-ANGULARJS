//$scope = Recupera todos os valores do formulario
//$location = Redirecionados
//$routeParams = Recupera valor da URL
//Client = Aqui e a entidade de dados

angular.module('app.controllers').controller('ProjectNewController',['$scope','$location','Project','Client',function ($scope,$location,Project,Client) {

    $scope.project = new Project();

    $scope.clients = Client.query();

    
    $scope.options = [
    {name: "Options 1", value: "11"},
    {name: "Options 2", value: "22"},
    {name: "Options 3", value: "33"}
    ];



    $scope.saveProject = function () {
        if($scope.form.$valid) {
            $scope.project.$save().then(function () {
                $location.path('/projects');
            })
        }
    }
}]);

