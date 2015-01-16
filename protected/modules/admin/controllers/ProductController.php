<?php

class ProductController extends AdminController {
	public function actionSave() {		
		if (Yii::app()->getRequest()->getIsPostRequest()) {
			$product = Yii::app()->getRequest()->getPost('ShopProduct', array());
			if(Yii::app()->session['id']) {
				$model = $this->loadModel(Yii::app()->session['id'], 'ShopProduct');
			} else {
				$model = new ShopProduct();
			}
			$model->setAttributes($product);
            $model->thumbnail = str_replace(Yii::getPathOfAlias('webroot'), '', $model->thumbnail);
            //$model->image = str_replace(Yii::getPathOfAlias('webroot'), '', $model->image);
            
            $images = array();
            foreach($model->image as $image) {
                if($image != '') {
                    $images[] = $image;
                }
            }

            $model->image = json_encode($images);
			if ($model->save()) {
                if(isset($product['shopFeatures']) && is_array($product['shopFeatures'])) {
                    // Update feature
                    if(Yii::app()->session['id']) {
                        $model->updateFeatures($model->id, $product['shopFeatures']);
                    } else {
                        $model->insertFeatures($model->id, $product['shopFeatures']);
                    }
                }
                
				Yii::app()->user->setFlash('success', $this->t('Save successfull.'));		
                unset(Yii::app()->session['id']);
                $this->redirect(array('index'));						
			} else {
				Yii::app()->user->setFlash('error', $this->t('Save can\'t successfull.'));
                $this->render('edit', array('model' => $model));
			}						
		}	
	}
	
	public function actionEdit($id = 0) {
		if ($id || Yii::app()->getRequest()->getIsPostRequest()) {
			$cid = Yii::app()->getRequest()->getPost('cid', array());
			if(count($cid)) {
				$id = $cid[0];
			} 		
			
			if($id){	
				$model = $this->loadModel($id, 'ShopProduct');				
				Yii::app()->session['id'] = $id;
			} else {
				$model = new ShopProduct();
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
		$model = new ShopProduct();
		Yii::app()->session['id'] = 0;
		$this->render('edit', array(
			'model' => $model,
		));

	}

	public function actionDelete() {
		if (Yii::app()->getRequest()->getIsPostRequest()) {
			$cid = Yii::app()->getRequest()->getPost('cid', array());
			$model = new ShopProduct();
            foreach($cid as $pid) {
                Yii::app()->db->createCommand()->delete('shop_product_feature', 'product_id=:id', array(':id' => $pid));
            }
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
		$model = new ShopProduct('search');
		$model->unsetAttributes();
		$this->setPageTitle(yii::t('app', 'Product Manager'));
		if (isset($_GET['ShopProduct']))
			$model->setAttributes($_GET['ShopProduct']);
				
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
    
    public function actionInsertTest() {
        //$loremIpsum = LoremIpsum::getInstance();
        for($i=1; $i < 100; $i++) {
            $loremIpsum = new LoremIpsum();
            $model = new ShopProduct();
            
            $pt = rand(1, 5);
            $pthumb = 'p_t'.$pt.'.png';
            $pimage = 'p_l'.$pt.'.png';
            $product = array(
                'id' => 0,
                'category_id' => rand(2, 8),
                'title' => $loremIpsum->getContent(rand(2, 4), 'plain', false),
                'description' => $loremIpsum->getContent(rand(100, 800)),
                'thumbnail' => '/images/images/products/'. $pthumb,
                'image' => '/images/images/products/'. $pimage,
                'price' => rand(2,8) * rand(200000, 1000000),
                'tax_id' => 1,
                'language' => 'vi',
                
            );
            $model->setAttributes($product);
            $model->save();
        }
    }
    
    public function actionHot() {
		$viewDefault = 'hot';
		if($this->pageAjax) {			
			$viewDefault = 'model_'.$viewDefault;
		}
		$model = new ShopProduct('search');
		$model->unsetAttributes();
		$this->setPageTitle(yii::t('app', 'Product Hot Manager'));
		if (isset($_GET['ShopProduct'])) $model->setAttributes($_GET['ShopProduct']);
		$model->setAttribute('hot',1);
				
		$this->render($viewDefault, array(
			'model' => $model,
			'function' => $this->function,
			'pageAjax' => $this->pageAjax,
		));
	}
    
    public function actionRemovehot() {
		if (Yii::app()->getRequest()->getIsPostRequest()) {
			$cid = Yii::app()->getRequest()->getPost('cid', array());
			$model = new ShopProduct();
            $model->updateAll(array('hot' => 0), 'id IN ('. implode($cid, ',') .')');
			Yii::app()->user->setFlash('success', 'Remove successfull.');
		} else {
			Yii::app()->user->setFlash('error', 'Please select at least one record to remove.');
		}		
		$this->redirect(array('hot'));
	}
	
    public function actionAddhot() {
		if (Yii::app()->getRequest()->getIsPostRequest()) {
			$cid = Yii::app()->getRequest()->getPost('cid', array());
			$model = new ShopProduct();
            $model->updateAll(array('hot' => 1), 'id IN ('. implode($cid, ',') .')');
			Yii::app()->user->setFlash('success', 'Added successfull.');
		} else {
			Yii::app()->user->setFlash('error', 'Please select at least one record for add to hot.');
		}		
		$this->redirect(array('hot'));
	}
}