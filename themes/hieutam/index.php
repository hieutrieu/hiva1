<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'/>
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
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
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
                            <?php $this->widget('application.widgets.order');?>
                        </div>
                    </div>
                    <div class="nav_mid">
                        <?php $this->widget('application.widgets.search');?>
                    </div>
                    <div class="nav_bottom">
                        <?php $this->widget('application.widgets.mainmenu');?>
                    </div>
                </div>
            </div>
        </div>
        <?php if(isset($this->breadcrumbs)):?>
            <div id="breadcrumbs">
                <div class="container">
            		<?php $this->widget('zii.widgets.CBreadcrumbs', array(
                        'homeLink' => false,
            			'links'=>$this->breadcrumbs,
                        'separator' => '<span class="separator"> > </span>',
            		)); ?>
                    <div class="customer_code">
                        <?php if(Yii::app()->user->isGuest): ?>
                            Xin quý khách hàng đăng nhập để hưởng chế độ đặc biệt
                        <?php else: ?>
                            <a href="<?php echo Link::newsVoucher()?>">Mời quý khách hàng xem chương trình ưu đãi của công ty (Dành cho khách hàng Online)</a>
                            <?php if(isset(Yii::app()->user->customer_code)): ?>
                                <div class="code_voucher">
                                    <small>Mã ưu đãi</small>
                                    <div><?php echo Yii::app()->user->customer_code ?></div>
                                </div>
                            <?php endif; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
    	<?php endif?>
        <div id="content_main">
            <?php $this->widget('application.extensions.email.debug'); ?>
            <?php echo $content; ?>
        </div>
        <div class="footer">
            <?php $this->widget('application.widgets.footer');?> 
        </div>
    </div>
</body>
</html>
