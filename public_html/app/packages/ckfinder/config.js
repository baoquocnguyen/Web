/*
Copyright (c) 2003-2012, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckfinder.com/license
*/

CKFinder.customConfig = function( config )
{
	// Define changes to default configuration here.
	// For the list of available options, check:
	// http://docs.cksource.com/ckfinder_2.x_api/symbols/CKFinder.config.html

	// Sample configuration options:
	// config.uiColor = '#BDE31E';
	// config.language = 'fr';
	// config.removePlugins = 'basket';
    config.filebrowserBrowseUrl = '/app/packages/ckfinder/ckfinder.html';
     
    config.filebrowserImageBrowseUrl = '/app/packages/ckfinder/ckfinder.html?type=Images';
     
    config.filebrowserFlashBrowseUrl = '/app/packages/ckfinder/ckfinder.html?type=Flash';
     
    config.filebrowserUploadUrl = '/app/packages/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files';
     
    config.filebrowserImageUploadUrl = '/app/packages/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images';
     
    config.filebrowserFlashUploadUrl = '/app/packages/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash';

};
