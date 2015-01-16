<style>
    #content_main {
        border-top: 7px solid #f7f7f7;
    }
</style>
<?php
    $baseUrl = Yii::app()->baseUrl; 
    $cs = Yii::app()->getClientScript();
    $cs->registerScriptFile($baseUrl.'/themes/hieutam/js/input-mask/jquery.inputmask.js', CClientScript::POS_END);
    $cs->registerScriptFile($baseUrl.'/themes/hieutam/js/input-mask/jquery.inputmask.date.extensions.js', CClientScript::POS_END);
    
    Yii::app()->clientScript->registerScript('date_birth','$(function(){$("#RegisterForm_date_birth").inputmask("dd/mm/yyyy", {"placeholder": "dd/mm/yyyy"});});',CClientScript::POS_END);
?>
<div class="container">
    <div class="register_title"><?php echo Yii::t('app', 'Register Account') ?></div>
    
    <?php if(Yii::app()->user->hasFlash('register')): ?>
    <div class="flash-success">
    	<?php echo Yii::app()->user->getFlash('register'); ?>
    </div>
    <?php endif; ?>
    <?php 
        $form=$this->beginWidget('CActiveForm', array(
        	'id'=>'register-form',
        	'enableClientValidation'=>true,
            'enableAjaxValidation'=>true,
            'htmlOptions' => array('class' => 'form-horizontal',
                'role' => 'form',
                'id' => 'register-form',
                'validateOnSubmit'=>true,
            )
        )); 
    ?>
    <div class="register_center margin-auto">
        <div class="col-lg-10 no-padding">
            <div class="col-lg-8 no-padding">
                <div class="form-group">
                    <?php echo $form->labelEx($model, 'first_name', array('class' => 'col-sm-5 control-label no-padding')); ?>
                    <div class="col-sm-7">
                        <?php echo $form->textField($model, 'first_name', array('class' => 'contact_input')); ?>
                        <?php echo $form->error($model, 'first_name'); ?>
                    </div>
                </div>
                <div class="form-group">
                    <?php echo $form->labelEx($model, 'last_name', array('class' => 'col-sm-5 control-label no-padding')); ?>
                    <div class="col-sm-7">
                        <?php echo $form->textField($model, 'last_name', array('class' => 'contact_input')); ?>
                        <?php echo $form->error($model, 'last_name'); ?>
                    </div>
                </div>
                <div class="form-group">
                    <?php echo $form->labelEx($model, 'date_birth', array('class' => 'col-sm-5 control-label no-padding')); ?>
                    <div class="col-sm-7">
                        <?php echo $form->textField($model, 'date_birth', array('class' => 'contact_input')); ?>
                        <?php echo $form->error($model, 'date_birth'); ?>
                    </div>
                </div>
                <div class="form-group">
                    <?php echo $form->labelEx($model, 'phone', array('class' => 'col-sm-5 control-label no-padding')); ?>
                    <div class="col-sm-7">
                        <?php echo $form->textField($model, 'phone', array('class' => 'contact_input')); ?>
                        <?php echo $form->error($model, 'phone'); ?>
                    </div>
                </div>
                <div class="form-group">
                    <?php echo $form->labelEx($model, 'address', array('class' => 'col-sm-5 control-label no-padding')); ?>
                    <div class="col-sm-7">
                        <?php echo $form->textField($model, 'address', array('class' => 'contact_input')); ?>
                        <?php echo $form->error($model, 'address'); ?>
                    </div>
                </div>
                <div class="form-group">
                    <?php echo $form->labelEx($model, 'email', array('class' => 'col-sm-5 control-label no-padding')); ?>
                    <div class="col-sm-7">
                        <?php echo $form->textField($model, 'email', array('class' => 'contact_input')); ?>
                        <?php echo $form->error($model, 'email'); ?>
                    </div>
                </div>
                <div class="form-group">
                    <?php echo $form->labelEx($model, 'password', array('class' => 'col-sm-5 control-label')); ?>
                    <div class="col-sm-7">
                        <?php echo $form->passwordField($model, 'password', array('class' => 'contact_input')); ?>
                        <?php echo $form->error($model, 'password'); ?>
                    </div>
                </div>
                <div class="form-group">
                    <?php echo $form->labelEx($model, 'repassword', array('class' => 'col-sm-5 control-label no-padding')); ?>
                    <div class="col-sm-7">
                        <?php echo $form->passwordField($model, 'repassword', array('class' => 'contact_input')); ?>
                        <?php echo $form->error($model, 'repassword'); ?>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 no-padding">
                <div class="form-group">
                        <?php echo $form->checkBox($model, 'terms_of_service', array('value'=>1, 'class' => 'terms_of_service_box')); ?>
                        <label class="terms_of_service" for="RegisterForm_terms_of_service"><?php echo Yii::t('app', 'I agree to the %s of TamHieu', array('%s' => CHtml::link(Yii::t('app', 'terms of use'), '/site/term'))) ?></label>
                </div>
                <?php if ($model->getRequireCaptcha()) : ?>
                    <?php $this->widget('application.extensions.recaptcha.EReCaptcha',
                        array('model' => $model, 'attribute' => 'verify_code',
                            'theme' => 'red', 'language' => 'en',
                            'publicKey' => '6LdOg_8SAAAAAMJU3Q7HwrNAU6112nH9EHd05_BR'));?>
                    <?php echo CHtml::error($model, 'verify_code'); ?>
                <?php endif; ?>
                <div class="col-lg-12 buttons_left no-padding">
            		<?php echo CHtml::submitButton(Yii::t('app', 'Register')); ?>
            	</div>
            </div>
        </div>
    </div>
    <?php $this->endWidget(); ?>
</div>