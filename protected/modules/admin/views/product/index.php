<?php
$this->button = array(
	array('label'=>Yii::t('app', 'Edit'), 'url'=>array('edit'), 'htmlOptions' => array('class' => 'fa fa-edit', 'id' => 'edit-button')),
	array('label'=>Yii::t('app', 'New'), 'url'=>array('new'), 'htmlOptions' => array('class' => 'fa fa-file-o', 'id' => 'new-button')),
	array('label'=>Yii::t('app', 'Delete'), 'url'=>array('delete'), 'htmlOptions' => array('class' => 'fa fa-trash-o', 'id' => 'delete-button')),
    array('label'=>Yii::t('app', 'Add Hot'), 'url'=>array('addhot'), 'htmlOptions' => array('class' => 'fa fa-plus-square-o', 'id' => 'add-button')),
);
	$form = $this->beginWidget('GxActiveForm', array(
		'action' => Yii::app()->createUrl($this->route),
		'method' => 'post',
		'id' => 'admin-form',
		'enableAjaxValidation'=>false,
	)); 
	
		$this->widget('zii.widgets.grid.CGridView', array(
			'id' => 'admin-grid',
			'dataProvider' => $model->search(),
			'filter' => $model,
			//'selectableRows' => 2,
			'columns' => array(		
		        array(
					'class' => 'CCheckBoxColumn',
					'selectableRows' => '2',
					'header'=>'Selected',
		        	'id'=>'cid', //
		        	'checked'=>'Yii::app()->user->getState($data->id)',
		        	'htmlOptions' => array('style' =>'width:10px')
				),
				array(
					'header' => Yii::t('app', 'Title'),
                    'name' => 'title',
					'value' => 'CHtml::link($data->title, Yii::app()->createUrl("/admin/product/edit/", array("id"=>$data["id"])))',
					'type' => 'raw',
				),
                array(
					'header' => Yii::t('app', 'Catalog'),
                    'name' => 'category_id',
                    'value' => '$data->catalog',
                    'filter' => AdminHelper::shopCategories(),
                    'htmlOptions' => array (
						'style' => 'width: 15%;'
					),
					'type' => 'raw',
				),
                array(
    				'class' => 'JToggleColumn',
    				'name' => 'hot',
    				'filter' => array('0' => Yii::t('app', 'No'), '1' => Yii::t('app', 'Yes')),
    				'model' => get_class($model),
    				'htmlOptions' => array('style' => 'text-align:center; width: 10%;')
    			),	
                array(
					'header' => Yii::t('app', 'Manufacturer'),
                    'name' => 'manufacturer',
                    'filter' => '',
                    'htmlOptions' => array (
						'style' => 'width: 20%;'
					),
					'type' => 'raw',
				),			
				array (
					'name' => 'price',
					'htmlOptions' => array (
						'class' => 'center',
						'style' => 'text-align:center; width: 10%;'
					)
				),
				array (
					'name' => 'thumbnail',
                    'filter' => '',
                    'value' => 'CHtml::image($data->thumbnail)',
					'htmlOptions' => array (
						'class' => 'center',
						'style' => 'text-align:center; width: 10%;'
					),
                    'type' => 'raw',
				),
				array(
					'name' => 'id',
					'header' => 'ID',
					'htmlOptions' => array('style' => 'text-align:center; width: 3%;')		
				),
			),
		)); 
	$this->endWidget(); 
?>