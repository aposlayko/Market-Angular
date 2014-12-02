<?php

class ItemController extends Controller {

    public function actionIndex()
    {
        $this->layout = false;
        
        // get Yii js component
        $cs = Yii::app()->clientScript;
        $cs->registerCssFile(Yii::app()->request->baseUrl . 'js/lib/bootstrap/css/bootstrap.min.css');
        $cs->registerCssFile(Yii::app()->request->baseUrl . 'css/main.css');
        $cs->registerScriptFile(Yii::app()->request->baseUrl . 'http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js');
        $cs->registerScriptFile(Yii::app()->request->baseUrl . '/js/lib/angular/angular.min.js');
        $cs->registerScriptFile(Yii::app()->request->baseUrl . '/js/lib/angular/angular-resource.js');
        $cs->registerScriptFile(Yii::app()->request->baseUrl . '/js/lib/angular/angular-route.js');
        
        $cs->registerScriptFile(Yii::app()->request->baseUrl . '/js/app/controllers.js');
        $cs->registerScriptFile(Yii::app()->request->baseUrl . '/js/app/filters.js');
        $cs->registerScriptFile(Yii::app()->request->baseUrl . '/js/app/services.js');
        
        $cs->registerScriptFile(Yii::app()->request->baseUrl . '/js/app/app.js');
        $this->render('index');
    }
    
    public function actionList()
    {
        $category = Yii::app()->request->getParam('category');
        $brand = Yii::app()->request->getParam('brand');
        $in_stock = Yii::app()->request->getParam('in_stock');
        
        $criteria = new CDbCriteria();
        if (isset($category))
        {
            $criteria->compare('id_category', $category);
            $result['selected']['category'] = $category;
        }
        if (isset($brand))
        {
            $criteria->compare('id_brand', $brand);
            $result['selected']['brand'] = $brand;
        }
        if (isset($in_stock)) 
        {          
            $criteria->compare('in_stock', $in_stock);
            $result['selected']['in_stock'] = $in_stock;
        }
        
        $arrItems = Item::model()->findAll($criteria);
        
        $result = array(); 
        
        foreach ($arrItems as $index => $item) {
            $thumbnailPath = Yii::getPathOfAlias('webroot') . DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR . 'items' . DIRECTORY_SEPARATOR . $item->id . DIRECTORY_SEPARATOR . "_thmb.jpg";
            $thumbnailUrl = Yii::app()->getBaseUrl(true) . '/' . 'images' . '/' . 'items' . '/' . $item->id . '/' . "_thmb.jpg";
            if (file_exists($thumbnailPath)) {
                $result[$index]['imgpath'] = $thumbnailUrl;
            }
            else
            {
                $result[$index]['imgpath'] = Yii::app()->getBaseUrl(true) . '/' . 'images' . '/' . 'noimage.jpg';
            }
            
            $result[$index]['id'] = $item->id;
            $result[$index]['name'] = $item->name;
            $result[$index]['category'] = $item->category->name;
            $result[$index]['brand'] = $item->brand->name;
            $result[$index]['price'] = $item->price;
            $result[$index]['description'] = $this->truncate($item->description, 20);
            $result[$index]['in_stock'] = $item->in_stock === '0' ? FALSE : TRUE;
        }
        
        $result = CJSON::encode($result);
        header('Content-type: application/x-json');
//        print_r($result);
//        exit();
        echo $result;
    }
    
    public function actionCategory() {
        $arrData = Category::model()->findAll();
        
        $arrCategories = CJSON::encode($arrData);
        header('Content-type: application/x-json');
        
        echo $arrCategories;
    }
    
    public function actionBrand() {
        $arrData = Brand::model()->findAll();
        
        $arrBrand = CJSON::encode($arrData);
        header('Content-type: application/x-json');
        
        echo $arrBrand;
    }
    
    public function truncate($text, $limit = 0) {
        $help_str = "АаБбВвГгДдЕеЁёЖжЗзИиЙйКкЛлМмНнОоПпРрСсТтУуФфХхЦцЧчШшЩщЪъЫыЬьЭэЮюЯя";
        if (!empty($limit) && (str_word_count($text, 0, $help_str) > $limit)) {
            $arrWords = str_word_count($text, 2, $help_str);
            $arrWordsPositions = array_keys($arrWords);
            $text = substr($text, 0, $arrWordsPositions[$limit]) . '...';
        }

        return $text;
    }

}