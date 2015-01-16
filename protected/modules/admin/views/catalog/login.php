<div class="m wbg">
	<h1><?php echo Yii::t('app', 'Administration Login'); ?></h1>
    <?php 
		$this->widget('application.extensions.Flash'); 
	?><!-- flashes -->
	<div id="section-box">
		<div class="m">
    		<?php $form = $this->beginWidget('CActiveForm', array(
    			'id'=>'login-form',
    			'enableClientValidation'=>true,
    			'clientOptions'=>array(
    				'validateOnSubmit'=>true,
    			),
    		)); ?>    	
                <fieldset class="loginform">		
        			<div class="row">
        				<?php echo $form->labelEx($model,'username'); ?>
        				<?php echo $form->textField($model,'username'); ?>
        				<?php echo $form->error($model,'username'); ?>
        			</div>
        
        			<div class="row">
        				<?php echo $form->labelEx($model,'password'); ?>
        				<?php echo $form->passwordField($model,'password'); ?>
        				<?php echo $form->error($model,'password'); ?>
        			</div>
        			<div class="row">
        				<?php echo CHtml::submitButton(Yii::t('app', 'Login'), array('class'=>'login_button')); ?>
        			</div>
                </fieldset>
		  <?php $this->endWidget(); ?>
          <div class="clr"></div>
        </div>
	</div>
    <p><?php echo Yii::t('app', 'Use a valid username and password to gain access to the administrator backend.') ?></p>
	<div id="lock"></div>
</div><!-- form -->