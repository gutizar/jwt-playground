'use strict';


// Declare app level module which depends on filters, and services
angular.module('myApp', [
  'ngRoute',
  'ngCookies',
  'myApp.filters',
  'myApp.services',
  'myApp.directives',
  'myApp.controllers'
]).
config(['$routeProvider', function($routeProvider) {
  $routeProvider.when('/products', {templateUrl: 'partials/products.html', controller: 'MyCtrl1'});
  $routeProvider.when('/view2', {templateUrl: 'partials/partial2.html', controller: 'MyCtrl2'});
  $routeProvider.when('/login', {templateUrl: 'partials/login.html', controller: 'LoginController'});
  $routeProvider.otherwise({redirectTo: '/view1'});
}]).
config(['$provide', '$httpProvider', function($provide, $httpProvider) {
    $provide.factory('authInterceptor', [ '$rootScope', '$q', '$window', '$location', function ($rootScope, $q, $window, $location) {
        return {
            request: function (config) {
                config.headers = config.headers || {};
                if ($window.sessionStorage.token) {
                    config.headers.Authorization = 'Bearer ' + $window.sessionStorage.token;
                }
                return config;
            },
            response: function (response) {
                if (response.status === 401) {
                    console.log("you are not authenticated");
                    // $location.url('/login');
                }
                
                return response || $q.when(response);
            }
        };
    }]);
    
    $httpProvider.interceptors.push('authInterceptor');
}]);