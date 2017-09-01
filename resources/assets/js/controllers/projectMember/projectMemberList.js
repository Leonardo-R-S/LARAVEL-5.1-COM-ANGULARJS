//$scope = Recupera todos os valores do formulario
//$location = Redirecionados
//$routeParams = Recupera valor da URL
//Client = Aqui e a entidade de dados

angular.module('app.controllers').controller('ProjectMemberListController',['$scope','$routeParams','ProjectMember',function ($scope,$routeParams,ProjectMember) {


    $scope.projectMember = ProjectMember.query({id:$routeParams.id});
   

    /* ProjectMember.query({id:$routeParams.id}, function (data) {
        $scope.projectMember = data;
        console.log($scope.projectMember = data);
    });*/



}]);