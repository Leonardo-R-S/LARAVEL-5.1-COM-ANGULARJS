//$scope = Recupera todos os valores do formulario
//$location = Redirecionados
//$routeParams = Recupera valor da URL
//Client = Aqui e a entidade de dados

angular.module('app.controllers').controller('ProjectTaskListController',['$scope','$routeParams','ProjectTask',function ($scope,$routeParams,ProjectTask) {



    $scope.projectTask = ProjectTask.query({id:$routeParams.id, orderBy:'id', sortedBy:'desc'});



}]);