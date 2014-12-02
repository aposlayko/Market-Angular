'use strict';

/* Filters */

var marketFilters = angular.module('marketFilters', []).filter('checkmark', function() {
  return function(input) {
    return input ? 'В наличии' : 'Нет на складе';
  };
});