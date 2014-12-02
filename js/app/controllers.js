'use strict';

/* Controllers */

var marketControllers = angular.module('marketControllers', []);

marketControllers.controller('ItemListCtrl', ['$scope', 'Item', function($scope, Item) {
        $scope.items = Item.getItems();
        
        $scope.changeForm = function() {
            console.log('hello');
        }
        
        $scope.qwe = function () {
            console.log('qwe');
        }
    }]);

marketControllers.controller('ItemCategoryCtrl', ['$scope', 'Item', function($scope, Item) {
        $scope.categories = Item.getCategories();
}]);

marketControllers.controller('ItemBrandCtrl', ['$scope', 'Item', function($scope, Item) {
        $scope.brands = Item.getBrands();
}]);

marketControllers.controller('formCtrl', ['$scope', 'Item', function($scope, Item) {
        
    }]);