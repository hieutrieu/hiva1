<div class="container">
    <div class="contact_title"><?php echo Yii::t('app', 'Agency') ?></div>
    <?php foreach($agencies as $agency):?>
        <div class="col-lg-12 agency_list">
            <div class="col-lg-6 no-padding">
                <h3 class="contact_title_company"><?php echo $agency['name'] ?></h3>
                <div class="form">
                    <div class="contact_add_map"><?php echo $agency['address'] ?></div>
                    <div class="contact_add_phone"><?php echo $agency['phone'] ?></div>
                    <div class="contact_add_fax"><?php echo $agency['fax'] ?></div>
                </div><!-- form -->
            </div>
            <div class="col-lg-6 no-padding">
                <img class="agency_map" src="<?php echo Yii::app()->baseUrl . $agency['url_map'] ?>"/>
            </div>
        </div>
    <?php endforeach; ?>
</div>