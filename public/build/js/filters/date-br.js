/**
 * Created by LeoTJ on 08/05/2017.
 */
angular.module('app.filters').filter('dateBr', ['$filter', function ($filter) {

    return function (dados) {
        return $filter('date')(dados, 'dd/MM/yyyy');
    }

}]);