<?php

/**
 * ContactForm class.
 * ContactForm is the data structure for keeping
 * contact form data. It is used by the 'contact' action of 'SiteController'.
 */
class CommentForm extends CFormModel {
	public $title;
	public $content;
	public $parent_id;
	public $product_id;
	public $user_id;
	public $like_number;
	public $rate_value;
	public $repassword;
	public $answer_number;

	/**
	 * Declares the validation rules.
	 */
	public function rules() {
		return array(
			array('title, content, product_id, user_id', 'required'),
		);
	}
	/**
	 * Declares customized attribute labels.
	 * If not declared here, an attribute would have a label that is
	 * the same as its name with the first letter in upper case.
	 */
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
}