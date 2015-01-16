<?php if(Yii::app()->user->isGuest): ?>
	<a class="<?php echo Yii::app()->controller->action->id == 'login' ? 'active' : '' ?> login-link" href="#"><?php echo Yii::t('app', 'Login') ?></a> | <a class="<?php echo Yii::app()->controller->action->id == 'register' ? 'active' : '' ?>" href="<?php echo Yii::app()->createUrl('auth/register') ?>"><?php echo Yii::t('app', 'Register')?></a>
    
    <div id="popover-content" style="display: none;">
        <div class="col-lg-12 no-padding" style="width: 300px;">
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
<?php else: ?>
    <div class="menu_user_info">
        <?php echo Helper::userType(Yii::app()->user->user_type) ?> <a class="<?php echo Yii::app()->controller->action->id == 'profile' ? 'active' : '' ?>" href="<?php echo Link::profile(array('id'=>Yii::app()->user->id)) ?>"><?php echo Yii::app()->user->name ?></a> | <a class="logout" href="<?php echo Link::logout()?>"><?php echo Yii::t('app', 'Logout') ?></a>
    </div>
<?php endif; ?>
<div class="btn-group">
    <button type="button" class="btn btn-language btn-sm dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
        Vietnamese<span class="caret"></span>
    </button>
    <!--ul class="dropdown-menu pull-right" role="menu">
        <li><a href="#">Vietnamese</a></li>
        <li><a href="#">English</a></li>
    </ul-->
</div> 
