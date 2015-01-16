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
            <div class="profile_item"><a class="<?php echo Yii::app()->controller->action->id == 'notifydetail' ? 'active' : '' ?>" href="<?php echo Link::notify() ?>"><?php echo Yii::t('app', 'Notify') ?><span class="badge bg-red"><?php echo Notify::totalUnread()?></span></a></div>
            <div class="profile_item"><a class="<?php echo Yii::app()->controller->action->id == 'profile' ? 'active' : '' ?>" href="<?php echo Link::profile(array('id'=>Yii::app()->user->id)) ?>"><?php echo Yii::t('app', 'Account Information') ?></a></div>
            <div class="profile_item"><a class="<?php echo Yii::app()->controller->action->id == 'history' ? 'active' : '' ?>" href="<?php echo Link::profile(array('id'=>Yii::app()->user->id)) ?>"><?php echo Yii::t('app', 'Purchase History') ?></a></div>
        </div>
        <div class="profile_right">
            <div class="account_info">
                <div class="pull-left"><?php echo Yii::t('app', 'Notify') ?></div>
            </div>
            <div class="notify_container">
                <div class="notify_item">
                    <div class="notify_item_bg <?php echo $notify['is_read'] ? 'readed' : '' ?>">
                        <div class="notify_title">
                            <?php echo $notify['subject'] ?>
                        </div>
                        <div class="notify_content"><?php echo $notify['content'] ?></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>