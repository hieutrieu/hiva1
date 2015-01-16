<?php
$this->subMenu = array(
	array('label' => Yii::t('app', 'User Manager'), 'url'=>array('index')),
);
$this->button = array(	
	array('label' => Yii::t('app', 'Save'), 'url'=>array('save'), 'htmlOptions' => array('class' => 'icon-32-save', 'id' => 'save-button')),
	array('label' => Yii::t('app', 'Cancel'), 'url'=>array('index'), 'htmlOptions' => array('class' => 'icon-32-cancel', 'id' => 'cancel-button')),
);
?>

<?php
$this->renderPartial('_form', array(
		'model' => $model));
?>