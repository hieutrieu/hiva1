<?php

class CategoryController extends AdminController {
	public function actionSave() {		
		if (Yii::app()->getRequest()->getIsPostRequest()) {
			$category = Yii::app()->getRequest()->getPost('Category', array());			
			if(Yii::app()->session['id']) {
				$model = $this->loadModel(Yii::app()->session['id'], 'Category');
			} else {
				$model = new Category();
				//pushing newly added item to last
	            $maxRight = $model->getMaxRight();
	            $model->lft = $maxRight + 1;
	            $model->rgt = $maxRight + 2;
			}
			$model->setAttributes($_POST['Category']);
			
			if (isset($_POST['Category']['parent_id']) && $_POST['Category']['parent_id'] > 0) {                
				$modelCategory = $this->loadModel($_POST['Category']['parent_id'], 'Category');
				$model->level = $modelCategory->level + 1;
				$model->lft = $modelCategory->rgt + 1;
	            $model->rgt = $modelCategory->rgt + 2;
			} else {
				$model->level = 1;
			}
            
            $model->image = str_replace(Yii::getPathOfAlias('webroot'), '', $model->image);
            
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
		if ($id || Yii::app()->getRequest()->getIsPostRequest()) {
			$cid = Yii::app()->getRequest()->getPost('cid', array());
			if(count($cid)) {
				$id = $cid[0];
			} 		
			
			if($id){	
				$model = $this->loadModel($id, 'Category');				
				Yii::app()->session['id'] = $id;
			} else {
				$model = new Category();
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
    
    public function actionNew() {
		$model = new Category();
		Yii::app()->session['id'] = 0;
		$this->render('edit', array(
			'model' => $model,
		));

	}

	public function actionDelete() {
		if (Yii::app()->getRequest()->getIsPostRequest()) {
			$cid = Yii::app()->getRequest()->getPost('cid', array());
			$model = new Category();
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
		$model = new Category('search');
		$model->unsetAttributes();
		$this->setPageTitle(yii::t('app', 'Category Manager'));
		if (isset($_GET['Category']))
			$model->setAttributes($_GET['Category']);
				
		$this->render($viewDefault, array(
			'model' => $model,
			'function' => $this->function,
			'pageAjax' => $this->pageAjax,
		));
	}
	
	public function actionToggle($id, $attribute, $model) {
		if (Yii::app()->request->isPostRequest) {
            // we only allow deletion via POST request
            $model = $this->loadModel($id, $model);
            //loadModel($id, $model) from giix
            ($model->$attribute == 1) ? $model->$attribute = 0 : $model->$attribute = 1;
            $model->save();

            // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
            if (!isset($_GET['ajax']))
                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('/index'));
        }
		return false;
	}
	
}