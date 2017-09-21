/**
 * Created by LeoTJ on 28/02/2017.
 */
angular.module('app.controllers').controller('HomeController',['$scope','$cookies',function ($scope,$cookies) {

   //console.log($cookies.putObject('user').email);
    console.log( $cookies.get('user','email'));

}]);