<?php
/* @var $this SiteController */
/* @var $error array */

    $this->pageTitle = Yii::t('app', 'Error');
?>
<div class="container">
    <div class="error-page">
        <div class="error-body">
            <h2 class="headline text-info"><?php echo $code; ?></h2>
            
            <div class="error-content">
                <?php echo CHtml::encode($message); ?>
            </div>
        </div>
    </div>
</div>