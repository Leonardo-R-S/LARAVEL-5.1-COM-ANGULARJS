angular.module('app.services').service('Project',['$resource','$filter','$routeParams','$httpParamSerializer','appConfig',function ($resource,$filter,$routeParams,$httpParamSerializer,appConfig) {

    function transformDate(data) {
        //verifica se é um objeto e verifica se data contem due_date
        if (angular.isObject(data) && data.hasOwnProperty('due_date')) {
            var valor = angular.copy(data);
            valor.due_date = $filter('date')(data.due_date, 'yyyy-MM-dd');

            //Serializa o array em data
            return appConfig.utils.transformRequest(valor)
            
        }
        return data;
    }

   

    return $resource(appConfig.baseUrl + '/project/:id',{id:'@id'},
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
                    return valor;
                }
            },
            //Corrige o erro que pede um array em vez de um query
            query:{
                isArray:false,
            },
                update: {
                    method: 'PUT',
                    transformRequest: transformDate
                }
            });

}]);