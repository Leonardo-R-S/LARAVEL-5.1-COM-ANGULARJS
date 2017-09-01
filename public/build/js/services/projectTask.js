angular.module('app.services').service('ProjectTask',['$resource','$filter','$httpParamSerializer','appConfig',function ($resource,$filter,$httpParamSerializer,appConfig) {

    function transformDate(data) {
        //verifica se é um objeto e verifica se data contem due_date
        if (angular.isObject(data) && data.hasOwnProperty('due_date')) {
            var valor = angular.copy(data);
            valor.due_date = $filter('date')(data.due_date, 'yyyy-MM-dd');
            //Serializa o array em data
            return appConfig.utils.transformRequest(valor)

        }
        if (angular.isObject(data) && data.hasOwnProperty('start_date')) {
            var valor = angular.copy(data);
            valor.start_date = $filter('date')(data.start_date, 'yyyy-MM-dd');
            //Serializa o array em data
            return appConfig.utils.transformRequest(valor)

        }
        return data;
    }


    return $resource(appConfig.baseUrl + "/project/:id/task/:idTask",{id:'@id',idTask:'@idTask'},
        {
            save: {
                method: 'POST',
                transformRequest: transformDate
            },
            get:{
                method: 'GET',
                transformResponse: function (data, headers) {
                    var valor = appConfig.utils.transformResponse(data,headers);
                    if (angular.isObject(valor) && valor.hasOwnProperty('due_date')) {
                        var arrayDate = valor.due_date.split('-');
                        month = parseInt(arrayDate[1])-1;
                        valor.due_date = new Date(arrayDate[0],month,arrayDate[2])
                    }
                    if (angular.isObject(valor) && valor.hasOwnProperty('start_date')) {
                        var arrayDate = valor.start_date.split('-');
                        month = parseInt(arrayDate[1])-1;
                        valor.start_date = new Date(arrayDate[0],month,arrayDate[2])
                    }
                    return valor;
                }
            },
            update: {
                method: 'PUT',
                transformRequest: transformDate
            }
        });

}]);