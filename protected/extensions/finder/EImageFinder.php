<?php
/*
 * EImageFinder widget
 * Based on CKFinder (http://ckfinder.com/)
 *
 * @usage $this->widget('ext.finder.EImageFinder',array('fieldName'=>'my_field'));
 *
 * @author: Cassiano Surek <cass@surek.co.uk>
 */

class EImageFinder extends CInputWidget {
	private $uploadPath;
	private $uploadUrl;
    protected $path;

    public function init(){

		// Please change the config below to suit your needs
		$this->uploadPath = Yii::getPathOfAlias('webroot') .'/images/';
		//$this->uploadPath = dirname(Yii::app()->request->scriptFile) .'/images/';
		$this->uploadUrl = '/images/';  
		//$this->uploadUrl = Yii::getPathOfAlias('webroot') .'/images/';  
                
	   	// We need to make the CKFinder accessible, let's publish it to the assets folder
		$lo_am = new CAssetManager;
		$this->path = Yii::app()->getAssetManager()->publish(Yii::app()->basePath . '/extensions/finder/ckfinder2.1',true);
                
        //$this->path = Yii::app()->getAssetManager()->publish(Yii::app()->basePath.DIRECTORY_SEPARATOR.'extensions'.DIRECTORY_SEPARATOR.'ckeditor'.DIRECTORY_SEPARATOR.'assets/ckfinder', true);        
        
        // And save the upload path to use with ckfinder's config file. Passing as js param did not work...
		$lo_session=new CHttpSession;
	  	$lo_session->open();
	  	$lo_session['auth']=true;
	  	$lo_session['upload_path'] = $this->uploadPath;
	  	$lo_session['upload_url'] = $this->uploadUrl;
        parent::init();
    }

    public function run() {
    	list($name, $id) = $this->resolveNameID();
        $this->render("ckfinder", array(
                'name'=>$name,
                'path'=>$this->path,
        		'id' => $id,
            ));
            
    }
}