/**
 * Created by LeoTJ on 28/02/2017.
 */

var app = angular.module('app',['ngRoute','angular-oauth2','app.controllers','app.services']);

angular.module('app.controllers',['ngMessages','angular-oauth2']);
angular.module('app.services',['ngResource']);


app.provider('appConfig',function () {
    //Isso é o que ele deve retornar como valor
    var config = {
        //Aqui indica o caminho da aplicação
        baseUrl: 'http://localhost/CursoLaravelAngular/public'
    };
    return{
        //Variavel config recebe config
        config: config,
        $get: function () {
            return config;

        }
    }

});

//Este config so aceita provaders
app.config(['$routeProvider','OAuthProvider','OAuthTokenProvider','appConfigProvider',function ($routeProvider,OAuthProvider,OAuthTokenProvider,appConfigProvider) {


    $routeProvider

        .when('/login',{
            templateUrl:'build/views/login.html',
            controller:'LoginController'
        })
        .when('/home',{
            templateUrl:'build/views/home.html',
            controller:'HomeController'
        })
         .when('/clients',{
            templateUrl:'build/views/client/list.html',
            controller:'ClientListController'
        })
        .when('/clients/new',{
            templateUrl:'build/views/client/new.html',
            controller:'ClientNewController'
        })
        .when('/clients/:id',{
        templateUrl:'build/views/client/client.html',
        controller:'ClientController'
        })
        .when('/clients/:id/edit',{
            templateUrl:'build/views/client/edit.html',
            controller:'ClientEditController'
        })
        .when('/clients/:id/remove',{
            templateUrl:'build/views/client/remove.html',
            controller:'ClientRemoveController'
        })
        .when('/projects',{
            templateUrl:'build/views/project/list.html',
            controller:'ProjectListController'
        })
        .when('/project/:id/notes',{
            templateUrl:'build/views/projectNote/list.html',
            controller:'ProjectNoteListController'
        })
        .when('/project/:id/note/:idNote',{
            templateUrl:'build/views/projectNote/note.html',
            controller:'ProjectNoteController'
        })
        .when('/project/:id/notes/new',{
            templateUrl:'build/views/projectNote/new.html',
            controller:'ProjectNoteNewController'
        })
        .when('/project/:id/note/:idNote/edit',{
            templateUrl:'build/views/projectNote/edit.html',
            controller:'ProjectNoteEditController'
        })
        .when('/project/:id/note/:idNote/remove',{
            templateUrl:'build/views/projectNote/remove.html',
            controller:'ProjectNoteRemoveController'
        });

        OAuthProvider.configure({
        //Busca balor no appConfig
        baseUrl: appConfigProvider.config.baseUrl,
        clientId: 'appid1',
        clientSecret: 'secret', // optional
        grantPath:'oauth/access_token'
        });
        OAuthTokenProvider.configure({
            name:'token',
            options:{
                secure:false
            }
        })

}]);

app.run(['$rootScope', '$window', 'OAuth', function($rootScope, $window, OAuth) {
    $rootScope.$on('oauth:error', function(event, rejection) {
        // Ignore `invalid_grant` error - should be catched on `LoginController`.
        if ('invalid_grant' === rejection.data.error) {
            return;
        }

        // Refresh token when a `invalid_token` error occurs.
        if ('invalid_token' === rejection.data.error) {
            return OAuth.getRefreshToken();
        }

        // Redirect to `/login` with the `error_reason`.
        return $window.location.href = '/login?error_reason=' + rejection.data.error;
    });
}]);