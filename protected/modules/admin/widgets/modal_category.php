<?php
/*
 * Modal Category widget
 * @usage $this->widget('application.modules.admin.widgets.modal_category', array('fieldName'=>'my_field'));
 *
 * @author: hieutrieu mrhieutrieu@gmail.com
 */
class Modal_Category extends CInputWidget {
	public $name;
	public $id;
	public $categoryTitle = '';
	protected $path;
    public function init() {
                
        $this->path = Yii::app()->getAssetManager()->publish(Yii::app()->basePath.DIRECTORY_SEPARATOR.'modules'.DIRECTORY_SEPARATOR.'admin'.DIRECTORY_SEPARATOR.'widgets'.DIRECTORY_SEPARATOR.'assets', true);        
       
        parent::init();
    }

    public function run() {
    	$this->htmlOptions['value'] = $this->value;
    	$this->name = CHtml::activeName($this->model, $this->attribute, $this->htmlOptions);
    	$field = CHtml::activeHiddenField($this->model, $this->attribute, $this->htmlOptions);
    	$label = CHtml::activeLabel($this->model, $this->attribute);
    	$this->id = CHtml::getIdByName($this->name);
    	if($this->value) {
    		$title = Category::model()->findByPk($this->value);
    		$this->categoryTitle = $title;
    	}
        $this->render("modal_category", array(
        		'label' => $label,
        		'field' => $field,  
        		'name' => $this->name,
        		'id' => $this->id,        		
        		'value' => $this->value,  
        		'title' => $this->categoryTitle,
        		'path' => $this->path,    
            ));
    }
}