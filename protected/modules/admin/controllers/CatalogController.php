<?php

class CatalogController extends AdminController {
	public function actionSave() {		
		if (Yii::app()->getRequest()->getIsPostRequest()) {
			$catalog = Yii::app()->getRequest()->getPost('ShopCategory', array());			
			if(Yii::app()->session['id']) {
				$model = $this->loadModel(Yii::app()->session['id'], 'ShopCategory');
			} else {
				$model = new ShopCategory();
			}
			$model->setAttributes($catalog);
			
			if (isset($catalog['parent_id']) && $catalog['parent_id'] > 0) {     
                $root = ShopCategory::model()->findByPk($catalog['parent_id']);
                $root->level++;
                if ($model->moveAfter($root)) {
    				Yii::app()->user->setFlash('success', $this->t('Save successfull.'));								
    			} else {
    				Yii::app()->user->setFlash('success', $this->t('Save can\'t successfull.'));
    			}
			} else {
                $root = ShopCategory::model()->findByPk(1);
                if ($model->appendTo($root)) {
    				Yii::app()->user->setFlash('success', $this->t('Save successfull.'));								
    			} else {
    				Yii::app()->user->setFlash('success', $this->t('Save can\'t successfull.'));
    			}
			}
            $model->image = str_replace(Yii::getPathOfAlias('webroot'), '', $model->image);
									
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
				$model = $this->loadModel($id, 'ShopCategory');				
				Yii::app()->session['id'] = $id;
			} else {
				$model = new ShopCategory();
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
		$model = new ShopCategory();
		Yii::app()->session['id'] = 0;
		$this->render('edit', array(
			'model' => $model,
		));

	}

	public function actionDelete() {
		if (Yii::app()->getRequest()->getIsPostRequest()) {
			$cid = Yii::app()->getRequest()->getPost('cid', array());
			$model = new ShopCategory();
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
        $model=ShopCategory::model()->findAll();
		$model = new ShopCategory('search');
		$model->unsetAttributes();
		$this->setPageTitle(yii::t('app', 'Catalog Manager'));
		if (isset($_GET['ShopCategory']))
			$model->setAttributes($_GET['ShopCategory']);
        $model->setAttribute('id', '>1');
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