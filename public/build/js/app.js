/**
 * Created by LeoTJ on 28/02/2017.
 */

var app = angular.module('app',['ngRoute','angular-oauth2','app.controllers','ngCookies','app.services','app.filters','app.directives',
                                'ui.bootstrap.typeahead','ui.bootstrap.datepicker','ui.bootstrap.tpls','ui.bootstrap.modal','ngFileUpload','http-auth-interceptor','angularUtils.directives.dirPagination']);

angular.module('app.controllers',['ngMessages','angular-oauth2','ngCookies']);

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
                {value: 1, label: 'Not started'},
                {value: 2, label: 'Initiate'},
                {value: 3, label: 'Completed'}
            ]

        },
        projectTask:{
            status:[
                {value: 1, label: 'Incomplete'},
                {value: 2, label: 'Completed'}

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
                    if (dataJson.hasOwnProperty('data') && Object.keys(dataJson).length == 1) {
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

    $httpProvider.interceptors.splice(0,1);
    $httpProvider.interceptors.splice(0,1);

    $httpProvider.interceptors.push('oauthFixInterceptor');

    $routeProvider

        .when('/login',{
            templateUrl:'build/views/login.html',
            controller:'LoginController'
        })
        .when('/logout',{
            resolve:{
                logout:['$location','OAuthToken',function ($location,OAuthToken) {
                    OAuthToken.removeToken();
                    $location.path('/login')
                }]
            }
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
        })


    //Routes of Project Task
        .when('/project/:id/task',{
            templateUrl:'build/views/projectTask/list.html',
            controller:'ProjectTaskListController'
        })
        .when('/project/:id/task/new',{
            templateUrl:'build/views/projectTask/new.html',
            controller:'ProjectTaskNewController'
        })
       
        .when('/project/:id/task/:idTask/edit',{
            templateUrl:'build/views/projectTask/edit.html',
            controller:'ProjectTaskEditController'
        })
        .when('/project/:id/task/:idTask/remove',{
            templateUrl:'build/views/projectTask/remove.html',
            controller:'ProjectTaskRemoveController'
        })

    //Routes of Project Members
        .when('/project/:id/members',{
            templateUrl:'build/views/projectMember/list.html',
            controller:'ProjectMemberListController'
        })
        .when('/project/:id/member/new',{
            templateUrl:'build/views/projectMember/new.html',
            controller:'ProjectMemberNewController'
        })


        .when('/project/:id/member/:idMember/remove',{
            templateUrl:'build/views/projectMember/remove.html',
            controller:'ProjectMemberRemoveController'
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

app.run(['$rootScope','$location','$http','$modal','httpBuffer', 'OAuth', function($rootScope,$location,$http,$modal,httpBuffer,OAuth) {

    //event - evento a ser recebido
    //next - proxima rota a ser direcionado
    //current - rota atual
    //AUTENTICAÇÃO QUE IMPEDE DE ACESSAR O SISTEMA SEM ESTA AUTENTICADO
    $rootScope.$on('$routeChangeStart', function (event,next,current) {
        //Verifica se o caminho atual é diferente de login
        if(next.$$route.originalPath != '/login'){

            //OAuth.isAuthenticated - verifica se tem algum token ativo no browser
            if(!OAuth.isAuthenticated()){

                //Direciona para rota login
                $location.path('login');
            }
        }

    });

    $rootScope.$on('oauth:error', function(event, data) {
        // Ignore `invalid_grant` error - should be catched on `LoginController`.
        if ('invalid_grant' === data.rejection.data.error) {
            return;
        }

        // Refresh token when a `invalid_token` error occurs.
        if ('access_denied' === data.rejection.data.error) {
            httpBuffer.append(data.rejection.config, data.deferred);
            if(!$rootScope.loginModalOpened) {
                var modalInstance = $modal.open({
                    templateUrl: 'build/views/templates/loginModal.html',
                    controller: 'LoginModelController'
                });
                $rootScope.loginModalOpened = true;

            }
            return;
        }

        // Redirect to `/login` with the `error_reason`.
        return $location.path('login');
    });
}]);