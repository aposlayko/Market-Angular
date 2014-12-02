<?php

/**
 * This is the model class for table "item".
 *
 * The followings are the available columns in table 'item':
 * @property integer $id
 * @property string $name
 * @property integer $id_category
 * @property integer $id_brand
 * @property integer $price
 * @property integer $in_stock
 */
class Item extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'item';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, id_category, id_brand, price', 'required'),
			array('id_category, id_brand, price, in_stock', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>128),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name, id_category, id_brand, price, in_stock', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		return array(
                    'category' => array(self::BELONGS_TO, 'category', 'id_category'),
                    'brand' => array(self::BELONGS_TO, 'brand', 'id_brand')
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'Name',
			'id_category' => 'Id Category',
			'id_brand' => 'Id Brand',
			'price' => 'Price',
			'in_stock' => 'In Stock',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('id_category',$this->id_category);
		$criteria->compare('id_brand',$this->id_brand);
		$criteria->compare('price',$this->price);
		$criteria->compare('description',$this->description);
		$criteria->compare('in_stock',$this->in_stock);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Item the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
        
        public function getItemsList($criteria)
        {
            $arrItems = array();
            $arrData = Item::model()->findAll($criteria);
            foreach ($arrData as $index => $item) {                
                $arrItems[$index]['id'] = $item->id;
                $arrItems[$index]['name'] = $item->name;
                $arrItems[$index]['category'] = $item->category->name;
                $arrItems[$index]['brand'] = $item->brand->name;
                $arrItems[$index]['price'] = $item->price;
                $arrItems[$index]['description'] = $item->description;
                $arrItems[$index]['in_stock'] = $item->in_stock;
            }   
            return $arrItems;
        }
}
