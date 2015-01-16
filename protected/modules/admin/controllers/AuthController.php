<?php

class AuthController extends AdminController
{
	public function actionLogout() {
		Yii::app()->user->logout();
		$this->redirect($this->module->adminLoginUrl);
	}
	
	public function actionLogin() {
        if(!Yii::app()->user->isGuest) {
            $this->redirect($this->module->adminHomeUrl);
        }
		$this->layout = 'webroot.themes.admin.login';
        $model = new AdminLoginForm;
		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
            echo CActiveForm::validate($model);
			Yii::app()->end();
		}
        
		// collect user input data
		if(isset($_POST['AdminLoginForm']))
		{
			$model->attributes = $_POST['AdminLoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login()) {
				$this->redirect($this->module->adminHomeUrl);
            } else {
                //Yii::app()->user->setFlash('error', $this->t('Username and password do not match or you do not have an account yet.')); 
            }
		}
		// display the login form
		$this->render('login', array(
            'model' => $model
        ));
	}
}