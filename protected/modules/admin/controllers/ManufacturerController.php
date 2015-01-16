<?php

class ManufacturerController extends AdminController {
		
	public function actionSave() {		
		if (Yii::app()->getRequest()->getIsPostRequest()) {
			$manufacturer = Yii::app()->getRequest()->getPost('ShopManufacturer', array());			
			if(Yii::app()->session['id']) {
				$model = $this->loadModel(Yii::app()->session['id'], 'ShopManufacturer');
			} else {
				$model = new ShopManufacturer();
			}

			$model->setAttributes($manufacturer);
            
			if ($model->save()) {
                Yii::app()->user->setFlash('success', $this->t('Save successfull.'));	
                unset(Yii::app()->session['id']);
                $this->redirect(array('index'));							
			} else {
				Yii::app()->user->setFlash('success', $this->t('Save can\'t successfull.'));
                $this->render('edit', array('model' => $model));
			}						
		}	
	}
	
    public function actionNew() {
		$model = new ShopManufacturer();
		Yii::app()->session['id'] = 0;
		$this->render('edit', array(
			'model' => $model,
		));

	}
    
	public function actionEdit($id = 0) {
		$this->pageTitle = $this->t('Edit Manufacturer');
		if ($id || Yii::app()->getRequest()->getIsPostRequest()) {
			$cid = Yii::app()->getRequest()->getPost('cid', array());
			if(count($cid)) {
				$id = $cid[0];
			} 		
			
			if($id){	
				$model = $this->loadModel($id, 'ShopManufacturer');				
				Yii::app()->session['id'] = $id;
			} else {
				$model = new ShopManufacturer();
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
			$model = new ShopManufacturer();
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
		$model = new ShopManufacturer('search');
		$model->unsetAttributes();
		$this->setPageTitle(yii::t('app', 'Manufacturer list'));
		if (isset($_GET['ShopManufacturer']))
			$model->setAttributes($_GET['ShopManufacturer']);
				
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
            ($model->$attribute == 1) ? $model->$attribute = 0 : $model->$attribute = 1;
            $model->save();
            // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
            if (!isset($_GET['ajax']))
                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('/index'));
        }
		return false;
	}
}