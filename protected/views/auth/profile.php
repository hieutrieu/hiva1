<style>
    #content_main {
        background: #f7f7f7;
    }
    .account_info {
        border-bottom: 1px solid #dddddd;
        height: 48px;
    }
</style>
<div class="container">
    <div class="profile_title"><?php echo Yii::t('app', 'Profile') ?></div>

    <div class="">
        <div class="profile_left">
            <div class="profile_item"><a class="<?php echo Yii::app()->controller->action->id == 'notify' ? 'active' : '' ?>" href="<?php echo Link::notify() ?>"><?php echo Yii::t('app', 'Notify') ?><span class="badge bg-red"><?php echo Notify::totalUnread()?></span></a></div>
            <div class="profile_item"><a class="<?php echo Yii::app()->controller->action->id == 'profile' ? 'active' : '' ?>" href="<?php echo Link::profile(array('id'=>Yii::app()->user->id)) ?>"><?php echo Yii::t('app', 'Account Information') ?></a></div>
            <div class="profile_item"><a class="<?php echo Yii::app()->controller->action->id == 'orderhistory' ? 'active' : '' ?>" href="<?php echo Link::orderHistory() ?>"><?php echo Yii::t('app', 'Purchase History') ?></a></div>
        </div>
        <div class="profile_right">
            <div class="account_info">
                <div class="pull-left"><?php echo Yii::t('app', 'Account Information') ?></div>
                <div class="pull-right"><a href="<?php echo Link::editProfile(array('id'=>Yii::app()->user->id)) ?>"><?php echo Yii::t('app', 'Edit') ?></a></div>
            </div>
            <div class="profile_container">
                <div class="col-md-12 user_item">
                    <div class="profile_label col-md-6"><?php echo Yii::t('app', 'Name') ?>: </div>
                    <div class="col-md-6"><?php echo $user->fullname ?></div>
                </div>
                <div class="col-md-12 user_item">
                    <div class="profile_label col-md-6"><?php echo Yii::t('app', 'Date Birth') ?>: </div>
                    <div class="col-md-6"><?php echo Yii::app()->dateFormatter->formatDateTime($user->date_birth, 'medium', null) ?></div>
                </div>
                <div class="col-md-12 user_item">
                    <div class="profile_label col-md-6"><?php echo Yii::t('app', 'Phone') ?>: </div>
                    <div class="col-md-6"><?php echo $user->phone ?></div>
                </div>
                <div class="col-md-12 user_item">
                    <div class="profile_label col-md-6"><?php echo Yii::t('app', 'Address') ?>: </div>
                    <div class="col-md-6"><?php echo $user->address ?></div>
                </div>
                <div class="col-md-12 user_item">
                    <div class="profile_label col-md-6"><?php echo Yii::t('app', 'Email') ?>: </div>
                    <div class="col-md-6"><?php echo $user->email ?></div>
                </div>
                <div class="col-md-12 user_item">
                    <div class="profile_label col-md-6"><?php echo Yii::t('app', 'Password') ?>: </div>
                    <div class="col-md-6">**********</div>
                </div>
                <div class="col-md-12 user_item">
                    <div class="profile_label col-md-6"><?php echo Yii::t('app', 'User Type') ?>: </div>
                    <div class="col-md-6"><?php echo Helper::userType($user->user_type, true) ?></div>
                </div>
            </div>
        </div>
    </div>
</div>