<style>
    #content_main {
        border-top:  2px solid #ddd;
        padding-top: 40px;
    }
</style>
<div class="container">
    <div class="products">
        <?php 
            if(count($products['products']) > 0) {
                $this->renderPartial('_products', array('products' => $products, 'params' => $params));
            } else {
                echo '<div class="notfound">'. Yii::t('app', 'Not found products') .'</div>';
            } 
        ?>
    </div>    
</div>