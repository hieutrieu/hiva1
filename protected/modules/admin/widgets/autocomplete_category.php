<?php
/*
 * Modal Category widget
 * @usage $this->widget('application.modules.admin.widgets.modal_category', array('fieldName'=>'my_field'));
 *
 * @author: hieutrieu mrhieutrieu@gmail.com
 */
class Autocomplete_Category extends CInputWidget {
	public $name;
	public $id;
	public $title;
	protected $path;
    public function init() {
                
        $this->path = Yii::app()->getAssetManager()->publish(Yii::app()->basePath.DIRECTORY_SEPARATOR.'modules'.DIRECTORY_SEPARATOR.'admin'.DIRECTORY_SEPARATOR.'widgets'.DIRECTORY_SEPARATOR.'assets', true);        
       
        parent::init();
    }

    public function run() {
    	$ids = $this->value != '' ? $this->value : 0;
    	$categories = Yii::app()->db->createCommand()
        ->select('CONCAT("<span>", title, "</span>") title')
        ->from(array('tbl_categories'))
        ->where('id IN ('. $ids .')')
        ->queryColumn();
    	if(is_array($categories)) echo '<div class="autoComplete">'. implode('', $categories) .'</div>'; 
    }
}