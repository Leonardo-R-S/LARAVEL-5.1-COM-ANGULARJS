angular.module('app.services').service('ProjectFile',['$resource','appConfig','url',function ($resource,appConfig,url) {

    var url2 = appConfig.baseUrl + url.getUrlResource(appConfig.urls.projectFile);
    return $resource(url2,
        {id:'@id',
         idFile:'@idFile'},
        {
            update:{
                method:'PUT'
            },
            download:{
                url:url2+'/download',
                method:'GET'
            }
        }
    );

}]);