/**
 * Created by LeoTJ on 15/06/2017.
 */
angular.module('app.directives').directive('projectFileDownload',['appConfig','ProjectFile','$timeout',function (appConfig,ProjectFile,$timeout) {


    return {
        //Pode ser usado como 'E' de elemento ou 'A' de atributo
        restrict:'E',
        templateUrl: appConfig.baseUrl +'/build/views/templates/projectFileDownload.html',
        link: function (scope, element, attr) {
            var anchor = element.children()[0];
            scope.$on('salva-arquivo',function (event, data) {

                $(anchor).removeClass('disabled');
                $(anchor).text('Download');
                $(anchor).attr({
                    href: 'data:application-octet-stream;base64,'+data.file,
                    download:data.name
                });

                $timeout(function () {
                    scope.downloadFile = function () {

                    };
                    $(anchor)[0].click();
                });
            });
        },
        controller: ['$scope','$element','$attrs',function ($scope,$element,$attrs) {
            $scope.downloadFile = function () {
                var anchor = $element.children()[0];
                $(anchor).addClass('disabled');
                $(anchor).text('Loading...');
                ProjectFile.download({id:null, idFile:$attrs.idFile}, function (data) {
                    $scope.$emit('salva-arquivo',data);

                });
            };
        }]
    }

}]);