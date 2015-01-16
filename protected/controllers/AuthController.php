<?php

class AuthController extends Controller {
	public function actionRegister() {
        if(Yii::app()->user->isGuest) {
            $this->pageTitle = Yii::t('app', 'Register');
            $this->breadcrumbs = null;
    		$model = new RegisterForm;
            if(isset($_POST['RegisterForm'])) {
    			$model->attributes=$_POST['RegisterForm'];
    			if($model->validate()) {
                    $userModel = new Users;
                    $user = Yii::app()->getRequest()->getPost('RegisterForm', array());	
                    $user['fullname'] = $user['last_name'] .' '. $user['first_name'];
                    $pasword = $user['password'];
                    $user['password'] = md5($user['password']);
                    $datebirth = str_replace('/', '-', $user['date_birth']);
                    $date = new DateTime($datebirth);
                    $user['date_birth'] = $date->format('Y-m-d H:i:s');
                    $userModel->setAttributes($user);
                    if($userModel->validate()) {
                        $userModel->save();
                    }
                    if($userModel->getErrors()) {
                        $model->addErrors($userModel->getErrors());
                    } else {
                        // Auto login 
                        $loginModel = new LoginForm;
                        $loginModel->attributes = array(
                            'email' => $user['email'],
                            'password' => $pasword,
                        );
                        if($loginModel->validate() && $loginModel->login()) {
                            //Helper::mailsend($model->email, $model->email, $subject, $model->body);
            				Yii::app()->user->setFlash('register', Yii::t('app', 'Register successfully.'));
                            $this->redirect(Yii::app()->homeUrl);
                        } else {
                            $model->addErrors($loginModel->getErrors());
                        }
    				    //$this->refresh();
                    }
    			}
    		}
            $this->render('register', array('model' => $model));
        }
	}
    
    /**
	 * Displays the login page
	 */
	public function actionLogin() {
        if(!Yii::app()->user->isGuest) {
            $this->redirect(Yii::app()->homeUrl);
        }
        $model = new LoginForm;
        if (Yii::app()->getRequest()->getIsPostRequest()) {
            $loginData = Yii::app()->getRequest()->getPost('LoginForm', array());
    		// collect user input data
    		if(isset($loginData)){
    			$model->attributes = $loginData;
    			// validate user input and redirect to the previous page if valid
    			if($model->validate() && $model->login()) {
                    $this->redirect(Yii::app()->homeUrl);
    			} else {
                    Yii::app()->user->setFlash('error', Yii::t('app', 'Email or password do not match or you do not have an account yet.'));
    			}
    		}
        }
		// display the login form
		$this->render('login',array('model'=>$model));
	}
    
    
    /**
	 * Displays the fotgot page
	 */
	public function actionForgotpassword() {
        if(!Yii::app()->user->isGuest) {
            $this->redirect(Yii::app()->homeUrl);
        }
        $model = new ForgotForm;
        if (Yii::app()->getRequest()->getIsPostRequest()) {
            $forgotData = Yii::app()->getRequest()->getPost('ForgotForm', array());
    		// collect user input data
    		if(isset($forgotData)){
    			$model->attributes = $forgotData;
    			// validate user input and redirect to the previous page if valid
    			if($model->validate()) {
                    $userModel = Users::model()->findByAttributes(array('email' => $model->email));
                    if($userModel) {
                        $userModel->token = md5($userModel->email);
                        if($userModel->save()) {
                            $email = Yii::app()->email;
                            $email->to = Yii::app()->params['adminEmail'];
                            $email->from = $model->email;
                            $email->replyTo = $model->email;
                            $email->subject = Yii::t('app', 'Forgot password');
                            $email->view = 'forgot';
                            $link = Yii::app()->createAbsoluteUrl('auth/changepass', array('token' => $userModel->token));
                            $email->viewVars = array('name'=>$userModel->fullname, 'link'=>$link);
                            $send = $email->send();
                            Yii::app()->user->setFlash('error', Yii::t('app', 'The system sends information to your email. Please check your email and follow the instructions and create a password.'));
                        } else {
                            //debug($userModel->getErrors());
                        }
                    } else {
                        Yii::app()->user->setFlash('error', Yii::t('app', 'This email does not exist in the system.'));
                    }
                    
    			} else {
                    Yii::app()->user->setFlash('error', Yii::t('app', 'Email do not match.'));
    			}
    		}
        }
		// display the login form
		$this->render('forgotpassword',array('model'=>$model));
	}
    
    public function actionChangepass($token) {
        if(!Yii::app()->user->isGuest) {
            $this->redirect(Yii::app()->homeUrl);
        }
        $model = new ChangepassForm;
        
        if (Yii::app()->getRequest()->getIsPostRequest()) {
            $changePassData = Yii::app()->getRequest()->getPost('ChangepassForm', array());
    		// collect user input data
    		if(isset($changePassData)){
    			$model->attributes = $changePassData;
    			// validate user input and redirect to the previous page if valid
    			if($model->validate()) {
                    $user = Users::model()->findByAttributes(array('token' => $token));
                    if($user) {
                        $user->token = '';
                        $user->password = md5($model->new_password);
                        if($user->validate()) {
                            if($user->save()) {
                                Yii::app()->user->setFlash('error', Yii::t('app', 'Your password has been changed, please log in with your new password.'));
                            }
                        } else {
                            //debug($user->getErrors());
                        }
                    } else {
                        Yii::app()->user->setFlash('error', Yii::t('app', 'Token we provide you Invalid.'));
                    }
                    
    			} else {
                    Yii::app()->user->setFlash('error', $model->getError('new_password'));
    			}
    		}
        }
        // display the login form
		$this->render('changePass',array('model'=>$model));
    }
    
    /**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout(){
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
    
    public function actionProfile($id) {
        if(!Yii::app()->user->isGuest) {
            $user = Users::model()->findByPk($id);
            $this->render('profile', array('user' => $user));
        }
    }
    
    public function actionEditprofile($id) {
        $user = Users::model()->findByPk($id);
        $model = new EditProfileForm;
        if (Yii::app()->getRequest()->getIsPostRequest()) {
            $userData = Yii::app()->getRequest()->getPost('EditProfileForm', array());
            $model->attributes = $userData;
            if($model->validate()) {
                if($userData['password'] != '') {
                    $userData['password'] = md5($userData['password']);
                } else {
                    unset($userData['password']);
                }
                $user->setAttributes($userData);
                if($user->validate()) {
                    $user->save();
                    Yii::app()->user->setFlash('register', Yii::t('app', 'Updated successfully.'));
                } elseif($user->getErrors()) {
                    $model->addErrors($user->getErrors());
                }
            }
        }	
        $model->setAttributes($user->getAttributes());
        $model->password = '';
        $model->repassword = '';
        
        $this->render('editprofile', array('model' => $model));
    }
    
    public function actionNotify() {
        if(!Yii::app()->user->isGuest) {
            $notifies = Notify::allNotify();
            $this->render('notify', array('notifies' => $notifies));
        }
    }
    
    public function actionNotifydetail($id) {
        if(!Yii::app()->user->isGuest) {
            $notify = Notify::getNotify($id);
            $this->render('notifyDetail', array('notify' => $notify));
        }
    }
    
    public function actionOrderhistory() {
        if(!Yii::app()->user->isGuest) {
            $orders = ShopOrder::getAllOrder();
            $this->render('orderhistory', array('orders' => $orders));
        }
    }
}