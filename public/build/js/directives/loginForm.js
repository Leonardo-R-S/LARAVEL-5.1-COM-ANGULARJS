/**
 * Created by LeoTJ on 15/06/2017.
 */
angular.module('app.directives').directive('loginForm',['appConfig',function (appConfig) {


    return {
        //Pode ser usado como 'E' de elemento ou 'A' de atributo
        restrict:'E',
        templateUrl: appConfig.baseUrl +'/build/views/templates/formLogin.html',
        scope:false,
          
    }

}]);