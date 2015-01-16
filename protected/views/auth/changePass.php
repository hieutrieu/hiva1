<?php if(Yii::app()->user->hasFlash('error')): ?>
<div class="flash-success">
	<?php echo Yii::app()->user->getFlash('error'); ?>
</div>
<?php endif; ?>
<div id="login-content" style="display: block; float:left; width: 100%;">
    <div class="no-padding" style="width: 500px; margin: 30px auto 100px auto">
        <div class="register_title"><?php echo Yii::t('app', 'Change password') ?></div>
        <?php 
            $form=$this->beginWidget('CActiveForm', array(
            	'id'=>'changepass-form',
            	'enableClientValidation'=>true,
                'enableAjaxValidation'=>true,
                'htmlOptions' => array('class' => 'form-horizontal',
                    'role' => 'form',
                    'id' => 'changepass-form',
                    'validateOnSubmit'=>true,
                )
            )); 
        ?>
            <div class="form-group">
                <?php echo $form->labelEx($model, 'new_password', array('class' => 'col-sm-5 control-label no-padding')); ?>
                <div class="col-lg-7">
                    <?php echo $form->passwordField($model, 'new_password', array('class' => 'contact_input')); ?>
                    <?php echo $form->error($model, 'new_password'); ?>
                </div>
            </div>
            <div class="col-lg-12" style="text-align: right;">
        		<?php echo CHtml::submitButton(Yii::t('app', 'Change password'), array('class' => 'btn_login')); ?>
        	</div>
        <?php $this->endWidget(); ?>
    </div>
</div>
