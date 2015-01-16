<?php

class NewsController extends AdminController {
	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
     
    public function actionNew() {
		$model = new News();
		Yii::app()->session['id'] = 0;
		$this->render('edit', array(
			'model' => $model,
		));

	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id, 'News');
        Yii::app()->session['id'] = $id;
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['News']))
		{
			$model->attributes=$_POST['News'];
			if($model->save())
				$this->redirect(array('index'));
		}

		$this->render('edit',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id, 'News')->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Manages all models.
	 */
	public function actionIndex()
	{
		$model=new News('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['News']))
			$model->attributes=$_GET['News'];

		$this->render('index',array(
			'model'=>$model,
		));
	}

    
    public function actionSave() {	
		if (Yii::app()->getRequest()->getIsPostRequest()) {
			$news = Yii::app()->getRequest()->getPost('News', array());	
			if(Yii::app()->session['id']) {
				$model = $this->loadModel(Yii::app()->session['id'], 'News');
			} else {
				$model = new News();
			}
            
			$model->setAttributes($news);
            
            $model->thumbnail = str_replace(Yii::getPathOfAlias('webroot'), '', $model->thumbnail);
            $model->image = str_replace(Yii::getPathOfAlias('webroot'), '', $model->image);
            
			if ($model->save()) {
				Yii::app()->user->setFlash('success', $this->t('Save successfull.'));
                unset(Yii::app()->session['id']);
                $this->redirect(array('index'));									
			} else {
				Yii::app()->user->setFlash('error', $this->t('Save can\'t successfull.'));
                $this->render('edit', array('model' => $model));
			}						
		}	
	}
    
    public function actionInsertTest() {
        //$loremIpsum = LoremIpsum::getInstance();
        for($i=1; $i < 100; $i++) {
            $loremIpsum = new LoremIpsum();
            $model = new News();
            $pt = rand(1, 5);
            $pthumb = 'p_t'.$pt.'.png';
            $pimage = 'p_l'.$pt.'.png';
            $product = array(
                'id' => 0,
                'category_id' => rand(2, 4),
                'title' => $loremIpsum->getContent(rand(2, 8), 'plain', false),
                'description' => $loremIpsum->getContent(rand(20, 50)),
                'content' => $loremIpsum->getContent(rand(200, 800)),
                'thumbnail' => '/images/images/products/'. $pthumb,
                'image' => '/images/images/products/'. $pimage,
                'created_at' => new CDbExpression('NOW()'),
                'updated_at' => new CDbExpression('NOW()'),
                
            );
            $model->setAttributes($product);
            $model->save();
        }
    }
}
