//$scope = Recupera todos os valores do formulario
//$location = Redirecionados
//$routeParams = Recupera valor da URL
//Client = Aqui e a entidade de dados
angular.module('app.controllers').controller('ProjectMemberNewController',['$scope','$routeParams','$location','ProjectMember','User','ipCookie','appConfig',function ($scope,$routeParams,$location,ProjectMember,User,ipCookie,appConfig) {

  var idProject = $routeParams.id;

    $scope.projectMember = new ProjectMember();




    //Function the recover data of user in cookies (Função para recuperar dados do usuario em cookies)
    $scope.saveProjectMember = function () {


        if($scope.form.$valid) {
           

            $scope.projectMember.project_id = idProject;
            $scope.projectMember.$save({id:idProject}).then(function () {
                $location.path('/project/'+idProject+'/members');
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
    $scope.getMembers = function (name) {

        return User.query({
            search:name,
            searchFields:'name:like'
        }).$promise;
    };

    $scope.selectMember = function(item){
        $scope.projectMember.user_id = item.id;

    };
}]);