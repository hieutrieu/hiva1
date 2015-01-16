<style>
    #content_main {
        background: #f7f7f7;
    }
    .account_info {
        border-bottom: 1px solid #dddddd;
        height: 48px;
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
    <div class="profile_title"><?php echo Yii::t('app', 'Profile') ?></div>
    
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
    <div class="">
        <div class="profile_left">
            <div class="profile_item"><a class="<?php echo Yii::app()->controller->action->id == 'notify' ? 'active' : '' ?>" href="<?php echo Link::notify() ?>"><?php echo Yii::t('app', 'Notify') ?><span class="badge bg-red"><?php echo Notify::totalUnread()?></span></a></div>
            <div class="profile_item"><a class="<?php echo Yii::app()->controller->action->id == 'editprofile' ? 'active' : '' ?>" href="<?php echo Link::profile(array('id'=>Yii::app()->user->id)) ?>"><?php echo Yii::t('app', 'Account Information') ?></a></div>
            <div class="profile_item"><a class="<?php echo Yii::app()->controller->action->id == 'history' ? 'active' : '' ?>" href="<?php echo Link::profile(array('id'=>Yii::app()->user->id)) ?>"><?php echo Yii::t('app', 'Purchase History') ?></a></div>
        </div>
        <div class="profile_right">
            <div class="account_info">
                <div class="pull-left"><?php echo Yii::t('app', 'Edit Account Information') ?></div>
            </div>
            <div class="profile_container margin-auto">
                <div class="col-lg-9 no-padding">
                    <div class="col-lg-12 no-padding">
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
                        <div class="form-group">
                        <div class="col-sm-12 buttons_left">
                    		<?php echo CHtml::submitButton(Yii::t('app', 'Update'), array('class' => 'pull-right')); ?>
                    	</div>
                    	</div>
                    </div>
                </div>
            </div>
            <div class="account_info_footer">
                <?php echo Yii::t('app', 'Thay đổi thông tin cá nhân cũng sẽ thay đổi đơn hàng mặc định.') ?>
            </div>
        </div>
    </div>
    <?php $this->endWidget(); ?>
</div>