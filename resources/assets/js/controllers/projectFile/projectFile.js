//$scope = Recupera todos os valores do formulario
//$location = Redirecionados
//$routeParams = Recupera valor da URL
//Client = Aqui e a entidade de dados

angular.module('app.controllers').controller('ProjectNoteController',['$scope','$routeParams','ProjectNote',function ($scope,$routeParams,ProjectNote) {


    $scope.projectNote = ProjectNote.query({id:$routeParams.id,idNote:$routeParams.idNote});
    
}]);