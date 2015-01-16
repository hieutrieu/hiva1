<script>
    $(function(){
        $('.product_detail_des').truncate({
            //max_length: 280,
            max_length: 500,
            more: '<?php echo Yii::t('app', 'Detail') ?>',
            less: '<?php echo Yii::t('app', 'Hide') ?>'
        });

    });
</script>
<?php
    $baseUrl = Yii::app()->baseUrl; 
    $cs = Yii::app()->getClientScript();
    $cs->registerScriptFile($baseUrl.'/themes/hieutam/js/jcarousel/jcarousel.connected-carousels.js', CClientScript::POS_HEAD);
    $cs->registerCssFile($baseUrl.'/themes/hieutam/js/jcarousel/jcarousel.connected-carousels.css');
    $images = json_decode($product->image);
    if(count($images) < 4) {
        $navWidth = ((count($images)*56)+(count($images)-1)*10);
    } else {
        $navWidth = 254;
    }
?>
<div class="container">
    <div class="product_detail_container">
        <div class="product_detail_left">
            <div class="connected-carousels">
                <div class="stage">
                    <div class="carousel carousel-stage">
                        <ul>
                            <?php foreach($images as $image): ?>
                                <li><img src="<?php echo $image ?>" width="420" height="420" alt=""/></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                    <a href="#" class="prev prev-stage"><span>&nbsp;</span></a>
                    <a href="#" class="next next-stage"><span>&nbsp;</span></a>
                </div>

                <div class="navigation" style="width: <?php echo $navWidth ?>px;">
                    <div class="carousel carousel-navigation">
                        <ul>
                            <?php foreach($images as $image): ?>
                                <li><img src="<?php echo $image ?>" width="54" height="54" alt=""/></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="product_detail_right">
            <div class="product_detail_name"><?php echo $product->title ?></div>
            <div class="product_detail_des"><?php echo $product->description ?></div>
            <div class="product_detail_price"><?php echo Helper::formatCurrency($product->price)?> <?php echo $product->currency ?></div>
            <div class="product_detail_quanlity">
                Số lượng 
                <select class="number">
                    <?php for($i = 1; $i <= 100; $i++): ?>
                        <option value="<?php echo $i ?>"><?php echo $i ?></option>
                    <?php endfor; ?>
                </select>
            </div>
            <div class="product_detail_order"><a href="#">Đặt vào giỏ hàng</a></div>
            <div class="product_detail_trans">(Giao hàng miễn phí)</div>
        </div>
    </div>
    
    <div class="product_relation_container">
        <div class="product_relation_title">Sản phẩm cùng bộ</div>
        <div class="products">
            <?php $this->renderPartial('_products', array('products' => $productRelations, 'disableSort' => true)) ?>
        </div> 
    </div>
    <div class="product_relation_container">
        <div class="product_relation_title"><?php echo Yii::t('app', 'Comment Rating')?></div>
        <div class="products">
            <?php $this->widget('CStarRating',array('name'=>'rating', 'maxRating' => 5, 'minRating' => 1)); ?>
            <?php $this->renderPartial('_comment_rating', array('commentRates' => $commentRates, 'productId' => $product->id)) ?>
        </div> 
    </div>
</div>