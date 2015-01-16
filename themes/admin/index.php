<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'/>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="language" content="en" />        
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/themes/admin/css/bootstrap.min.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/themes/admin/css/font-awesome.min.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/themes/admin/css/ionicons.min.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/themes/admin/css/datatables/dataTables.bootstrap.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/themes/admin/css/iCheck/all.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/themes/admin/css/AdminLTE.css" />
        <link id="page_favicon" href="<?php echo Yii::app()->request->baseUrl ?>/themes/hieutam/images/logo.png" rel="icon" type="image/x-icon" />
        <title><?php echo CHtml::encode($this->pageTitle); ?></title>
        <?php Yii::app()->clientScript->registerCoreScript('jquery') ?>
        <?php Yii::app()->clientScript->registerCoreScript('jquery.ui') ?>
        <?php Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl."/themes/admin/js/bootstrap.min.js"); ?>
        <?php Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl."/themes/admin/js/task.js"); ?>
        <script type="text/javascript">
        	var base_url = '<?php echo Yii::app()->baseUrl ?>';
        </script>
    </head>
    <body class="skin-blue">
        <header class="header">
            <a href="#" class="logo">Tam Hieu</a>
            <nav class="navbar navbar-static-top" role="navigation">
                <!-- Sidebar toggle button-->
                <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
                <div class="navbar-right">
                    <ul class="nav navbar-nav">
                        <!-- Messages: style can be found in dropdown.less-->
                        <li class="dropdown messages-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-envelope"></i>
                                <span class="label label-success">4</span>
                            </a>
                        </li>
                        <li class="user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="glyphicon glyphicon-user"></i>
                                <span><?php echo Yii::app()->user->name ?></span>
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <aside class="left-side sidebar-offcanvas">
                <section class="sidebar">
                    <ul class="sidebar-menu">
                        <li class="<?php echo Yii::app()->controller->id == 'cataegory' ? 'active' : '' ?>">
                            <a href="<?php echo Yii::app()->createUrl('admin/category')?>">
                                <i class="fa fa-bars"></i> <span>Danh mục tin tức</span>
                            </a>
                        </li>
                        <li class="<?php echo Yii::app()->controller->id == 'news' ? 'active' : '' ?>">
                            <a href="<?php echo Yii::app()->createUrl('admin/news')?>">
                                <i class="fa fa-bars"></i> <span>Danh sách tin tức</span>
                            </a>
                        </li>
                        <li class="spacecol">&nbsp;</li>
                        <li class="<?php echo Yii::app()->controller->id == 'catalog' ? 'active' : '' ?>">
                            <a href="<?php echo Yii::app()->createUrl('admin/catalog')?>">
                                <i class="fa fa-bars"></i> <span>Danh mục sản phẩm</span>
                            </a>
                        </li>
                        <li class="<?php echo Yii::app()->controller->id == 'product' ? 'active' : '' ?>">
                            <a href="<?php echo Yii::app()->createUrl('admin/product')?>">
                                <i class="fa fa-bars"></i> <span>Danh sách sản phẩm</span>
                            </a>
                        </li>
                        <li class="<?php echo Yii::app()->controller->action->id == 'hot' ? 'active' : '' ?>">
                            <a href="<?php echo Yii::app()->createUrl('admin/product/hot')?>">
                                <i class="fa fa-bars"></i> <span>Sản phẩm tiêu biểu</span>
                            </a>
                        </li>
                        <li class="spacecol">&nbsp;</li>
                        <li class="<?php echo Yii::app()->controller->id == 'user' ? 'active' : '' ?>">
                            <a href="<?php echo Yii::app()->createUrl('admin/user')?>">
                                <i class="fa fa-bars"></i> <span>Danh sách khách hàng</span>
                            </a>
                        </li>
                        <li class="spacecol">&nbsp;</li>
                        <li class="<?php echo Yii::app()->controller->id == 'order' ? 'active' : '' ?>">
                            <a href="<?php echo Yii::app()->createUrl('admin/order/index')?>">
                                <i class="fa fa-bars"></i> <span>Danh sách đơn hàng</span>
                            </a>
                        </li>
                        <li class="spacecol">&nbsp;</li>
                        <li class="<?php echo Yii::app()->controller->id == 'feature' ? 'active' : '' ?>">
                            <a href="<?php echo Yii::app()->createUrl('admin/feature/index')?>">
                                <i class="fa fa-bars"></i> <span>Tính năng - Công dụng</span>
                            </a>
                        </li>
                        <li class="<?php echo Yii::app()->controller->id == 'manufacturer' ? 'active' : '' ?>">
                            <a href="<?php echo Yii::app()->createUrl('admin/manufacturer/index')?>">
                                <i class="fa fa-bars"></i> <span>Nhãn hàng</span>
                            </a>
                        </li>
                        <li class="spacecol">&nbsp;</li>
                        <li class="<?php echo Yii::app()->controller->id == 'agency' ? 'active' : '' ?>">
                            <a href="<?php echo Yii::app()->createUrl('admin/agency/index')?>">
                                <i class="fa fa-bars"></i> <span>Đại lý</span>
                            </a>
                        </li>
                        <li class="<?php echo Yii::app()->controller->id == 'partner' ? 'active' : '' ?>">
                            <a href="<?php echo Yii::app()->createUrl('admin/partner/index')?>">
                                <i class="fa fa-bars"></i> <span><?php echo Yii::t('app', 'Partners') ?></span>
                            </a>
                        </li>
                    </ul>
                </section>
            </aside>
            <aside class="right-side">
                <section class="content-header">
                    <h1>
                        <?php echo CHtml::encode($this->pageTitle); ?>
                    </h1>
                    <?php $this->renderButton() ?>
                    <?php 
                        if(isset($this->breadcrumbs)):
                            $this->widget('zii.widgets.CBreadcrumbs', array(
                                'links'=>$this->breadcrumbs, 'htmlOptions' => array('class' =>'breadcrumb')
                            ));
                        endif
                    ?>
                </section>
                <div class="col-lg-12" style="margin-top: 30px; margin-bottom: -30px;">
                    <?php $this->widget('application.extensions.Flash'); ?>
                </div>
                 <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <?php echo $content; ?>
                        </div>
                    </div>
                </section>
            </aside>
        </div>
    </body>
</html>
