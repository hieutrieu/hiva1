<div>
    <small>Hoặc nhập địa chỉ Email của bạn</small>    
    <?php //echo CHtml::form('#newsletterform'); ?>
    <div id="newsletter_container">
    	<?php echo CHtml::emailField('subscribe_email', Yii::app()->user->isGuest?'':Yii::app()->user->email, array('placeholder' => 'Email của bạn')); ?>
        <?php echo CHtml::submitButton( Yii::t('index', 'Subscribe'), array('name'=>'newsletter', 'id' => 'newsletter', 'onclick' => 'return subscribe(this);') ); ?>
        <div class="popover right" id="show_msg" role="tooltip" style="top: 250px; left: 205px;">
            <div class="arrow"></div>
            <div class="popover-content">
                <div id="subscribe_msg"></div>
            </div>
        </div>
    </div>
	<?php //echo CHtml::endForm(); ?>
</div>