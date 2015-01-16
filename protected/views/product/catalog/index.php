<div class="category_parent" style="background-image: url('<?php echo $categories['parent']->image != '' ? $categories['parent']->image : '/images/catalog_default.png'?>');">
    <div class="parent_container">
        <div class="category_headera_title"><?php echo Yii::t('app', 'Feature') ?></div>
        <?php foreach($categories['groups'] as $groupTitle => $groups): ?>
            <div class="category_group">
                <!--div class="category_group_title"><?php //echo $groupTitle ?></div-->
                <?php foreach($groups as $category): ?>
                    <div class="category_title">
                        <a href="<?php echo Link::productCatalog(array('id' => $category->id, 'title' => $category->title)) ?>"><?php echo $category->title ?></a>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endforeach; ?>
    </div>
    
    <?php if(count($manufacturers) > 0): ?>
        <div class="parent_container manufacturer">
            <div class="category_headera_title"><?php echo Yii::t('app', 'Manufacturer') ?></div>
            <?php foreach($manufacturers as $manufacturer): ?>
                <div class="category_title">
                    <a href="<?php echo Link::productManufacture(array('id' => $params['id'], 'mid' => $manufacturer['id'], 'name' => $manufacturer['name'])) ?>"><?php echo $manufacturer['name'] ?></a>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>

<div class="container">
    <?php if(!isset($disableSort)): ?>
    <div class="sort_product">
        <div class="fleft category_parent_title"><?php echo $categories['parent']->title ?></div>
        <ul class="nav nav-tabs pull-right">
            <li class="<?php echo ($params['sort'] == '' || $params['sort'] == 'buy') ? 'active' : '' ?>"><a href="<?php echo Link::productCatalog(array('id' => $params['id'], 'title' => $params['title'], 'sort' => 'buy')) ?>">Hàng mua nhiều</a></li>
            <li class="<?php echo ($params['sort'] == 'manufacturer') ? 'active' : '' ?>"><a href="<?php echo Link::productCatalog(array('id' => $params['id'], 'title' => $params['title'], 'sort' => 'manufacturer')) ?>">Sắp xếp theo hãng</a></li>
            <li class="<?php echo ($params['sort'] == 'rating') ? 'active' : '' ?>"><a href="<?php echo Link::productCatalog(array('id' => $params['id'], 'title' => $params['title'], 'sort' => 'rating')) ?>">Sắp xếp theo đánh giá</a></li>
        </ul>
    </div>
    <?php endif; ?>
    <div class="products">
        <?php $this->renderPartial('_products', array('products' => $products, 'params' => $params)) ?>
    </div>    
</div>