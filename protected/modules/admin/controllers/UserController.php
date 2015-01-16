<?php

class UserController extends AdminController {
		
	public function actionSave() {		
		if (Yii::app()->getRequest()->getIsPostRequest()) {
			$user = Yii::app()->getRequest()->getPost('Users', array());			
			if(Yii::app()->session['id']) {
				$model = $this->loadModel(Yii::app()->session['id'], 'User');
			} else {
				$model = new User();
			}
            if($user['password'] != '') {
                $user['password'] = md5($user['password']);
            } else {
                unset($user['password']);
            }
			$model->setAttributes($user);
            
			if ($model->save()) {
				Yii::app()->user->setFlash('success', $this->t('Save successfull.'));								
			} else {
				Yii::app()->user->setFlash('success', $this->t('Save can\'t successfull.'));
			}						
		}	
		unset(Yii::app()->session['id']);
		$this->redirect(array('index'));	
	}
	
	public function actionEdit($id = 0) {
		$this->pageTitle = $this->t('Edit User');
		if ($id || Yii::app()->getRequest()->getIsPostRequest()) {
			$cid = Yii::app()->getRequest()->getPost('cid', array());
			if(count($cid)) {
				$id = $cid[0];
			} 		
			
			if($id){	
				$model = $this->loadModel($id, 'Users');				
				Yii::app()->session['id'] = $id;
			} else {
				$model = new Users();
				Yii::app()->session['id'] = 0;
			}
			$this->render('edit', array(
				'model' => $model,
			));
		} else {
			Yii::app()->user->setFlash('warning', $this->t('Access denied.'));
			$this->redirect(array('index'));
		}	
	}

	public function actionDelete() {
		if (Yii::app()->getRequest()->getIsPostRequest()) {
			$cid = Yii::app()->getRequest()->getPost('cid', array());
			$model = new Users();
			$model->deleteAll('id IN ('. implode($cid, ',') .')');
			Yii::app()->user->setFlash('success', 'Delete successfull.');
		} else {
			Yii::app()->user->setFlash('error', 'Please select at least one record to delete.');
		}		
		$this->redirect(array('index'));
	}

	public function actionIndex() {
		$viewDefault = 'index';
		if($this->pageAjax) {			
			$viewDefault = 'model_'.$viewDefault;
		}
		$model = new Users('search');
		$model->unsetAttributes();
        $model->setAttribute('role_id', 2);
		$this->setPageTitle(yii::t('app', 'Customer List'));
		if (isset($_GET['Users']))
			$model->setAttributes($_GET['Users']);
				
		$this->render($viewDefault, array(
			'model' => $model,
			'function' => $this->function,
			'pageAjax' => $this->pageAjax,
		));
	}
    
    public function actionView($id) {
		$this->pageTitle = $this->t('View user information');
		$model = $this->loadModel($id, 'Users');
        $this->render('view', array('model' => $model));
	}
	
	public function actionToggle($id, $attribute, $model) {
		if (Yii::app()->request->isPostRequest) {
            // we only allow deletion via POST request
            $model = $this->loadModel($id, $model);
            ($model->$attribute == 1) ? $model->$attribute = 0 : $model->$attribute = 1;
            $model->save();
            // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
            if (!isset($_GET['ajax']))
                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('/index'));
        }
		return false;
	}
    
    public function actionGenaratecode() {
        $this->pageTitle = $this->t('Genarate User code');
        
        $criteria = new CDbCriteria();
        $criteria->condition = "t.role_id = 2";
        $users = Users::model()->findAll($criteria);
        $sql = "UPDATE users SET customer_code = CASE id \n";
        foreach($users as $user) {
            $ids[] = $user->id;
            $sql .= " WHEN ". $user->id ." THEN '". AdminHelper::genarateCode($user). "' \n";
        }
        $sql .= " END WHERE id IN (". implode(',', $ids) .")";
        Yii::app()->db->createCommand($sql)->execute();
        Yii::app()->user->setFlash('success', $this->t('Customer code has been created.'));
        $this->redirect('index');
    }
	
}