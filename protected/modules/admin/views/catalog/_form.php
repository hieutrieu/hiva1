<?php 
	$form = $this->beginWidget('GxActiveForm', array(
		'id' => 'admin-form',
		'enableAjaxValidation' => false,		
	));
?>
<div class="box box-primary">
    <div class="box-header">
        <h3 class="box-title">Catalog Infomation</h3>
    </div>	
    <div class="box-body">
		<?php echo $form->errorSummary($model); ?>
		<div class="form-group">
			<?php echo $form->labelEx($model,'title'); ?>
			<?php echo $form->textField($model, 'title', array('maxlength' => 255, 'class' => 'form-control')); ?>
			<?php echo $form->error($model,'title'); ?>
		</div>			
		<div class="form-group">
			<?php echo $form->labelEx($model,'alias'); ?>
			<?php echo $form->textField($model, 'alias', array('maxlength' => 255, 'class' => 'form-control')); ?>
			<?php echo $form->error($model,'alias'); ?>
		</div>	
		<div class="form-group">
			<?php 
				$this->widget('application.modules.admin.widgets.modal_catalog', array(
					'model' =>  $model,
					'attribute'=>'parent_id',
					'value' => $model->parent_id,
				));
			?>
		</div>			
		<div class="form-group">
			<?php echo $form->labelEx($model,'image'); ?>
			<?php 
                $this->widget('ext.finder.EImageFinder',array(
                        'model'=>$model,
		                'attribute'=>'image', 
                        'value' => $model->image,
		            	'htmlOptions' => array('class' => 'form-control') 
                    )); ?>					
			<?php echo $form->error($model,'image'); ?>
		</div>
        <div class="form-group">
			<?php echo $form->labelEx($model,'classify'); ?>
			<?php echo $form->textField($model, 'classify', array('maxlength' => 255, 'class' => 'form-control')); ?>
			<?php echo $form->error($model,'classify'); ?>
		</div>	
        <div class="form-group">
			<?php echo $form->labelEx($model,'language'); ?>
            <?php echo $form->dropDownList($model, 'language', AdminHelper::languages(), array('maxlength' => 255, 'class' => 'form-control')); ?>
			<?php echo $form->error($model,'language'); ?>
		</div>		
	</div>		
</div>
<?php
	$this->endWidget();
?>