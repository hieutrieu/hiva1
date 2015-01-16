<?php

class AdminModule extends CWebModule {
    public $assetsDirectory;
	public $adminHomeUrl;
    public $adminLoginUrl;
    static $_users = null;
	public function init() {
		// this method is called when the module is being created
		// you may place code here to customize the module or the application

		// import the module-level models and components
		$this->setImport(array(
			'admin.models.*',
			'admin.components.*',
		));
        $this->adminHomeUrl = '/admin';
        Yii::app()->setComponents(
			array(
                'messages' => array(
				    'basePath'=>'protected/modules/admin/messages',
                ),
                'user' => array (
                    'loginUrl' => array(
                        '/admin/auth/login'
                    ),
                    'allowAutoLogin' => true,
                ),
                'errorHandler' => array(
                    'errorAction' => '/admin/error/error'
                )
        ));
	}

	public function beforeControllerAction($controller, $action) {
		if(parent::beforeControllerAction($controller, $action))
		{
			// this method is called before any module controller action is performed
			// you may place customized code here
			return true;
		}
		else
			return false;
	}
    public static function listAdmin() {
        if(self::$_users == null) {
            $data = Yii::app()->db->createCommand()
                        ->select('id, username, email')
                        ->from('users')
                        ->where('status = :status AND role_id IN(1)', array(':status' => 1))
                        ->queryAll();
            foreach($data as $row){
                self::$_users[] = $row['email'];
            }
        }
        return self::$_users;
    }
}
