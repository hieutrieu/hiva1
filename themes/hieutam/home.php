<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no"/>
	<meta name="language" content="en" />

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/themes/hieutam/css/bootstrap.min.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/themes/hieutam/css/style.css"/>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/themes/hieutam/css/reponsive.css"/>
    <link id="page_favicon" href="<?php echo Yii::app()->request->baseUrl ?>/themes/hieutam/images/logo.png" rel="icon" type="image/x-icon" />

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
    <?php Yii::app()->getClientScript()->registerCoreScript('jquery'); ?>
    <?php Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl."/themes/hieutam/js/bootstrap.min.js"); ?>
    <?php Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl."/themes/hieutam/js/jcarousel/jquery.jcarousel.min.js"); ?>
    <?php Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl."/themes/hieutam/js/jquery.truncator.js"); ?>
    <?php Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl."/themes/hieutam/js/slimscroll/jquery.slimscroll.min.js"); ?>
    <?php Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl."/themes/hieutam/js/app.js"); ?>
</head>
<body>
    <div class="wrapper">
        <div class="container">
            <div class="header">
                <div class="header-left"><a href="<?php echo Yii::app()->createUrl('site') ?>" class="logo">&nbsp;</a></div>
                <div class="header-right">
                    <div class="nav_top">
                        <div class="nav_top_left">
                            <?php $this->widget('application.widgets.topleftmenu');?>
                        </div>
                        <div class="nav_top_right">
                            <?php $this->widget('application.widgets.toprightmenu');?>                     
                        </div>
                        <div class="nav_top_center">
                            <?php //$this->widget('application.widgets.order');?>
                        </div>
                    </div>
                    <div class="nav_mid">
                        <input class="search" placeholder="Tìm kiếm" />
                    </div>
                    <div class="nav_bottom">
                        <?php $this->widget('application.widgets.mainmenu');?>
                    </div>
                </div>
            </div>
        </div>
        <div id="content">
            <?php echo $content; ?>
        </div>
        
        <div class="container">
            <div class="col-md-12">
                <div class="col-lg-3 col-md-3 col-sm-6 component first">
                    <div class="component_img youtube">
                        
                    </div>
                    <p>Videos clip hướng dẫn cách trang điểm, sử dụng mĩ phẩm để có làn da sáng mịn</p>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 component">
                    <div class="component_img news">
                        
                    </div>
                    <p>Tin tức báo chí và sự kiện về Công ty Cổ Phần Thương Mại & Dịch Vụ Tâm Hiếu</p>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 component">
                    <div class="component_img gift">
                        
                    </div>
                    <p>Ý tưởng quà tặng - Quà tặng bằng mỹ phẩm cao cấp Nhật Bản</p>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 component last">
                    <div class="component_img shipping">
                        
                    </div>
                    <p>Dịch vụ và điều khoản vận chuyển và cước phí, vận chuyển toàn quốc</p>
                </div>
            </div>
        </div>
        <div class="footer">
            <?php $this->widget('application.widgets.footermenu');?> 
        </div>
    </div>
</body>
</html>
