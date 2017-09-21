//$scope = Recupera todos os valores do formulario
//$location = Redirecionados
//$routeParams = Recupera valor da URL
//Client = Aqui e a entidade de dados

angular.module('app.controllers').controller('ProjectListController',['$scope','$routeParams','Project',function ($scope,$routeParams,Project) {


    $scope.project = [];
    $scope.totalProject= 0;
    $scope.projectPerPage = 6; // this should match however many results your API puts on one page

    $scope.pagination = {
        current: 1
    };

    $scope.pageChanged = function(newPage) {
        getResultsPage(newPage);
    };

    function getResultsPage(pageNumber) {
        Project.query({
            page: pageNumber
        }, function (data) {
            $scope.project = data.data;
            $scope.totalProject = data.meta.pagination.total;
        });

    }
        getResultsPage(1);

}]);






