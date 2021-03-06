<?php

/**
 * This is the model base class for the table "categories".
 * DO NOT MODIFY THIS FILE! It is automatically generated by giix.
 * If any changes are necessary, you must set or override the required
 * property or method in class "Category".
 *
 * Columns in table "categories" available as properties of the model,
 * and there are no model relations.
 *
 * @property integer $id
 * @property integer $parent_id
 * @property string $title
 * @property string $alias
 * @property string $image
 * @property string $description
 * @property string $type
 * @property integer $level
 * @property integer $rgt
 * @property integer $lft
 * @property integer $state
 * @property string $language
 * @property string $created_at
 * @property integer $updated_at
 *
 */
abstract class BaseCategory extends GxActiveRecord {

	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return 'categories';
	}

	public static function label($n = 1) {
		return Yii::t('app', 'Category|Categories', $n);
	}

	public static function representingColumn() {
		return 'title';
	}

	public function rules() {
		return array(
			array('parent_id, level, rgt, lft, state, updated_at', 'numerical', 'integerOnly'=>true),
			array('title, alias, image, type', 'length', 'max'=>255),
			array('language', 'length', 'max'=>8),
			array('description, created_at', 'safe'),
			array('parent_id, title, alias, image, description, type, level, rgt, lft, state, language, created_at, updated_at', 'default', 'setOnEmpty' => true, 'value' => null),
			array('id, parent_id, title, alias, image, description, type, level, rgt, lft, state, language, created_at, updated_at', 'safe', 'on'=>'search'),
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
			'id' => Yii::t('app', 'ID'),
			'parent_id' => Yii::t('app', 'Parent'),
			'title' => Yii::t('app', 'Title'),
			'alias' => Yii::t('app', 'Alias'),
			'image' => Yii::t('app', 'Image'),
			'description' => Yii::t('app', 'Description'),
			'type' => Yii::t('app', 'Type'),
			'level' => Yii::t('app', 'Level'),
			'rgt' => Yii::t('app', 'Rgt'),
			'lft' => Yii::t('app', 'Lft'),
			'state' => Yii::t('app', 'State'),
			'language' => Yii::t('app', 'Language'),
			'created_at' => Yii::t('app', 'Created At'),
			'updated_at' => Yii::t('app', 'Updated At'),
		);
	}

	public function search() {
		$criteria = new CDbCriteria;

		$criteria->compare('id', $this->id);
		$criteria->compare('parent_id', $this->parent_id);
		$criteria->compare('title', $this->title, true);
		$criteria->compare('alias', $this->alias, true);
		$criteria->compare('image', $this->image, true);
		$criteria->compare('description', $this->description, true);
		$criteria->compare('type', $this->type, true);
		$criteria->compare('level', $this->level);
		$criteria->compare('rgt', $this->rgt);
		$criteria->compare('lft', $this->lft);
		$criteria->compare('state', $this->state);
		$criteria->compare('language', $this->language, true);
		$criteria->compare('created_at', $this->created_at, true);
		$criteria->compare('updated_at', $this->updated_at);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}
}