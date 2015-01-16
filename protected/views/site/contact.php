<style>
    #content_main {
        background: #f7f7f7;
    }
</style>
<div class="container">
    <div class="contact_title"><?php echo Yii::t('app', 'Contact Us') ?></div>
    
    <?php if(Yii::app()->user->hasFlash('contact')): ?>
    <div class="flash-success">
    	<?php echo Yii::app()->user->getFlash('contact'); ?>
    </div>
    <?php endif; ?>
    
    <div class="col-lg-12 no-padding">
        <div class="col-lg-6 col-sm-6 no-padding">
            <h3 class="contact_title_company"><?php echo Yii::t('app', 'JSC Trading & Service Tam Hieu')?></h3>
            <div class="form">
                <?php 
                    $form=$this->beginWidget('CActiveForm', array(
                    	'id'=>'contact-form',
                    	'enableClientValidation'=>true,
                    	'clientOptions'=>array(
                    		'validateOnSubmit'=>true,
                    	),
                    )); 
                ?>
                <div class="contact_add_map">Số 89 Thái Hà - Trung Liệt - Đống Đa - Hà Nội</div>
                <div class="contact_add_phone">043 624 0012 - 046 675 3525</div>
                <div class="contact_add_fax">043.636.9891</div>
                <p class="contact_add_sendmail">Gửi Email về cho chúng tôi:</p>
            	<div class="col-lg-12 no-padding">
                    <div class="col-lg-6 col-sm-6 no-padding">
                		<?php echo $form->textField($model, 'name', array('placeholder' => Yii::t('app', 'Name'), 'class' => 'contact_input')); ?>
                        <?php echo $form->textField($model, 'email', array('placeholder' => Yii::t('app', 'Email'), 'class' => 'contact_input')); ?>
                        <?php echo $form->textField($model, 'subject', array('placeholder' => Yii::t('app', 'Subject'), 'class' => 'contact_input')); ?>
                    </div>
                    <div class="col-lg-6 col-sm-6">
                		<?php echo $form->textArea($model, 'body', array('placeholder' => Yii::t('app', 'Content'), 'class' => 'contact_textarea')); ?>
                    </div>
            	</div>
            	<div class="col-lg-12 buttons">
            		<?php echo CHtml::submitButton(Yii::t('app', 'Send')); ?>
            	</div>
            
            <?php $this->endWidget(); ?>
            
            </div><!-- form -->
        </div>
        <div class="col-lg-6 col-sm-6 no-padding contact_map">
            <img src="<?php echo Yii::app()->baseUrl ?>/images/contacts/contact_map.png"/>
        </div>
    </div>

</div>