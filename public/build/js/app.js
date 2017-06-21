/**
 * Created by LeoTJ on 28/02/2017.
 */

var app = angular.module('app',['ngRoute','angular-oauth2','app.controllers','ipCookie','app.services','app.filters','app.directives',
                                'ui.bootstrap.typeahead','ui.bootstrap.datepicker','ui.bootstrap.tpls','ngFileUpload']);

angular.module('app.controllers',['ngMessages','angular-oauth2','ipCookie']);

angular.module('app.filters',[]);

angular.module('app.directives',[]);

angular.module('app.services',['ngResource']);

app.provider('appConfig',['$httpParamSerializerProvider',function ($httpParamSerializerProvider) {
    //Isso é o que ele deve retornar como valor
    var config = {
        //Aqui indica o caminho da aplicação
        baseUrl: 'http://localhost/CursoLaravelAngular/public',
        project:{
            status:[
                {value: 1, label: 'Não iniciado'},
                {value: 2, label: 'Iniciado'},
                {value: 3, label: 'Concluido'}
            ]

        },
        urls:{
            projectFile:'/project/{{id}}/file/{{idFile}}'
        },
        
        utils: {
            transformRequest: function (data) {
                if(angular.isObject(data)){
                    return $httpParamSerializerProvider.$get()(data);
                }
                return data;
            },

            transformResponse: function (data, headers) {
                var headersGetter = headers();
                if (headersGetter['content-type'] == 'application/json' || headersGetter['content-type'] == 'text/json') {
                    var dataJson = JSON.parse(data);
                    if (dataJson.hasOwnProperty('data')) {
                        dataJson = dataJson.data;
                    }
                    return dataJson;
                }
                return data;
            }
        }
    };
    return{
        //Variavel config recebe config
        config: config,
        $get: function () {
            return config;

        }
    }

}]);

//Este config so aceita provaders
app.config(['$routeProvider','$httpProvider','OAuthProvider','OAuthTokenProvider','appConfigProvider',function ($routeProvider,$httpProvider,OAuthProvider,OAuthTokenProvider,appConfigProvider) {
    //Adiciona no cabeçalho que o pode enviar o form POST e PUT com a url encode ou serializado

    $httpProvider.defaults.headers.post['Content-Type'] = 'application/x-www-form-urlencoded;charset=utf-8';
    $httpProvider.defaults.headers.put['Content-Type'] = 'application/x-www-form-urlencoded;charset=utf-8';

    $httpProvider.defaults.transformRequest = appConfigProvider.config.utils.transformRequest;
    $httpProvider.defaults.transformResponse = appConfigProvider.config.utils.transformResponse;

    $routeProvider

        .when('/login',{
            templateUrl:'build/views/login.html',
            controller:'LoginController'
        })
        .when('/home',{
            templateUrl:'build/views/home.html',
            controller:'HomeController'
        })
        //Routes of clients
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

        //Routes of Projects
        .when('/projects',{
            templateUrl:'build/views/project/list.html',
            controller:'ProjectListController'
        })
        .when('/projects/new',{
            templateUrl:'build/views/project/new.html',
            controller:'ProjectNewController'
        })
        .when('/projects/:id',{
            templateUrl:'build/views/project/project.html',
            controller:'ProjectController'
        })
        .when('/projects/:id/edit',{
            templateUrl:'build/views/project/edit.html',
            controller:'ProjectEditController'
        })
        .when('/projects/:id/remove',{
            templateUrl:'build/views/project/remove.html',
            controller:'ProjectRemoveController'
        })


        //Routes of Project Notes
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
        })

        //Routes of Files
        .when('/project/:id/files',{
            templateUrl:'build/views/projectFile/list.html',
            controller:'ProjectFileListController'
        })
        
        .when('/project/:id/files/new',{
            templateUrl:'build/views/projectFile/new.html',
            controller:'ProjectFileNewController'
        })
        .when('/project/:id/files/:idFile/edit',{
            templateUrl:'build/views/projectFile/edit.html',
            controller:'ProjectFileEditController'
        })
        .when('/project/:id/files/:idFile/remove',{
            templateUrl:'build/views/projectFile/remove.html',
            controller:'ProjectFileRemoveController'
        });









    OAuthProvider.configure({
        //Search the value in appConfig (Buscar valor no appConfig)
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