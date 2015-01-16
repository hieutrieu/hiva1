<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
     <head>
        <meta charset="UTF-8">
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'/>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="language" content="en" />        
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/themes/admin/css/bootstrap.min.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/themes/admin/css/AdminLTE.css" />
        <title><?php echo CHtml::encode($this->pageTitle); ?></title>
        <?php Yii::app()->clientScript->registerCoreScript('jquery') ?>
        <?php Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl."/themes/admin/js/bootstrap.min.js"); ?>
        <script type="text/javascript">
        	var base_url = '<?php echo Yii::app()->baseUrl ?>';
        </script>
    </head>
    <body class="skin-blue">
        <div class="form-box" id="login-box">
        	<?php echo $content; ?>
        </div><!-- page -->
    </body>
</html>
