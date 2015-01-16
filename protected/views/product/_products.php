<div class="product_container col-lg-12">
    <?php foreach($products['products'] as $index => $product): ?>
        <?php $this->renderPartial('_product_thumb', array('product' => $product)) ?>
        <?php if(($index+1)%5 == 0 || ($index+1) == count($products['products'])): ?>
            <div class="break_row"><hr/></div> 
        <?php endif; ?>
    <?php endforeach; ?>
    
    <?php
        $this->widget('CLinkPager', array(
                        'pages' => $products['pages'],
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