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
			<?php echo $form->textField($model, 'name', array('maxlength' => 255, 'class' => 'form-control')); ?>
			<?php echo $form->error($model,'name'); ?>
    	</div>
        
        <div class="form-group">
            <?php echo $form->labelEx($model,'description'); ?>
			<?php echo $form->textArea($model, 'description', array('rows' => 3, 'class' => 'form-control')); ?>
			<?php echo $form->error($model,'description'); ?>
    	</div>
        
        <div class="form-group">
			<?php echo $form->labelEx($model,'url'); ?>
			<?php echo $form->urlField($model, 'url', array('maxlength' => 255, 'class' => 'form-control'));  ?>
			<?php echo $form->error($model,'url'); ?>
    	</div>
        
        <div class="form-group">
			<?php echo $form->labelEx($model,'address'); ?>
			<?php echo $form->textField($model, 'address', array('maxlength' => 255, 'class' => 'form-control'));  ?>
			<?php echo $form->error($model,'address'); ?>
    	</div>
        
        <div class="form-group">
    		<?php echo $form->labelEx($model,'image'); ?>
    		<?php 
                $this->widget('ext.finder.EImageFinder',array(
                    'model'=>$model,
	                'attribute'=>'image', 
                    'value' => $model->image,
	            	'htmlOptions' => array('class' => 'form-control') 
                )); 
            ?>	
    	</div>
        
        <?php $this->endWidget(); ?>
    </div>
</div><!-- form -->