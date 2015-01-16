<?php
/*
 * User widget
 * @usage $this->widget('application.modules.admin.widgets.user', array('fieldName'=>'my_field'));
 *
 * @author: hieutrieu mrhieutrieu@gmail.com
 */
class Modal_User extends CInputWidget {
	public $name;
	public $id;
	public $fullname;
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
    		$fullname = User::model()->findByPk($this->value);
    		$this->fullname = $fullname->fullname;
    	}
        $this->render("modal_user", array(
    		'label' => $label,
    		'field' => $field,  
    		'name' => $this->name,
    		'id' => $this->id,        		
    		'value' => $this->value,  
    		'fullname' => $this->fullname,
    		'path' => $this->path,    
        ));
    }
}