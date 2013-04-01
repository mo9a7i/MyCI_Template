/*
Copyright (c) 2003-2012, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/

CKEDITOR.editorConfig = function( config )
{
	
	config.width = '550px';
	config.height = '100px';
	config.border = 'none';
	config.language = 'ar';
	config.skin = 'kama';
	config.removePlugins = 'elementspath';
	config.uiColor = '#ffffff';
	
	config.toolbar = 'MyToolbar';
 
	config.toolbar_MyToolbar =
	[
		{ name: 'document', items : [ 'NewPage','Preview' ] },
		{ name: 'clipboard', items : [ 'Cut','Copy','Paste','PasteText','PasteFromWord','-','Undo','Redo' ] },
		{ name: 'editing', items : [ 'Find','Replace','-','SelectAll','-','Scayt' ] },
		{ name: 'insert', items : [ 'Image','Flash','Table','HorizontalRule','Smiley','SpecialChar','PageBreak'
                 ,'Iframe' ] },
                '/',
		{ name: 'styles', items : [ 'Styles','Format' ] },
		{ name: 'basicstyles', items : [ 'Bold','Italic','Strike','-','RemoveFormat' ] },
		{ name: 'paragraph', items : [ 'NumberedList','BulletedList','-','Outdent','Indent','-','Blockquote' ] },
		{ name: 'links', items : [ 'Link','Unlink','Anchor' ] },
		{ name: 'tools', items : [ 'Maximize','-','About' ] }
	];
	config.toolbar = 'Mo9a7iToolbar';
	config.entities = false;
	config.pasteFromWordRemoveFontStyles = false;
	config.toolbar_Mo9a7iToolbar = 
	[
		{name : 'text' , items : ['Bold','Italic','Underline','Strike','Subscript','Superscript','-','RemoveFormat']},
		{name : 'formatting' , items : ['NumberedList','BulletedList','-','Outdent','Indent','-','Blockquote',
'-','JustifyRight','JustifyCenter','JustifyLeft','JustifyBlock','-','BidiRtl','BidiLtr']},
		{name : 'link' , items : ['Link','Unlink','Anchor']},
		{name : 'insert' , items : ['Image','Flash','Table','HorizontalRule','SpecialChar','PageBreak','Iframe']},
		{name : 'styling' , items : ['Format','Font','FontSize','TextColor','BGColor']},
		{name : 'other' , items : ['Source','-','About']}
	];

};
