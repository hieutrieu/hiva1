<?php

/**
 * This is the model base class for the table "newsletter".
 * DO NOT MODIFY THIS FILE! It is automatically generated by giix.
 * If any changes are necessary, you must set or override the required
 * property or method in class "Newsletter".
 *
 * Columns in table "newsletter" available as properties of the model,
 * and there are no model relations.
 *
 * @property integer $id
 * @property string $email
 * @property integer $created_at
 *
 */
abstract class BaseNewsletter extends GxActiveRecord {

	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return 'newsletter';
	}

	public static function label($n = 1) {
		return Yii::t('app', 'Newsletter|Newsletters', $n);
	}

	public static function representingColumn() {
		return 'email';
	}

	public function rules() {
		return array(
			array('created_at', 'numerical', 'integerOnly'=>true),
			array('email', 'length', 'max'=>255),
			array('email, created_at', 'default', 'setOnEmpty' => true, 'value' => null),
			array('id, email, created_at', 'safe', 'on'=>'search'),
            array('email', 'unique'),
            array('email', 'email'),
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
			'email' => Yii::t('app', 'Email'),
			'created_at' => Yii::t('app', 'Created At'),
		);
	}

	public function search() {
		$criteria = new CDbCriteria;

		$criteria->compare('id', $this->id);
		$criteria->compare('email', $this->email, true);
		$criteria->compare('created_at', $this->created_at);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}
}