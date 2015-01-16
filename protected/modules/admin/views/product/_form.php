<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl."/themes/admin/js/plugins/ckeditor/ckeditor.js"); ?>
<script type="text/javascript">
    $(function() {
        // Replace the <textarea id="editor1"> with a CKEditor
        // instance, using default configuration.
        CKEDITOR.replace('ShopProduct_description');
        //bootstrap WYSIHTML5 - text editor
    });
</script>
<style>
    #ShopProduct_shopFeatures {
        width: 100%;
        float: left;
    }
</style>
<?php 
	$form = $this->beginWidget('GxActiveForm', array(
		'id' => 'admin-form',
		'enableAjaxValidation' => false,		
	));
?>
<div role="tabpanel">
    <div class="nav-tabs-custom">
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active"><a href="#info" aria-controls="home" role="tab" data-toggle="tab"><?php echo Yii::t('app', 'Information')?></a></li>
            <li role="presentation"><a href="#image" aria-controls="profile" role="tab" data-toggle="tab"><?php echo Yii::t('app', 'Images')?></a></li>
        </ul>
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="info">
                <div class="box-body">
            		<?php echo $form->errorSummary($model); ?>
            		<div class="form-group">
            			<?php echo $form->labelEx($model,'title'); ?>
            			<?php echo $form->textField($model, 'title', array('maxlength' => 255, 'class' => 'form-control')); ?>
            			<?php echo $form->error($model,'title'); ?>
            		</div>			
            		<div class="form-group">
            			<?php 
            				$this->widget('application.modules.admin.widgets.modal_catalog', array(
            					'model' =>  $model,
            					'attribute'=>'category_id',
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
                                )); ?>					
            			<?php echo $form->error($model,'thumbnail'); ?>
            		</div>
                    <div class="form-group">
            			<?php echo $form->labelEx($model,'description'); ?>
            			<?php echo $form->textArea($model,'description',array('rows'=>6, 'cols'=>50, 'class' => 'form-control input-sm')); ?>
            			<?php echo $form->error($model,'description'); ?>
            		</div>	
                    <div class="form-group">
            			<?php echo $form->labelEx($model,'price'); ?>
            			<?php echo $form->textField($model, 'price', array('maxlength' => 255, 'class' => 'form-control')); ?>
            			<?php echo $form->error($model,'price'); ?>
            		</div>
                    <div class="form-group">
            			<?php echo $form->labelEx($model,'price_old'); ?>
            			<?php echo $form->textField($model, 'price_old', array('maxlength' => 255, 'class' => 'form-control')); ?>
            			<?php echo $form->error($model,'price_old'); ?>
            		</div>
                    <div class="form-group">
            			<?php echo $form->labelEx($model,'currency'); ?>
            			<?php echo $form->dropDownList($model, 'currency', AdminHelper::currencies(), array('maxlength' => 255, 'class' => 'form-control')); ?>
            			<?php echo $form->error($model,'currency'); ?>
            		</div>
                    <div class="form-group">
            			<?php echo $form->labelEx($model,'manufacturer_id'); ?>
            			<?php echo $form->dropDownList($model, 'manufacturer_id', CHtml::listdata(ShopManufacturer::getOptions(), 'id', 'name'), array('maxlength' => 255, 'class' => 'form-control')); ?>
            			<?php echo $form->error($model,'manufacturer_id'); ?>
            		</div>
                    <div class="form-group">
            			<?php echo $form->labelEx($model,'shopFeatures'); ?>
                        <?php echo $form->checkBoxList($model, 'shopFeatures', CHtml::listdata(ShopFeature::model()->findAll(),'id','title'), array('separator'=>'',)); ?>
            			<?php echo $form->error($model,'shopFeatures'); ?>
            		</div>
                    <div class="form-group">
            			<?php echo $form->labelEx($model,'tax_id'); ?>
            			<?php echo $form->dropDownList($model, 'tax_id', CHtml::listdata(ShopTax::model()->findAll(),'id','title'), array('maxlength' => 255, 'class' => 'form-control')); ?>
            			<?php echo $form->error($model,'tax_id'); ?>
            		</div>
                    <div class="form-group">
            			<?php echo $form->labelEx($model,'hot'); ?>
                        <?php echo $form->checkBox($model,'hot', array('class' => 'icheckbox_minimal')); ?>
            			<?php echo $form->error($model,'hot'); ?>
            		</div>
                    <div class="form-group">
            			<?php echo $form->labelEx($model,'language'); ?>
            			<?php echo $form->dropDownList($model, 'language', AdminHelper::languages(), array('maxlength' => 255, 'class' => 'form-control')); ?>
            			<?php echo $form->error($model,'language'); ?>
            		</div>
            	</div>		
            </div>
            <div role="tabpanel" class="tab-pane" id="image">
                <div class="box-body">
                    <div class="form-group">
            			<?php echo $form->labelEx($model,'image'); ?>
            			<?php 
                            $this->widget('ext.finder.Multible',array(
                                'model'=>$model,
        		                'attribute'=>'image',
                                'value' => $model->image, 
        		            	'htmlOptions' => array('class' => 'form-control') 
                            )); ?>					
            			<?php echo $form->error($model,'image'); ?>
            		</div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
	$this->endWidget();
?>