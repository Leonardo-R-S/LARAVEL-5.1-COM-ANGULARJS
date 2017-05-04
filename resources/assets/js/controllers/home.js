/**
 * Created by LeoTJ on 28/02/2017.
 */
angular.module('app.controllers').controller('HomeController',['$scope','ipCookie',function ($scope,ipCookie) {
    console.log(ipCookie('user').email);

}]);