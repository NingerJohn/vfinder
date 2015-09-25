/*******************************************************************************
* KindEditor - plugin
* Copyright (C) 2006-2011 kindsoft.net
* upload file plugin
*******************************************************************************/

	// method of showing the file upload dialog
	function showDialog(){
		//
		$('div.upload-dialog').css('display','block');
		$('div.dialog-cover').css('display','block');
		selectAgain();
		$('input.select-file').val("");
		$('div.progress').addClass('progress-striped');
	}

KindEditor.plugin('upload', function(K) {
        var editor = this, name = 'upload';
        // 点击图标时执行
        editor.clickToolbar(name, function() {
               	//
               	showDialog();
        });
});