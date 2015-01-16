<?php

class SiteController extends Controller
{
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex() {
        $this->layout='webroot.themes.hieutam.home';
        $this->pageTitle = Yii::t('app', 'Home');
        $this->breadcrumbs = null;
		$this->render('index');
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}

	/**
	 * Displays the contact page
	 */
	public function actionContact(){
        $this->pageTitle = Yii::t('app', 'Contact Us');
        $this->breadcrumbs = null;
		$model=new ContactForm;
		if(isset($_POST['ContactForm'])) {
			$model->attributes=$_POST['ContactForm'];
			if($model->validate()) {
                $email = Yii::app()->email;
                $email->to = Yii::app()->params['adminEmail'];
                $email->from = $model->email;
                $email->replyTo = $model->email;
                $email->subject = $model->subject;
                $email->view = 'contact';
                $email->viewVars = array('name'=>$model->name, 'body'=>$model->body);
                $send = $email->send();
				/*$name='=?UTF-8?B?'.base64_encode($model->name).'?=';
				$subject='=?UTF-8?B?'.base64_encode($model->subject).'?=';
				$headers="From: $name <{$model->email}>\r\n".
					"Reply-To: {$model->email}\r\n".
					"MIME-Version: 1.0\r\n".
					"Content-Type: text/plain; charset=UTF-8";

				//mail(Yii::app()->params['adminEmail'],$subject,$model->body,$headers);
                
                //Helper::mailsend(Yii::app()->params['adminEmail'], $model->email, $subject, $model->body);
                */
				Yii::app()->user->setFlash('contact', Yii::t('app', 'Thank you for contacting us. We will respond to you as soon as possible.'));
				$this->refresh();
			}
		}
		$this->render('contact',array('model'=>$model));
	}
    
    public function actionAbout() {
        $newsModel = new News;
        $this->pageTitle = Yii::t('app', 'About');
        $news = $newsModel->getNewsAbout();
        $this->render('about', array('news' => $news));
    }
    public function actionService() {
        $newsModel = new News;
        $this->pageTitle = Yii::t('app', 'Service');
        $news = $newsModel->getNewsService();
        $this->render('service', array('news' => $news));
    }
    
    public function actionTerm() {
        $this->pageTitle = Yii::t('app', 'terms of use');
        $newsModel = new News;
        $news = $newsModel->getNewsTerm();
        $this->render('term', array('news' => $news));
    }
    
    public function actionTest() {
        $email = Yii::app()->email;
        $email->to = 'mrhieutrieu@gmail.com';
        $email->from = 'tamhieu@ns89119.dotvndns.vn';
        $email->subject = 'Tam Hieu - '. Yii::t('app', 'Register');
        $email->view = 'contact';
        $email->viewVars = array('name'=>'Trieu Trung Hieu','body'=>'khongbiet');
        $send = $email->send();
        $this->renderText($send);
    }
    
    public function actionSetting() {
        Yii::app()->settings->set('Social', 'google', 'https://google.com.vn', true); 
        Yii::app()->settings->set('Social', 'twitter', 'https://twitter.com', true); 
        Yii::app()->settings->set('Social', 'facebook', 'https://facebook.com', true); 
        Yii::app()->settings->set('Social', 'youtube', 'https://youtube.com', true); 
        echo Yii::app()->settings->get('Social', 'google'); 
    }
}