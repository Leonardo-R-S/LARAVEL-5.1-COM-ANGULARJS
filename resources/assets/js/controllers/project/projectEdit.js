//$scope = Recupera todos os valores do formulario
//$location = Redirecionados
//$routeParams = Recupera valor da URL
//Client = Aqui e a entidade de dados

angular.module('app.controllers').controller('ProjectEditController',['$scope','$routeParams','$location','Project','Client','appConfig',function ($scope,$routeParams,$location,Project,Client,appConfig) {

    
    Project.get({id:$routeParams.id}, function (data) {
        $scope.project = data;

        Client.get({id:data.client_id},function (data) {
            $scope.clientSelected = data;

        });

    });
    $scope.status = appConfig.project.status;

    $scope.due_date = {
        status:{
            opened:false
        }
    };

    $scope.open = function ($event) {

        $scope.due_date.status.opened = true;
    };



    $scope.saveProject = function () {

        if($scope.form.$valid) {

            Project.update({id:$scope.project.id},$scope.project, function () {
                $location.path('/projects');
            });
        }
    };

    //Function to get data from the client id(Função para pegar os dados de referente ao id cliente)
    $scope.formatName = function (model) {
        if(model) {
           return model.name;
        }
        return '';
    };
    //Function that returns client data as it types(Função que retorna dados do cliente de acordo com que digitado)
    $scope.getClients = function (name) {
        return Client.query({
            search:name,
            searchFields:'name:like'
        }).$promise;
    };

    $scope.selectClient = function(item){
        $scope.project.client_id = item.id;
    };
}]);