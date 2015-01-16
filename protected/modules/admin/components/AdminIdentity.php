<?php

/**
 * AdminIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class AdminIdentity extends CUserIdentity
{
    private $_id;
    private $_email;
    public $user_type;
    public $customer_code;
	const ERROR_STATUS_NOTACTIV = 4;
	const ERROR_STATUS_BAN = 5;
	/**
	 * Authenticates a user.
	 * The example implementation makes sure if the username and password
	 * are both 'demo'.
	 * In practical applications, this should be changed to authenticate
	 * against some persistent user identity storage (e.g. database).
	 * @return boolean whether authentication succeeds.
	 */
	public function authenticate()
	{
        //debug($this->password, true);
        //$role = 0;
        $user = null;
        if(Yii::app()->controller->module->id == 'admin'){
            //$role = 1;
            $user = Users::model()->findByAttributes(array('username'=>$this->username, 'password' => md5($this->password)));
        }
       	
		if($user == null)
			$this->errorCode = self::ERROR_USERNAME_INVALID;
		else if($user->password !== md5($this->password) )
			$this->errorCode = self::ERROR_PASSWORD_INVALID;
		else if($user->status == 0){
            $this->errorCode = self::ERROR_STATUS_NOTACTIV;
		} else {
            $this->_email = $user->email;
            $this->_id = $user->id;
            $this->setState('role', $user->role_id);
            $this->setState('user_type', $user->user_type);
            $this->setState('customer_code', $user->customer_code);
            $this->errorCode = self::ERROR_NONE;
		}
		return !$this->errorCode;
	}
    
    /**
	 * Returns the unique identifier for the identity.
	 * The default implementation simply returns {@link username}.
	 * This method is required by {@link IUserIdentity}.
	 * @return string the unique identifier for the identity.
	 */
	public function getId()
	{
		return $this->_id;
	}

	/**
	 * Returns the display name for the identity.
	 * The default implementation simply returns {@link username}.
	 * This method is required by {@link IUserIdentity}.
	 * @return string the display name for the identity.
	 */
	public function getName()
	{
		return $this->_email;
	}
}