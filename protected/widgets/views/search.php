<?php 
    $form=$this->beginWidget('CActiveForm', array(
    	'id'=>'contact-form',
        'method' => 'GET',
        'action' => Link::productSearch(),
    	'enableClientValidation'=>true,
    	'clientOptions'=>array(
    		'validateOnSubmit'=>true,
    	),
    )); 
    echo CHtml::textField('search', isset($_GET['search']) ? $_GET['search'] : '', array('placeholder' => Yii::t('app', 'Search'), 'class' => 'search'));
    $this->endWidget(); 
?>