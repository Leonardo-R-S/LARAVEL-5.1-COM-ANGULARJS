//$scope = Recupera todos os valores do formulario
//$location = Redirecionados
//$routeParams = Recupera valor da URL
//Client = Aqui e a entidade de dados

angular.module('app.controllers').controller('ProjectNoteRemoveController',['$scope','$routeParams','$location','ProjectNote',function ($scope,$routeParams,$location,ProjectNote) {

    var id = $routeParams.id;
    var idNote = $routeParams.idNote;
    $scope.projectNote =  ProjectNote.get({id:id,idNote:idNote});
  
    $scope.remove = function () {
        $scope.projectNote.$delete({id:null,idNote:idNote}).then(function () {
            $location.path('/project/'+id+'/notes');
        });


    }
}]);