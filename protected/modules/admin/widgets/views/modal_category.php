<?php
	$cs = Yii::app()->clientScript;  
	$cs->coreScriptPosition = CClientScript::POS_HEAD;
	$cs->scriptMap = array();
	$cs->registerCoreScript('jquery');
	$cs->registerScriptFile($path . '/fancybox/jquery.fancybox.js');
	$cs->registerCssFile($path . '/fancybox/jquery.fancybox.css');
	$cs->registerScript(
		__CLASS__, 
		'$(".fancybox").fancybox({
			maxWidth	: 800,
			maxHeight	: 600,
			fitToView	: false,
			width		: "70%",
			height		: "70%",
			autoSize	: false,
			closeClick	: false,
			openEffect	: "none",
			closeEffect	: "none"
		});'						
	);
	
	$script = array();
	$script[] = '	function mSelectCategory'. $id .'(id, title, catid, object) {';
	$script[] = '		document.getElementById("'.$id.'").value = id;';
	$script[] = '		document.getElementById("'.$id.'_name").value = title;';
	$script[] = '		$.fancybox.close();';
	$script[] = '	}';
	$cs->registerScript($id, implode("\n", $script), CClientScript::POS_BEGIN );
?>

<?php echo $label ?>
<?php echo $field ?>

<input class="inputbox" disabled="disabled" id="<?php echo $id; ?>_name" name="<?php echo $name; ?>_name" value="<?php echo $title ?>" type="text"/>
<a href="<?php echo Yii::app()->createUrl('/admin/category', array('tmpl' => 'modal', 'function' => 'mSelectCategory'. $id)) ?>" onclick="" class="button fancybox fancybox.iframe"><?php echo Yii::t('app', 'Select Category')?></a>
