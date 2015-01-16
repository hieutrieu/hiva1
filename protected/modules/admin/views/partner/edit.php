<?php
$this->button = array(	
	array('label' => Yii::t('app', 'Save'), 'url'=>array('save'), 'htmlOptions' => array('class' => 'fa fa-save', 'id' => 'save-button')),
	array('label' => Yii::t('app', 'Cancel'), 'url'=>array('index'), 'htmlOptions' => array('class' => 'fa fa-times-circle-o', 'id' => 'cancel-button')),
);
$this->renderPartial('_form', array(
		'model' => $model));
?>