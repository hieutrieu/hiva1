<div class="product_thumb">
    <div class="product_thumb_container">
        <a href="<?php echo Link::productDetail(array('id' => $product->id, 'title' => $product->title)) ?>">
            <img src="<?php echo $product->thumbnail ?>" />
            <div class="product_name"><?php echo $product->title ?></div>
        </a>
        <div class="product_price"><?php echo Helper::formatCurrency($product->price) ?> <?php echo $product->currency ?></div>
        <div class="add_order">
            <span onclick="return addtocart(event, this, '<?php echo Link::addToCart(array('id' => $product->id, 'title' => $product->title)) ?>');">Mua ngay</span>
        </div>
    </div>
</div>