<?php

class ErrorController extends AdminController
{
	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest) {
				echo $error['message'];
			} else {
                $this->render('error', $error);
			}				
		}
	}  
    
    public function filteraccessControl($filterChain) {
        //Yii::app()->user->logout();
        //$this->redirect($this->module->adminLoginUrl);
        $filterChain->run();
    }
}