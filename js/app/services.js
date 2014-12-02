'use strict';

/* Services */

var marketServices = angular.module('marketServices', ['ngResource']);

marketServices.factory('Item', ['$resource',
    function($resource) {
        return $resource('item/:action', {}, {
            getItems: {method: 'GET', params: {action: 'list'}, isArray: true},
            getBrands: {method: 'GET', params: {action: 'brand'}, isArray: true},
            getCategories: {method: 'GET', params: {action: 'category'}, isArray: true}
        });
    }]);