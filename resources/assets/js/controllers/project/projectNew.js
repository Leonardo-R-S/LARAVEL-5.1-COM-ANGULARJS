//$scope = Recupera todos os valores do formulario
//$location = Redirecionados
//$routeParams = Recupera valor da URL
//Client = Aqui e a entidade de dados

angular.module('app.controllers').controller('ProjectNewController',['$scope','$location','Project','Client','ipCookie','appConfig',function ($scope,$location,Project,Client,ipCookie,appConfig) {

    $scope.project = new Project();

   
    $scope.status = appConfig.project.status;

    $scope.due_date = {
      status:{
          opened:false
      }
    };

    $scope.open = function ($event) {

        $scope.due_date.status.opened = true;
    };

  
    //Function the recover data of user in cookies (Função para recuperar dados do usuario em cookies)
    $scope.saveProject = function () {
        if($scope.form.$valid) {
            $scope.project.owner_id = ipCookie('user').id;
            $scope.project.$save().then(function () {
                $location.path('/projects');
            })
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

