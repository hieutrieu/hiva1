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
                <div class="pull-left"><?php echo Yii::t('app', 'Purchase History') ?></div>
            </div>
            <div class="notify_container">
                <?php foreach($orders['orders'] as $orders): ?> 
                <div class="notify_item">
                    <div class="notify_item_bg">
                        <div class="notify_title">
                            <a href="<?php echo Link::orderHistoryDetail($orders['id']) ?>"><?php echo $orders['ordering_done'] ?></a>
                        </div>
                        <div class="notify_content"><?php echo $orders['total_product'] ?></div>
                        <div class="notify_content"><?php echo $orders['total_price'] ?></div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
            <?php
                $this->widget('CLinkPager', array(
                    'pages' => $orders['pages'],
                    'nextPageLabel' => '&gt;',
                    'prevPageLabel' => '&lt;',
                    'firstPageLabel' => '',
                    'lastPageLabel' => '',
                    'header' => '<div class="pager clr">',
                    'footer' => '</div>',
                    'htmlOptions' => array (
                		'id' => 'pagination',
                		'class' => 'pagination'
                    ),
                )); 
            ?>
        </div>
    </div>
</div>