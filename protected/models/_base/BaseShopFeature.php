<?php

/**
 * This is the model base class for the table "shop_feature".
 * DO NOT MODIFY THIS FILE! It is automatically generated by giix.
 * If any changes are necessary, you must set or override the required
 * property or method in class "ShopFeature".
 *
 * Columns in table "shop_feature" available as properties of the model,
 * followed by relations of table "shop_feature" available as properties of the model.
 *
 * @property integer $id
 * @property string $title
 * @property integer $status
 * @property string $created_at
 * @property string $updated_at
 *
 * @property ShopProducts[] $shopProducts
 */
abstract class BaseShopFeature extends GxActiveRecord {

	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return 'shop_feature';
	}

	public static function label($n = 1) {
		return Yii::t('app', 'Feature');
	}

	public static function representingColumn() {
		return 'title';
	}

	public function rules() {
		return array(
			array('status', 'numerical', 'integerOnly'=>true),
			array('title', 'length', 'max'=>255),
			array('created_at, updated_at', 'safe'),
			array('title, status, created_at, updated_at', 'default', 'setOnEmpty' => true, 'value' => null),
			array('id, title, status, created_at, updated_at', 'safe', 'on'=>'search'),
		);
	}

	public function relations() {
		return array(
			'shopProducts' => array(self::MANY_MANY, 'ShopProduct', 'shop_product_feature(feature_id, product_id)'),
		);
	}

	public function pivotModels() {
		return array(
			'shopProducts' => 'ProductFeature',
		);
	}

	public function attributeLabels() {
		return array(
			'id' => Yii::t('app', 'ID'),
			'title' => Yii::t('app', 'Title'),
			'status' => Yii::t('app', 'Status'),
			'created_at' => Yii::t('app', 'Created At'),
			'updated_at' => Yii::t('app', 'Updated At'),
			'shopProducts' => null,
		);
	}

	public function search() {
		$criteria = new CDbCriteria;

		$criteria->compare('id', $this->id);
		$criteria->compare('title', $this->title, true);
		$criteria->compare('status', $this->status);
		$criteria->compare('created_at', $this->created_at, true);
		$criteria->compare('updated_at', $this->updated_at, true);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}
}