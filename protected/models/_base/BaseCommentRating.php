<?php

/**
 * This is the model base class for the table "shop_comment_rating".
 * DO NOT MODIFY THIS FILE! It is automatically generated by giix.
 * If any changes are necessary, you must set or override the required
 * property or method in class "CommentRating".
 *
 * Columns in table "shop_comment_rating" available as properties of the model,
 * and there are no model relations.
 *
 * @property integer $id
 * @property integer $parent_id
 * @property integer $product_id
 * @property integer $user_id
 * @property string $title
 * @property string $content
 * @property integer $like_number
 * @property integer $answer_number
 * @property integer $rate_value
 *
 */
abstract class BaseCommentRating extends GxActiveRecord {

	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return 'shop_comment_rating';
	}

	public static function label($n = 1) {
		return Yii::t('app', 'CommentRating|CommentRatings', $n);
	}

	public static function representingColumn() {
		return 'title';
	}

	public function rules() {
		return array(
			array('product_id, user_id', 'required'),
			array('parent_id, product_id, user_id, like_number, answer_number, rate_value', 'numerical', 'integerOnly'=>true),
			array('title', 'length', 'max'=>255),
			array('content', 'safe'),
			array('parent_id, title, content, like_number, answer_number, rate_value', 'default', 'setOnEmpty' => true, 'value' => null),
			array('id, parent_id, product_id, user_id, title, content, like_number, answer_number, rate_value', 'safe', 'on'=>'search'),
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
			'product_id' => Yii::t('app', 'Product'),
			'user_id' => Yii::t('app', 'User'),
			'title' => Yii::t('app', 'Title'),
			'content' => Yii::t('app', 'Content'),
			'like_number' => Yii::t('app', 'Like Number'),
			'answer_number' => Yii::t('app', 'Answer Number'),
			'rate_value' => Yii::t('app', 'Rate Value'),
		);
	}

	public function search() {
		$criteria = new CDbCriteria;

		$criteria->compare('id', $this->id);
		$criteria->compare('parent_id', $this->parent_id);
		$criteria->compare('product_id', $this->product_id);
		$criteria->compare('user_id', $this->user_id);
		$criteria->compare('title', $this->title, true);
		$criteria->compare('content', $this->content, true);
		$criteria->compare('like_number', $this->like_number);
		$criteria->compare('answer_number', $this->answer_number);
		$criteria->compare('rate_value', $this->rate_value);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}
}