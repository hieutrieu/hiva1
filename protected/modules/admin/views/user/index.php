<?php
    $this->button = array(
    	array('label'=>' '. Yii::t('app', 'Genarate Customer Code'), 'url'=>array('user/genaratecode'), 'htmlOptions' => array('class' => 'fa fa-building-o')),
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
                    'header'=>'',
                    'value' => 'AdminHelper::userType($data->user_type)',
                    'htmlOptions' => array('style' => 'text-align:center; width: 22px; overflow:hidden;'),
                    'type' => 'raw',
                ),
				array(
					'name' => 'fullname',
					'value' => 'CHtml::link($data->fullname, Yii::app()->createUrl("/admin/user/view/", array("id"=>$data["id"])))',
					'type' => 'raw',
				),
				'email',
				'phone',
                array(
                    'name'=>'address',
                    'htmlOptions' => array('style' => 'width: 20%;'),
                ),
				array(
					'class' => 'JToggleColumn',
					'name' => 'status',
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
                array(
					'name' => 'customer_code',
                    'value' => '$data->customer_code != "" ? $data->customer_code : Yii::t("app", "No Code")',
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