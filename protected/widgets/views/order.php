<?php
    $session = Yii::app()->session['carts'];
    $totalPrice = 0;
    $products = array();
    if(is_array($session)) {
        $ids = array();
        foreach($session as $item) {
            $ids[$item['product_id']] = $item['quantity'];
        }
        $productModel = new ShopProduct;
        $products = $productModel->getProductByIds(array_keys($ids));
        foreach($products as &$product) {
            $product->quantity = $ids[$product->id];
            $product->total = $product->price * $product->quantity;
            $totalPrice += $product->total; 
        }
    }
?>
<div class="order_bar">
    <div class="order_cart"></div>
    <div class="order_price_info">
        <div class="order_price"><?php echo Helper::formatCurrency($totalPrice)?> VND</div>
    	<a href="#" class="order_info" data-content="Loading..." data-html="true" data-container="body" data-toggle="popover" data-placement="bottom"><?php echo Yii::t('app', 'Xem giỏ hàng') ?></a>
        <div class="popover bottom fade in">
            <div class="arrow"></div>
            <div class="popover-content">
                <?php echo Yii::t('app', 'Loading...') ?>
            </div>
            <div class="popover-title"><a href="<?php echo Yii::app()->createUrl('shoppingcart/order') ?>"><?php echo Yii::t('app', 'Checkout') ?></a></div>
        </div>
    </div>
</div>
