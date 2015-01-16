<style>
    #content_main {
        background: #f7f7f7;
    }
</style>
<div class="container">
    <div class="about_small_title"><?php echo Yii::t('app', 'About') ?></div>
    <div class="about_title"><?php echo $news->title ?></div>
    <div class="about_img">
        <img src="<?php echo $news->image ?>"/>
    </div>
    <div class="about_content">
        <?php echo $news->content ?>
    </div>

</div>