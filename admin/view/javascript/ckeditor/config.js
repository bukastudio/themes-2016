/**
 * @license Copyright (c) 2003-2014, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.html or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';

	config.extraPlugins = 'codemirror,wenzgmap,youtube,googledocs';
	config.codemirror_theme = 'rubyblue';  // Go here for theme names: http://codemirror.net/demo/theme.html
	config.codemirror = {
	lineNumbers: true,
	highlightActiveLine: true,
	enableSearchTools: true,
	showSearchButton: true,
	showFormatButton: true,
	showCommentButton: true,
	showUncommentButton: true,
	showAutoCompleteButton: true
	};

  config.toolbar = 'Custom';

  config.toolbar_Custom = [
    { name: 'document', groups: [ 'mode', 'document', 'doctools' ], items: [ 'Source' , '-', 'Maximize' ] },
    { name: 'clipboard', groups: [ 'clipboard', 'undo' ], items: [ 'Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo' ] },
    { name: 'editing', groups: [ 'find', 'selection', 'spellchecker' ], items: [ 'Scayt' ] },
    '/',
    { name: 'links', items: [ 'Link', 'Unlink', 'Anchor' ] },
    { name: 'insert', items: [ 'Image', 'Youtube', 'Table', 'HorizontalRule', 'SpecialChar' ] },
    '/',
    { name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ], items: [ 'Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-', 'RemoveFormat' ] },
		{ name: 'paragraph', groups: [  'align', 'list', 'indent' ], items: [ 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', '-' , 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent' ] }
  ];

  // Toolbar groups configuration.
  config.toolbarGroups = [
    { name: 'document', groups: [ 'mode', 'document', 'doctools' ] },
    { name: 'clipboard', groups: [ 'clipboard', 'undo' ] },
    { name: 'editing', groups: [ 'find', 'selection', 'spellchecker' ] },
    { name: 'forms' },
    '/',
    { name: 'links' },
    { name: 'insert' },
    '/',
    { name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
	{ name: 'paragraph', groups: [ 'align', 'list', 'indent' ] }
  ];

// Comment out or remove the 2 lines below if you want to enable the Advanced Content Filter
config.allowedContent = true;
config.extraAllowedContent = '*{*}';
};