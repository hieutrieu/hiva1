/**
 * @license Copyright (c) 2003-2014, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:
	config.language = 'vi';
	//config.uiColor = '#f9f9f9';
	config.filebrowserBrowseUrl = '/themes/admin/js/plugins/ckfinder/ckfinder.html';
	config.filebrowserImageBrowseUrl = '/themes/admin/js/plugins/ckfinder/ckfinder.html?type=Images';
	config.filebrowserFlashBrowseUrl = '/themes/admin/js/plugins/ckfinder/ckfinder.html?type=Flash';
	config.filebrowserUploadUrl = '/themes/admin/js/plugins/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files';
	config.filebrowserImageUploadUrl = '/themes/admin/js/plugins/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images';
	config.filebrowserFlashUploadUrl = '/themes/admin/js/plugins/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash';
};
