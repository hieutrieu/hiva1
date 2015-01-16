<a class="icon icon_youtube" href="https://www.youtube.com/" target="_blank"></a>
<a class="icon icon_twitter" href="https://twitter.com/" target="_blank"></a>
<a class="icon icon_google" href="https://www.google.com.vn/" target="_blank"></a>
<a class="icon icon_facebook" href="https://www.facebook.com/" target="_blank"></a>
<ul class="menu_top">
    <li><a class="<?php echo Yii::app()->controller->id == 'news' ? 'active' : '' ?>" href="<?php echo Yii::app()->createUrl('news/list') ?>"><?php echo Yii::t('app', 'News')?></a></li>
    <li><a class="<?php echo Yii::app()->controller->action->id == 'contact' ? 'active' : '' ?>" href="<?php echo Yii::app()->createUrl('site/contact') ?>"><?php echo Yii::t('app', 'Contact')?></a></li>
    <li><a class="<?php echo Yii::app()->controller->id == 'recruitment' ? 'active' : '' ?>" href="<?php echo Yii::app()->createUrl('recruitment/list') ?>"><?php echo Yii::t('app', 'Recruitment')?></a></li>
    <li><a class="<?php echo Yii::app()->controller->id == 'agency' ? 'active' : '' ?>" href="<?php echo Yii::app()->createUrl('agency/list') ?>"><?php echo Yii::t('app', 'Agency')?></a></li>
</ul>