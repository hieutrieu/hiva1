<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity {
    public $id;
    public $email;
    public $user_type;
    public $customer_code;
    
    public function __construct($email, $password){
		$this->email = $email;
		$this->password = $password;
	}
    
	/**
	 * Authenticates a user.
	 * The example implementation makes sure if the username and password
	 * are both 'demo'.
	 * In practical applications, this should be changed to authenticate
	 * against some persistent user identity storage (e.g. database).
	 * @return boolean whether authentication succeeds.
	 */
	public function authenticate() {
		$user = null;
        $user = Users::model()->findByAttributes(array('email'=>$this->email, 'password' => md5($this->password)));
		if($user == null)
			$this->errorCode = self::ERROR_USERNAME_INVALID;
		else if($user->password !== md5($this->password) )
			$this->errorCode = self::ERROR_PASSWORD_INVALID;
		else if($user->status == 0){
            $this->errorCode = self::ERROR_STATUS_NOTACTIV;
		} else {
            $this->errorCode = self::ERROR_NONE;
            $this->username         = $user->fullname;
            $this->id               = $user->id;
            $this->user_type        = $user->user_type;
            $this->customer_code    = $user->customer_code;
            $this->setState('email', $user->email);
            $this->setState('user_type', $user->user_type);
            $this->setState('customer_code', $user->customer_code);
            
		}
		return !$this->errorCode;
	}
    
    public function getId() {
		return $this->id;
	}

	/**
	 * Returns the display name for the identity.
	 * The default implementation simply returns {@link username}.
	 * This method is required by {@link IUserIdentity}.
	 * @return string the display name for the identity.
	 */
	public function getName() {
		return $this->username;
	}
}