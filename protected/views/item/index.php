<?php header('Content-Type: text/html; charset=utf-8'); ?>
<div ng-app="marketApp" class="container">
    <div ng-controller="ItemListCtrl">
        <h2>Products</h2>
        <!--{{items}}-->
        <div class="col-md-2">
            <form ng-controller="formCtrl">
                <label>Категория
                    <select id="cat" ng-controller="ItemCategoryCtrl" ng-click="changeForm()">
                        <option></option>
                        <option ng-repeat="category in categories" value="{{category.id}}">{{category.name}}</option>
                    </select>
                </label>
                <label>Бренд
                    <select id="bran" ng-controller="ItemBrandCtrl">
                        <option></option>
                        <option ng-repeat="brand in brands" value="{{brand.id}}">{{brand.name}}</option>
                    </select>
                </label>
                <label>В наличии
                    <input id="in_st" type="checkbox">
                </label>
                <!--<input type="submit" value="Применить фильтр">-->
            </form>
        </div>
        <div class="col-md-10">
            <div class = 'row item-wrap' ng-repeat="item in items">
                <div class = 'col-md-2'>
                    <a href="#">
                        <image ng-src="{{item.imgpath}}">
                    </a>
                </div>
                <div class = 'col-md-10'>
                    <div class = 'col-md-3 lead'>
                        <a href="#">
                            <strong>
                                {{item.brand}} {{item.name}}
                            </strong>
                        </a>
                    </div>
                    <div class = 'col-md-9'>{{item.description}}</div>

                    <div class = 'row'>
                        <div class = 'col-md-3 text-primary'>
                            <h4>{{item.price}}</h4>
                        </div>
                    </div>
                    <div class = 'col-md-9'>{{item.in_stock | checkmark}}</div>
                </div>
            </div>
        </div>
        
    </div>
</div>