<?php

/**
 * This is the model base class for the table "shop_product_feature".
 * DO NOT MODIFY THIS FILE! It is automatically generated by giix.
 * If any changes are necessary, you must set or override the required
 * property or method in class "ProductFeature".
 *
 * Columns in table "shop_product_feature" available as properties of the model,
 * and there are no model relations.
 *
 * @property integer $feature_id
 * @property integer $product_id
 * @property string $title
 *
 */
abstract class BaseProductFeature extends GxActiveRecord {

	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return 'shop_product_feature';
	}

	public static function label($n = 1) {
		return Yii::t('app', 'ProductFeature');
	}

	public static function representingColumn() {
		return array(
			'feature_id',
			'product_id',
		);
	}

	public function rules() {
		return array(
			array('product_id', 'numerical', 'integerOnly'=>true),
			array('title', 'length', 'max'=>255),
			array('product_id, title', 'default', 'setOnEmpty' => true, 'value' => null),
			array('feature_id, product_id, title', 'safe', 'on'=>'search'),
		);
	}

	public function relations() {
		return array(
		);
	}

	public function pivotModels() {
		return array(
		);
	}

	public function attributeLabels() {
		return array(
			'feature_id' => null,
			'product_id' => null,
			'title' => Yii::t('app', 'Title'),
		);
	}

	public function search() {
		$criteria = new CDbCriteria;

		$criteria->compare('feature_id', $this->feature_id);
		$criteria->compare('product_id', $this->product_id);
		$criteria->compare('title', $this->title, true);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}
}