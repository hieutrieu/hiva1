<?php
$this->subMenu = array(
	array('label'=>Yii::t('app', 'Category Manager'), 'url'=>array('index'), 'active' => true),
);
$this->button = array(
	array('label'=>Yii::t('app', 'Edit'), 'url'=>array('edit'), 'htmlOptions' => array('class' => 'fa fa-edit', 'id' => 'edit-button')),
	array('label'=>Yii::t('app', 'New'), 'url'=>array('new'), 'htmlOptions' => array('class' => 'icon-32-new', 'id' => 'new-button')),
	array('label'=>Yii::t('app', 'Delete'), 'url'=>array('delete'), 'htmlOptions' => array('class' => 'icon-32-delete', 'id' => 'delete-button')),
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
			'filter' => null, //$model,
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
					'value' => 'str_repeat(\'<span class="gi">|&mdash;&mdash;</span>\', $data->level-1) . CHtml::link($data->title, Yii::app()->createUrl("/admin/category/edit/", array("id"=>$data["id"]))).\'<p class="smallsub">\'. str_repeat(\'<span class="gtr"></span>\', $data->level-1) .\' (Alias: \'.$data->alias.\')</p>\'',
					'type' => 'raw',
				),
				'description:html',
				array(
					'class' => 'JToggleColumn',
					'name' => 'state',
					'filter' => array('0' => Yii::t('app', 'No'), '1' => Yii::t('app', 'Yes')),
					'model' => get_class($model),
					'htmlOptions' => array('style' => 'text-align:center; width: 5%;')
				),				
				array (
					'name' => 'created_at',
					'htmlOptions' => array (
						'class' => 'center',
						'style' => 'text-align:center; width: 10%;'
					)
				),
				array (
					'name' => 'image',
					'htmlOptions' => array (
						'class' => 'center',
						'style' => 'text-align:center; width: 10%;'
					)
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