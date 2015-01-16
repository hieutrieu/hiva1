<fieldset id="filter-bar">
	<div class="filter-search fltlft">
		<?php $this->renderPartial('_search', array(
			'model' => $model,
			'function' => $function,
			'pageAjax' => $pageAjax,
		)); ?>
	</div>
</fieldset>
<?php
	$form = $this->beginWidget('GxActiveForm', array(
		'action' => Yii::app()->createUrl($this->route),
		'method' => 'post',
		'id' => 'admin-form',
		'enableAjaxValidation'=>true,
	)); 
	
		$this->widget('zii.widgets.grid.CGridView', array(
			'id' => 'admin-grid',
			'dataProvider' => $model->search(),
			'filter' => null, //$model,
			'template' => '{items}<div class="pagination">{pager}{summary}</div>',
			'selectableRows' => 0,
			'columns' => array(				
			    array(
					'header' => Yii::t('app', 'Fullname'),
					'value' => 'CHtml::link($data->fullname, \'#\', array("onclick" => "if (window.parent) window.parent.'. $function .'($data->id, \'$data->fullname\')"))',
					'type' => 'raw',
				),
				'email',
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
						'style' => 'text-align:center; width: 15%;'
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