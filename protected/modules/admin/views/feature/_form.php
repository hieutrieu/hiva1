<div class="box">
    <div class="box-header">
        <h3 class="box-title">Infomation</h3>
    </div>
    <div class="box-body">
        <?php 
        	$form = $this->beginWidget('GxActiveForm', array(
        		'id' => 'admin-form',
        		'enableAjaxValidation' => false,		
        	));
        ?>

    	<?php echo $form->errorSummary($model, null, null, array('class' => 'callout callout-danger')); ?>
        
    	<div class="form-group">
            <?php echo $form->labelEx($model, 'title'); ?>
			<?php echo $form->textField($model, 'title', array('maxlength' => 255, 'class' => 'form-control')); ?>
			<?php echo $form->error($model, 'title'); ?>
    	</div>
        
        <?php $this->endWidget(); ?>
    </div>
</div><!-- form -->