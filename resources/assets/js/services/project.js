angular.module('app.services').service('Project',['$resource','appConfig',function ($resource,appConfig) {

    console.log(appConfig.baseUrl + '/project/');
    return $resource(appConfig.baseUrl + '/project/:id',{id:'@id'},
        {update:{method:'PUT'}}

    );

}]);