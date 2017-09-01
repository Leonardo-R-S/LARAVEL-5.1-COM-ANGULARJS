//$scope = Recupera todos os valores do formulario
//$location = Redirecionados
//$routeParams = Recupera valor da URL
//Client = Aqui e a entidade de dados

angular.module('app.controllers').controller('ProjectMemberRemoveController',['$scope','$routeParams','$location','ProjectMember',function ($scope,$routeParams,$location,ProjectMember) {



    var id = $routeParams.id;
    var idMember= $routeParams.idMember;
    $scope.projectMember =  ProjectMember.get({id:id,idMember:idMember});

  
    $scope.remove = function () {

        $scope.projectMember.$delete({id:id,idMember:idMember}).then(function () {
            $location.path('/project/'+id+'/members');
        });


    }
}]);