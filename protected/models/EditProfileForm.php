<?php

/**
 * ContactForm class.
 * ContactForm is the data structure for keeping
 * contact form data. It is used by the 'contact' action of 'SiteController'.
 */
class EditProfileForm extends CFormModel {
	public $first_name;
	public $last_name;
	public $date_birth;
	public $phone;
	public $address;
	public $email;
	public $password;
	public $repassword;

	/**
	 * Declares the validation rules.
	 */
	public function rules() {
		return array(
			// name, email, subject and body are required
			array('first_name, last_name, date_birth, email, phone, address', 'required'),
			// email has to be a valid email address
			array('email', 'email'),
            array('password, repassword', 'length', 'min'=>6, 'max'=>40),
            array('password', 'compare', 'compareAttribute'=>'repassword'),
            array('phone', 'match', 'pattern'=>'/^([+]?[0-9 ]+)$/'),

		);
	}
	/**
	 * Declares customized attribute labels.
	 * If not declared here, an attribute would have a label that is
	 * the same as its name with the first letter in upper case.
	 */
	public function attributeLabels() {
		return array(
			'first_name' => Yii::t('app', 'First Name'),
			'last_name' => Yii::t('app', 'Last Name'),
			'date_birth' => Yii::t('app', 'Date Birth'),
			'email' => Yii::t('app', 'Email'),
			'phone' => Yii::t('app', 'Phone'),
			'address' => Yii::t('app', 'Address'),
			'password' => Yii::t('app', 'Password'),
			'repassword' => Yii::t('app', 'Re Password'),
		);
	}
}