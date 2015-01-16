<script type="text/javascript" src="<?php echo $this->path."/ckfinder.js"; ?>"></script>
<script type="text/javascript">
	function BrowseServerMultible(id){
		// You can use the "CKFinder" class to render CKFinder in a page:
		var finder = new CKFinder();
		finder.selectActionFunction = function(fileUrl, data) {
		  document.getElementById(id).value = fileUrl;
		  $('#show_' + id).attr('src', fileUrl);
		}
		finder.popup();
	}
</script>
<?php $images = json_decode($this->value); ?>
<?php for($i = 0; $i <= 3; $i++): ?>
    <div class="form-group">
        <img id="show_<?php echo $id.'_'.$i; ?>" src="<?php echo isset($images[$i]) ? $images[$i] : ''; ?>" width="100" height="100"/>
        <input id="<?php echo $id.'_'.$i; ?>" name="<?php echo $name; ?>[]" type="text" size="60" value="<?php echo isset($images[$i]) ? $images[$i] : ''; ?>"/>
        <input type="button" class="" value="<?php echo Yii::t('app', 'Select') ?>" onclick="BrowseServerMultible('<?php echo $id.'_'.$i; ?>');" />
    </div>
<?php endfor; ?>