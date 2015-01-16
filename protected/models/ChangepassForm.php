<?php

/**
 * LoginForm class.
 * LoginForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class ChangepassForm extends CFormModel {
	public $new_password;
	/**
	 * Declares the validation rules.
	 * The rules state that username and password are required,
	 * and password needs to be authenticated.
	 */
	public function rules() {
		return array(
			// username and password are required
			array('new_password', 'required'),
            array('new_password', 'length', 'min'=>6),
		);
	}
    
    public function attributeLabels() {
		return array(
			'new_password' => Yii::t('app', 'New Password'),
		);
	}
}
