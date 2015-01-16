<?php $productModel = new ShopProduct; ?>
<ul class="main-menu">
    <li class="mega_dropdown">
        <a href="<?php echo Link::productCatalog(array('id' => Mainmenu::ID_DAMAT, 'title' => 'san-pham-da-mat'))?>" class="dropdown-toggle">Sản phẩm da mặt</a>
        <div class="dropdown_menu">
            <div class="dropdown_menu_content">
                <div class="dropdown_menu_body">
                    <div class="menu_main_left">
                        <div class="col_left">
                            <div class="menu_title">Công dụng</div>
                            <?php if(isset($catalogs[Mainmenu::ID_DAMAT])): ?>
                                <?php if(is_array($catalogs[Mainmenu::ID_DAMAT])): ?>
                                <ul>
                                    <?php foreach($catalogs[Mainmenu::ID_DAMAT]['subs'] as $catalog): ?>
                                        <li><a href="<?php echo Link::productCatalog(array('id' => $catalog->id, 'title' => $catalog->title)) ?>"><?php echo $catalog->title; ?></a></li>
                                    <?php endforeach; ?>
                                </ul>
                                <?php endif; ?>
                            <?php endif; ?>
                        </div>
                        <div class="col_left">
                            <div class="menu_title">Phân loại theo</div>
                            <ul>
                                <li><a href="<?php echo Link::productCatalog(array('id' => Mainmenu::ID_DAMAT, 'title' => 'san-pham-da-mat', 'sort' => 'buy'))?>">Sản phẩm mua nhiều nhất</a></li>
                                <li><a href="<?php echo Link::productCatalog(array('id' => Mainmenu::ID_DAMAT, 'title' => 'san-pham-da-mat', 'sort' => 'date'))?>">Mới nhất</a></li>
                                <li><a href="<?php echo Link::productCatalog(array('id' => Mainmenu::ID_DAMAT, 'title' => 'san-pham-da-mat', 'sort' => 'rating'))?>">Top bình chọn</a></li>
                                <li><a href="<?php echo Link::productCatalog(array('id' => Mainmenu::ID_DAMAT, 'title' => 'san-pham-da-mat', 'sort' => 'manufacturer'))?>">Được mua nhiều nhất</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="menu_main_right">
                        <div class="menu_title">Sản phẩm tiêu biểu</div>
                        <?php $productDamats = $productModel->getHotProductByCatategoryId(Mainmenu::ID_DAMAT); ?>
                        <?php if(count($productDamats) > 0): ?>
                            <div class="mainmenu-slider-wrapper">
                                <div class="mainmenu-slider-container">
                                    <ul>
                                        <?php foreach($productDamats as $productDamat): ?>
                                        <li class="item">
                                            <a href="<?php echo Link::productDetail(array('id' => $productDamat->id, 'title' => $productDamat->title)) ?>">
                                                <img class="s_product_img" src="<?php echo $productDamat->thumbnail ?>" />
                                                <div class="s_product_name"><?php echo Helper::textWrap($productDamat->title) ?></div>
                                            </a>
                                        </li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                
                                <a href="#" class="mainmenu-control-prev">&nbsp;</a>
                                <a href="#" class="mainmenu-control-next">&nbsp;</a>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </li>
    <li class="mega_dropdown">
        <a href="<?php echo Link::productCatalog(array('id' => Mainmenu::ID_TOC, 'title' => 'san-pham-toc'))?>" class="dropdown-toggle">Sản phẩm tóc</a>
        <div class="dropdown_menu">
            <div class="dropdown_menu_content">
                <div class="dropdown_menu_body">
                    <div class="menu_main_left">
                        <div class="col_left">
                            <div class="menu_title">Công dụng</div>
                            <?php if(isset($catalogs[Mainmenu::ID_TOC])): ?>
                            <?php if(is_array($catalogs[Mainmenu::ID_TOC])): ?>
                                <ul>
                                    <?php foreach($catalogs[Mainmenu::ID_TOC]['subs'] as $catalog): ?>
                                        <li><a href="<?php echo Link::productCatalog(array('id' => $catalog->id, 'title' => UrlTransliterate::cleanString($catalog->title, '-'))) ?>"><?php echo $catalog->title; ?></a></li>
                                    <?php endforeach; ?>
                                </ul>
                            <?php endif; ?>
                            <?php endif; ?>
                        </div>
                        <div class="col_left">
                            <div class="menu_title">Phân loại theo</div>
                            <ul>
                                <li><a href="<?php echo Link::productCatalog(array('id' => Mainmenu::ID_TOC, 'title' => 'san-pham-toc', 'sort' => 'buy'))?>">Sản phẩm mua nhiều nhất</a></li>
                                <li><a href="<?php echo Link::productCatalog(array('id' => Mainmenu::ID_TOC, 'title' => 'san-pham-toc', 'sort' => 'date'))?>">Mới nhất</a></li>
                                <li><a href="<?php echo Link::productCatalog(array('id' => Mainmenu::ID_TOC, 'title' => 'san-pham-toc', 'sort' => 'rating'))?>">Top bình chọn</a></li>
                                <li><a href="<?php echo Link::productCatalog(array('id' => Mainmenu::ID_TOC, 'title' => 'san-pham-toc', 'sort' => 'manufacturer'))?>">Được mua nhiều nhất</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="menu_main_right">
                        <div class="menu_title">Sản phẩm tiêu biểu</div>
                        <?php $productTocs = $productModel->getHotProductByCatategoryId(Mainmenu::ID_TOC); ?>
                        <?php if(count($productTocs) > 0): ?>
                            <div class="mainmenu-slider-wrapper">
                                <div class="mainmenu-slider-container">
                                    <ul>
                                        <?php foreach($productTocs as $productToc): ?>
                                        <li class="item">
                                            <a href="<?php echo Link::productDetail(array('id' => $productToc->id, 'title' => $productToc->title)) ?>">
                                                <img class="s_product_img" src="<?php echo $productToc->thumbnail ?>" />
                                                <div class="s_product_name"><?php echo Helper::textWrap($productToc->title) ?></div>
                                            </a>
                                        </li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                
                                <a href="#" class="mainmenu-control-prev">&nbsp;</a>
                                <a href="#" class="mainmenu-control-next">&nbsp;</a>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </li>
    <li><a href="<?php echo Link::productCatalog(array('id' => Mainmenu::ID_MAKEUP, 'title' => 'make-up'))?>" class="dropdown-toggle">Make up</a></li>
    <li><a href="<?php echo Link::productCatalog(array('id' => Mainmenu::ID_DACTRI, 'title' => 'san-pham-dac-tri'))?>" class="dropdown-toggle">Sản phẩm đặc trị</a></li>
    <li><a href="<?php echo Link::productCatalog(array('id' => Mainmenu::ID_OTHER, 'title' => 'san-pham-khac'))?>" class="dropdown-toggle">Sản phẩm khác</a></li>
    <li class="<?php echo Yii::app()->controller->action->id == 'about' ? 'active' : '' ?>"><?php echo CHtml::link('Ngôi nhà tâm hiếu', Yii::app()->createUrl('site/about')); ?></li>
</ul>