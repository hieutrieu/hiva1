<?php
    $baseUrl = Yii::app()->baseUrl; 
    $cs = Yii::app()->getClientScript();
    $cs->registerScriptFile($baseUrl.'/themes/hieutam/js/gallery/modernizr.custom.js', CClientScript::POS_END);
    $cs->registerScriptFile($baseUrl.'/themes/hieutam/js/gallery/imagesloaded.pkgd.min.js', CClientScript::POS_END);
    $cs->registerScriptFile($baseUrl.'/themes/hieutam/js/gallery/masonry.pkgd.min.js', CClientScript::POS_END);
    $cs->registerScriptFile($baseUrl.'/themes/hieutam/js/gallery/classie.js', CClientScript::POS_END);
    $cs->registerCssFile($baseUrl.'/themes/hieutam/css/gallery.css');
?>
<div id="grid-gallery" class="grid-gallery">
	<section class="grid-wrap">
		<ul class="grid">
			<li class="grid-sizer"></li><!-- for Masonry column width -->
            <?php foreach($partners as $partner):?>
			<li>
				<figure>
					<img src="<?php echo $partner->image ?>" alt="<?php echo $partner->name ?>"/>
					<figcaption>
                        <a href="<?php echo $partner->url ?>"><h3><?php echo $partner->name ?></h3></a>
                        <p><?php echo $partner->description ?></p>
                    </figcaption>
				</figure>
			</li>
            <?php endforeach; ?>
		</ul>
	</section><!-- // grid-wrap -->
</div><!-- // grid-gallery -->