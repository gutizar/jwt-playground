'use strict';

/* Controllers */

angular.module('myApp.controllers', [])
    .controller('MyCtrl1', ['$scope', '$http', function($scope, $http) {
        $http
            .get('http://localhost:8000/app_dev.php/rest/v1/products')
            .success(function (data, status, headers, config) {
                $scope.products = data;
            })
            .error(function (data, status, headers, config) {
                console.log(data);
            });
    }])
    .controller('MyCtrl2', ['$scope', '$http', '$cookies', function($scope, $http, $cookies) {
            
    }])
    .controller('LoginController', ['$scope', '$http', '$window',  function($scope, $http, $window) {
        $scope.message = '';
        $scope.user = { _username: '', _password: '' };
        $scope.submit = function () {
            var data = "_username=" + $scope.user._username + "&" + "_password=" + $scope.user._password;
            $http({
                method: 'POST',
                url: 'http://localhost:8000/app_dev.php/login_check',
                data: data,
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' }
            })
            .success(function (data, status, headers, config) {
                // Handle login success
                $window.sessionStorage.token = data.token;
                $scope.message = 'Welcome';
            })
            .error(function (data, status, heders, config) {
                $scope.message = 'Error: invalid credentials';
            });
        };
    }]);