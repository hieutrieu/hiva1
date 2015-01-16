<script type="text/javascript" src="<?php echo $this->path."/ckfinder.js"; ?>"></script>
<script type="text/javascript">

	function BrowseServer(id){
		// You can use the "CKFinder" class to render CKFinder in a page:
		var finder = new CKFinder();
		finder.selectActionFunction = function(fileUrl, data) {
			document.getElementById(id).value = fileUrl;
			$('#show_' + id).attr('src', fileUrl);
		}
		finder.popup();
	}
</script>
<img id="show_<?php echo $id; ?>" src="<?php echo $this->value; ?>" width="100" height="100"/>
<input id="<?php echo $id; ?>" name="<?php echo $name; ?>" type="text" size="60" value="<?php echo $this->value; ?>"/>
<input type="button" class="" value="<?php echo Yii::t('app', 'Select') ?>" onclick="BrowseServer('<?php echo $id; ?>');" />