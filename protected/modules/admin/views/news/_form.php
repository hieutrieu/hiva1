<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl."/themes/admin/js/plugins/ckeditor/ckeditor.js"); ?>
<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl."/themes/admin/js/plugins/ckeditor/config.js"); ?>
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
    		<?php echo $form->labelEx($model,'title'); ?>
    		<?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>255, 'class' => 'form-control input-sm')); ?>
    		<?php echo $form->error($model,'title'); ?>
    	</div>
        
        <div class="form-group">
			<?php 
				$this->widget('application.modules.admin.widgets.modal_category', array(
					'model' =>  $model,
					'attribute'=>'category_id',
					'value' => $model->category_id,
					'value' => $model->category_id,
				));
			?>
		</div>	
    
        <div class="form-group">
    		<?php echo $form->labelEx($model,'thumbnail'); ?>
    		<?php 
                $this->widget('ext.finder.EImageFinder',array(
                    'model'=>$model,
	                'attribute'=>'thumbnail', 
                    'value' => $model->thumbnail,
	            	'htmlOptions' => array('class' => 'form-control') 
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
                )); 
            ?>	
    	</div>
        
        <div class="form-group">
    		<?php echo $form->labelEx($model,'type'); ?>
    		<?php echo $form->dropDownList($model,'type', AdminHelper::newsType()); ?>
    		<?php echo $form->error($model,'type'); ?>
    	</div>
        
    	<div class="form-group">
    		<?php echo $form->labelEx($model,'description'); ?>
    		<?php echo $form->textArea($model,'description',array('rows'=>6, 'cols'=>50, 'class' => 'form-control input-sm')); ?>
    		<?php echo $form->error($model,'description'); ?>
    	</div>
    
    	<div class="form-group">
    		<?php echo $form->labelEx($model,'content'); ?>
    		<?php echo $form->textArea($model,'content',array('rows'=>6, 'cols'=>50, 'class' => 'form-control input-sm')); ?>
    		<?php echo $form->error($model,'content'); ?>
    	</div>
    
    	<div class="form-group">
    		<label>
    		  <?php echo $form->checkBox($model,'is_hot', array('class' => 'icheckbox_minimal')); ?>
              Is Hot
    		</label>
    	</div>
    
    	
    
    	<div class="form-group">
    		<?php echo $form->labelEx($model,'viewer'); ?>
    		<?php echo $form->textField($model,'viewer', array('class' => 'form-control input-sm')); ?>
    		<?php echo $form->error($model,'viewer'); ?>
    	</div>
    
    	<div class="form-group">
    		<?php echo $form->labelEx($model,'status'); ?>
    		<?php echo $form->textField($model,'status'); ?>
    		<?php echo $form->error($model,'status'); ?>
    	</div>
    
    	<div class="form-group">
    		<?php echo $form->labelEx($model,'created_at'); ?>
    		<?php echo $form->textField($model,'created_at', array('class' => 'form-control input-sm')); ?>
    		<?php echo $form->error($model,'created_at'); ?>
    	</div>

        <?php $this->endWidget(); ?>
    </div>
</div><!-- form -->