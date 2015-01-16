<?php
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
			'filter' => $model,
			'template' => '{items}<div class="pagination">{pager}{summary}</div>',
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
					'name' => 'title',
					'value' => 'CHtml::link($data->title, Yii::app()->createUrl("/admin/feature/edit/", array("id"=>$data["id"])))',
					'type' => 'raw',
				),
				array(
					'class' => 'JToggleColumn',
					'name' => 'status',
					'filter' => array('0' => Yii::t('app', 'No'), '1' => Yii::t('app', 'Yes')),
					'model' => get_class($model),
					'htmlOptions' => array('style' => 'text-align:center; width: 10%;')
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