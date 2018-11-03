/**
 * @license Copyright (c) 2003-2016, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';
    config.extraPlugins = 'fontawesome,youtube,btgrid,slideshow'
    config.contentsCss = ['../app/packages/ckeditor/plugins/fontawesome/font-awesome/css/font-awesome.min.css','../app/packages/ckeditor/contents.css'];
    config.allowedContent = true;
};
