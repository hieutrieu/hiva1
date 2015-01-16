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
            <?php echo $form->labelEx($model,'name'); ?>
			<?php echo $form->textField($model, 'name', array('maxlength' => 255, 'class' => 'form-control input-sm')); ?>
			<?php echo $form->error($model,'name'); ?>
    	</div>
        
        <div class="form-group">
            <?php echo $form->labelEx($model,'email'); ?>
			<?php echo $form->emailField($model, 'email', array('maxlength' => 255, 'class' => 'form-control input-sm')); ?>
			<?php echo $form->error($model,'email'); ?>
    	</div>
        
        <div class="form-group">
			<?php echo $form->labelEx($model,'phone'); ?>
			<?php echo $form->numberField($model, 'phone', array('maxlength' => 255, 'class' => 'form-control input-sm'));  ?>
			<?php echo $form->error($model,'phone'); ?>
    	</div>
        
        <div class="form-group">
			<?php echo $form->labelEx($model,'fax'); ?>
			<?php echo $form->numberField($model, 'fax', array('maxlength' => 255, 'class' => 'form-control input-sm'));  ?>
			<?php echo $form->error($model,'fax'); ?>
    	</div>
        
        <div class="form-group">
			<?php echo $form->labelEx($model,'address'); ?>
			<?php echo $form->textField($model, 'address', array('maxlength' => 255, 'class' => 'form-control input-sm'));  ?>
			<?php echo $form->error($model,'address'); ?>
    	</div>
        
        <div class="form-group">
    		<?php echo $form->labelEx($model,'url_map'); ?>
    		<?php 
                $this->widget('ext.finder.EImageFinder',array(
                    'model'=>$model,
	                'attribute'=>'url_map', 
                    'value' => $model->url_map,
	            	'htmlOptions' => array('class' => 'form-control') 
                )); 
            ?>	
    	</div>
        
        <?php $this->endWidget(); ?>
    </div>
</div><!-- form -->