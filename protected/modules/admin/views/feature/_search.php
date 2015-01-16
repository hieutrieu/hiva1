<?php
	$form = $this->beginWidget('GxActiveForm', array(
		'action' => Yii::app()->createUrl($this->route, isset($pageAjax) ? array('tmpl' => 'modal') : array()),
		'method' => 'get',
		'id' => 'admin-filter-form',
	)); 
?>

	<?php echo CHtml::label(Yii::t('app', 'Filter'), 'strSearch')?>
	<?php echo CHtml::textField('strSearch', '', array('class' => 'hasTip', 'title' => $this->t('Filter by ID / Title / Created By'))); ?>
	
	<?php if (isset($function)) {	
		echo CHtml::hiddenField('function', $function);
		echo CHtml::button(Yii::t('app', '- No Category -'), array('onclick' => "if (window.parent) window.parent.". $function ."('0', 'Select a Category');"));
	}
	?>	
	<?php echo CHtml::submitButton(Yii::t('app', 'Search'), array('class' => 'button')); ?>

<?php $this->endWidget(); ?>
