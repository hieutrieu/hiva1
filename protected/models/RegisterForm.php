<?php

/**
 * ContactForm class.
 * ContactForm is the data structure for keeping
 * contact form data. It is used by the 'contact' action of 'SiteController'.
 */
class RegisterForm extends CFormModel {
	public $first_name;
	public $last_name;
	public $date_birth;
	public $phone;
	public $address;
	public $email;
	public $password;
	public $repassword;
	public $verify_code;
	public $terms_of_service;

	/**
	 * Declares the validation rules.
	 */
	public function rules() {
		return array(
			// name, email, subject and body are required
			array('terms_of_service, first_name, last_name, date_birth, email, phone, address, password, repassword', 'required'),
			// email has to be a valid email address
			array('email', 'email'),
            /*array(
                 'validacion',
                 'application.extensions.recaptcha.EReCaptchaValidator',
                 'privateKey'=> '6LdOg_8SAAAAAKu7TdDo9hpTSB5xSQIWyZI3bGjY', 
                 'on' => 'registerwcaptcha'
            ),*/
            array('verify_code', 'validateCaptcha'),
            array('password, repassword', 'length', 'min'=>6, 'max'=>40),
            array('password', 'compare', 'compareAttribute'=>'repassword'),
            array('phone', 'match', 'pattern'=>'/^([+]?[0-9 ]+)$/'),
            array('terms_of_service', 'boolean', 'falseValue' => 'true'),

		);
	}
    
    public function validateCaptcha($attribute, $params) {
		if ($this->getRequireCaptcha()){
			CValidator::createValidator('application.extensions.recaptcha.EReCaptchaValidator',
            $this, $attribute
            , array('privateKey'=>'6LdOg_8SAAAAAKu7TdDo9hpTSB5xSQIWyZI3bGjY'))
            ->validate($this);
        }   
    }
    
    public function getRequireCaptcha() {
   	    return Yii::app()->params['contactRequireCaptcha'];
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
			'verify_code' => 'Verification Code',
			'terms_of_service' => 'I agree to the Terms of TamHieu',
		);
	}
}