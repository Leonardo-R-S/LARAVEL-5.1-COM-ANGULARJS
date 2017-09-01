//$scope = Recupera todos os valores do formulario
//$location = Redirecionados
//$routeParams = Recupera valor da URL
//Client = Aqui e a entidade de dados

angular.module('app.controllers').controller('ProjectNoteEditController',['$scope','$routeParams','$location','ProjectNote',function ($scope,$routeParams,$location,ProjectNote) {

    var id = $routeParams.id;
    var idNote = $routeParams.idNote;



   // var valor = JSON.stringify(ProjectNote.query({id:id,idNote:idNote}));
    $scope.projectNote =  ProjectNote.get({id:id,idNote:idNote});

    

    $scope.saveNoteEdit = function () {

        if($scope.form.$valid) {

            ProjectNote.update({id:id,idNote:idNote},$scope.projectNote, function () {
                $location.path('/project/'+id+'/note/'+idNote);
            });
        }
    }
}]);