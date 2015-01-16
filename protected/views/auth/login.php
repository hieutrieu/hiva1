<?php if(Yii::app()->user->hasFlash('error')): ?>
<div class="flash-success">
	<?php echo Yii::app()->user->getFlash('error'); ?>
</div>
<?php endif; ?>
<div id="login-content" style="display: block; float:left; width: 100%;">
    <div class="no-padding" style="width: 300px; margin: 100px auto">
        <form class="login_form_popup" role="form" action="<?php echo Yii::app()->createUrl('auth/login')?>" method="post" name="login_form">
            <div class="form-group">
                <label><?php echo Yii::t('app', 'Email') ?>* </label><input name="LoginForm[email]" type="text" placeholder="<?php echo Yii::t('app', 'Email') ?>" class="login_input" id="login_email"/>
            </div>
            <div class="form-group">
                <label><?php echo Yii::t('app', 'Password') ?>* </label><input name="LoginForm[password]" type="password" placeholder="<?php echo Yii::t('app', 'Password') ?>" class="login_input" id="login_password"/>
            </div>
            <div class="form-group" style="text-align: right;">
                <a href="<?php echo Yii::app()->createUrl('auth/forgotpassword')?>" class="login_forgot"><?php echo Yii::t('app', 'Forgot password?') ?></a>
                <button type="submit" onclick="return validateLogin(this);" class="btn_login"><?php echo Yii::t('app', 'Login') ?></button>                                  
            </div>
        </form>
    </div>
</div>
