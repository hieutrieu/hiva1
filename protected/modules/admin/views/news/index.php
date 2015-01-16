<?php
    $this->subMenu = array(
    	array('label'=>Yii::t('app', 'Category Manager'), 'url'=>array('index'), 'active' => true),
    );
    $this->button = array(
    	array('label'=>Yii::t('app', 'Edit'), 'url'=>array('edit'), 'htmlOptions' => array('class' => 'fa fa-edit', 'id' => 'edit-button')),
    	array('label'=>Yii::t('app', 'New'), 'url'=>array('new'), 'htmlOptions' => array('class' => 'fa fa-file-o', 'id' => 'new-button')),
    	array('label'=>Yii::t('app', 'Delete'), 'url'=>array('delete'), 'htmlOptions' => array('class' => 'fa fa-trash-o', 'id' => 'delete-button')),
    );
    
    $this->widget('zii.widgets.grid.CGridView', array(
    	'id'=>'news-grid',
    	'dataProvider'=>$model->search(),
    	'filter'=>$model,
    	'columns'=>array(
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
				'value' => 'CHtml::link($data->title, Yii::app()->createUrl("/admin/news/update/", array("id"=>$data["id"])))',
				'type' => 'raw',
			),
            array(
				'header' => Yii::t('app', 'Type'),
				'value' => 'Helper::types($data->type)',
				'type' => 'raw',
			),
    		array(
				'class' => 'JToggleColumn',
				'name' => 'status',
				'filter' => array('0' => Yii::t('app', 'No'), '1' => Yii::t('app', 'Yes')),
				'model' => get_class($model),
				'htmlOptions' => array('style' => 'text-align:center; width: 5%;')
			),				
			array (
				'name' => 'thumbnail',
                'value' => 'CHtml::image($data->thumbnail, "", array("width"=>50))',
				'htmlOptions' => array (
					'class' => 'center',
					'style' => 'text-align:center; width: 10%;'
				),
                'type' => 'raw',
			),
            array (
				'name' => 'created_at',
				'htmlOptions' => array (
					'class' => 'center',
					'style' => 'text-align:center; width: 10%;'
				)
			),
    		array(
    			'class'=>'CButtonColumn',
    		),
            array(
				'name' => 'id',
				'header' => 'ID',
				'htmlOptions' => array('style' => 'text-align:center; width: 3%;')		
			),
    	),
    )); 