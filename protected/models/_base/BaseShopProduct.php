<?php

/**
 * This is the model base class for the table "shop_products".
 * DO NOT MODIFY THIS FILE! It is automatically generated by giix.
 * If any changes are necessary, you must set or override the required
 * property or method in class "ShopProduct".
 *
 * Columns in table "shop_products" available as properties of the model,
 * followed by relations of table "shop_products" available as properties of the model.
 *
 * @property integer $id
 * @property integer $category_id
 * @property integer $tax_id
 * @property integer $manufacturer_id
 * @property string $title
 * @property string $description
 * @property string $price
 * @property string $price_old
 * @property string $thumbnail
 * @property string $image
 * @property string $currency
 * @property integer $status
 * @property string $specifications
 * @property string $language
 * @property integer $hot
 * @property string $created_at
 * @property string $updated_at
 *
 * @property ShopFeature[] $shopFeatures
 * @property ShopManufacturer $manufacturer
 */
abstract class BaseShopProduct extends GxActiveRecord {

	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return 'shop_products';
	}

	public static function label($n = 1) {
		return Yii::t('app', 'Product');
	}

	public static function representingColumn() {
		return 'title';
	}

	public function rules() {
		return array(
			array('category_id, title', 'required'),
			array('category_id, tax_id, manufacturer_id, status, hot', 'numerical', 'integerOnly'=>true),
			array('title, price, price_old, language', 'length', 'max'=>45),
			array('thumbnail, image', 'length', 'max'=>255),
			array('currency', 'length', 'max'=>20),
			array('description, specifications, created_at, updated_at', 'safe'),
			array('tax_id, manufacturer_id, description, price, price_old, thumbnail, image, currency, status, specifications, language, created_at, updated_at', 'default', 'setOnEmpty' => true, 'value' => null),
			array('id, category_id, tax_id, manufacturer_id, title, description, price, price_old, thumbnail, image, currency, status, specifications, language, created_at, updated_at', 'safe', 'on'=>'search'),
		);
	}

	public function relations() {
		return array(
			'shopFeatures' => array(self::MANY_MANY, 'ShopFeature', 'shop_product_feature(product_id, feature_id)'),
			'manufacturer' => array(self::BELONGS_TO, 'ShopManufacturer', 'manufacturer_id'),
			'catalog' => array(self::BELONGS_TO, 'ShopCategory', 'category_id'),
		);
	}

	public function pivotModels() {
		return array(
			'shopFeatures' => 'ShopProductFeature',
		);
	}

	public function attributeLabels() {
		return array(
			'id' => Yii::t('app', 'ID'),
			'category_id' => Yii::t('app', 'Category'),
			'tax_id' => Yii::t('app', 'Tax'),
			'manufacturer_id' => null,
			'title' => Yii::t('app', 'Title'),
			'description' => Yii::t('app', 'Description'),
			'price' => Yii::t('app', 'Price'),
			'price_old' => Yii::t('app', 'Price Old'),
			'thumbnail' => Yii::t('app', 'Thumbnail'),
			'image' => Yii::t('app', 'Image'),
			'currency' => Yii::t('app', 'Currency'),
			'status' => Yii::t('app', 'Status'),
			'specifications' => Yii::t('app', 'Specifications'),
			'language' => Yii::t('app', 'Language'),
            'hot' => Yii::t('app', 'Hot'),
			'created_at' => Yii::t('app', 'Created At'),
			'updated_at' => Yii::t('app', 'Updated At'),
			'shopFeatures' => null,
			'manufacturer' => null,
		);
	}

	public function search() {
		$criteria = new CDbCriteria;
        $criteria->order = "updated_at DESC";   
		$criteria->compare('id', $this->id);
		$criteria->compare('category_id', $this->category_id);
		$criteria->compare('tax_id', $this->tax_id);
		$criteria->compare('manufacturer_id', $this->manufacturer_id);
		$criteria->compare('title', $this->title, true);
		$criteria->compare('description', $this->description, true);
		$criteria->compare('price', $this->price, true);
		$criteria->compare('price_old', $this->price_old, true);
		$criteria->compare('thumbnail', $this->thumbnail, true);
		$criteria->compare('image', $this->image, true);
		$criteria->compare('currency', $this->currency, true);
		$criteria->compare('status', $this->status);
		$criteria->compare('specifications', $this->specifications, true);
		$criteria->compare('language', $this->language, true);
        $criteria->compare('hot', $this->hot);
		$criteria->compare('created_at', $this->created_at, true);
		$criteria->compare('updated_at', $this->updated_at, true);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}
}