<?php 
	$this->widget('application.extensions.Flash'); 
?><!-- flashes -->
<div class="header">Administrator Sign In</div>
	<?php $form = $this->beginWidget('CActiveForm', array(
		'id'=>'login-form',
		'enableClientValidation'=>true,
		'clientOptions'=>array(
			'validateOnSubmit'=>true,
		),
	)); ?>    	
        <div class="body bg-gray">		
			<div class="form-group">
				<?php echo $form->textField($model,'username', array('class' => 'form-control','placeholder'=>'User Name')); ?>
			</div>

			<div class="form-group">
				<?php echo $form->passwordField($model,'password', array('class' => 'form-control', 'placeholder' => 'Password')); ?>
			</div>
        </div>
        <div class="footer">
			<?php echo CHtml::submitButton(Yii::t('app', 'Login'), array('class'=>'btn bg-olive btn-block')); ?>
		</div>
  <?php $this->endWidget(); ?>
    <p><?php echo Yii::t('app', 'Use a valid username and password to gain access to the administrator backend.') ?></p>
	<div id="lock"></div>
</div><!-- form -->