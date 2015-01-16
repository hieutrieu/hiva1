<?php

class NewsletterController extends Controller {
	/**
	 * Displays the contact page
	 */
	public function actionSubscribe(){
        $this->pageTitle = Yii::t('app', 'Contact Us');
        $this->breadcrumbs = null;
        $data = array('msg' => '', 'error' => 1);
		$model = new Newsletter;
		if (Yii::app()->getRequest()->getIsPostRequest()) {
			$model->setAttribute('email', $_POST['email']);
			if($model->validate()) {
                if($model->save()) {
                    $email = Yii::app()->email;
                    $email->to = Yii::app()->params['adminEmail'];
                    $email->from = $model->email;
                    $email->replyTo = $model->email;
                    $email->subject = 'Newsletter';
                    $email->view = 'contact';
                    $email->viewVars = array('name'=>$model->email, 'body'=>'aaaaaaaaaaaa');
                    $send = $email->send();
                    $data = array('msg' => Yii::t('app', 'Thank you. You are now subscribed to our newsletter.'), 'error' => 0);
                }
			} else {
                $data = array('msg' => Yii::t('app', 'This email you have registered.'), 'error' => 1);
			}
		}
        echo json_encode($data);
        Yii::app()->end();        
	}
}