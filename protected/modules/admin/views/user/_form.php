<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl."/themes/admin/js/plugins/ckeditor/ckeditor.js"); ?>
<script type="text/javascript">
    $(function() {
        // Replace the <textarea id="editor1"> with a CKEditor
        // instance, using default configuration.
        CKEDITOR.replace('News_description');
        CKEDITOR.replace('News_content');
        //bootstrap WYSIHTML5 - text editor
    });
</script>
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
            <?php echo $form->labelEx($model,'fullname'); ?>
			<?php echo $form->textField($model, 'fullname', array('maxlength' => 255, 'class' => 'form-control input-sm')); ?>
			<?php echo $form->error($model,'fullname'); ?>
    	</div>
        
        <div class="form-group">
            <?php echo $form->labelEx($model,'email'); ?>
			<?php echo $form->textField($model, 'email', array('maxlength' => 255, 'class' => 'form-control input-sm')); ?>
			<?php echo $form->error($model,'email'); ?>
    	</div>
        
        <div class="form-group">
			<?php echo $form->labelEx($model,'role_id'); ?>
			<?php echo $form->dropDownList($model, 'role_id', Helper::roles()); ?>
			<?php echo $form->error($model,'role_id'); ?>
    	</div>
        
        <div class="form-group">
            <?php echo $form->labelEx($model,'date_birth'); ?>
			<?php echo $form->textField($model, 'date_birth', array('maxlength' => 255, 'class' => 'form-control input-sm')); ?>
			<?php echo $form->error($model,'date_birth'); ?>
    	</div>
        
        <div class="form-group">
            <?php echo $form->labelEx($model,'phone'); ?>
			<?php echo $form->textField($model, 'phone', array('maxlength' => 255, 'class' => 'form-control input-sm')); ?>
			<?php echo $form->error($model,'phone'); ?>
    	</div>
        
        <div class="form-group">
            <?php echo $form->labelEx($model,'address'); ?>
			<?php echo $form->textField($model, 'address', array('maxlength' => 255, 'class' => 'form-control input-sm')); ?>
			<?php echo $form->error($model,'address'); ?>
    	</div>
        
        <div class="form-group">
            <?php echo $form->labelEx($model,'user_type'); ?>
			<?php echo $form->textField($model, 'user_type', array('maxlength' => 255, 'class' => 'form-control input-sm')); ?>
			<?php echo $form->error($model,'user_type'); ?>
    	</div>
        
        <?php $this->endWidget(); ?>
    </div>
</div><!-- form -->