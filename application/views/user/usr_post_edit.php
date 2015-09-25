<!--  -->
<script src="<?php echo $style_folder.'bootstrap/js/jquery.min.js';?>"></script>
<!-- kindeditor -->
<script charset="utf-8" src="<?=$style_folder?>editor/kindeditor.js"></script>
<script charset="utf-8" src="<?=$style_folder?>editor/lang/zh_CN.js"></script>
<!--  -->
<link rel="stylesheet" href="<?=$style_folder?>tags-input/jquery.tagsinput.css" />
<script charset="utf-8" src="<?=$style_folder?>tags-input/jquery.tagsinput.js"></script>
<script>
KindEditor.ready(function(K) {
    var options = {
    	items:['undo', 'redo', '|','fontname', 'fontsize', '|', 'justifyleft', 'justifycenter', 'justifyright','|',
    	'forecolor', 'hilitecolor', 'bold','italic', 'underline', 'selectall','removeformat', '|', 
    	'emoticons', 'image','upload', 'link', 'wordpaste', 'source','preview'],
    	height:'350px',
    	resizeType:'0',
    	allowFileManager : true,
    	themeType : 'post',
    }
    window.editor = K.create('#editor_id',options);
});
	/* 初始化标签输入法 */
	$(function(){
		$("input.tags").tagsInput({
			'width':'700px', // 标签框的宽度
			'height':'40px', // 标签框的高度
			'removeWithBackspace' : true,
			'defaultText':'<?=$tag?>', //默认文字
		});
	});
</script>

<div class="container post-edit">
	<form class="post" action="<?=base_url().'index.php/user/submit_post'?>" role="form" method="post" enctype="multipart/form-data">
		<!-- title -->
		<input type="text" name="title" class="form-control title" placeholder="<?=$input_title?>" value="<?php if(isset($id)){ echo $id;}?>">
		<!-- description -->
		<textarea id="editor_id" name="content" class='form-control' style="width:700px;height:300px;"></textarea>
		<!-- tags -->
		<input name="tags" type="text" class="tags form-control" placeholder="标签">
		<!-- attachment -->
		<input name="attachment" type="text" class="attachment" />
		<div class="attachment">
			<span class="glyphicon glyphicon-tag"></span>
			<span class="uploaded-file"></span>
			
			<a href="" class="delete-file-action"><?=$delete?></a>
		</div>
		<input type="button" id="upload-btn" class="btn btn-primary" value="<?=$upload_file?>" />
		<!-- category -->
		<label class="category"><?=$category?></label>
		<select name="category" id="category" class="form-control" style="width:auto;font-size:15px"></select>
		<!-- subcategory -->
		<label class="sub-category"><?=$sub_category?></label>
		<select name="subcategory" id="subcategory" class="form-control" style="width:auto;font-size:15px"></select>
		<!-- test of select -->
		<span class="msg"></span>
		<!-- submit button -->
		<button type="submit" class="btn btn-primary submit"><?=$submit?></button>
	</form>
	<!-- upload window -->
	<div class="dialog-cover"></div>
	<div class="upload-dialog">
		<div class="dialog-head"> <span class="glyphicon glyphicon-remove"></span> </div>
		<iframe name="hidden_frame" style="display:none;"></iframe>
		<form name="upload" action="<?=base_url()."index.php/user/upload_file"?>" target="hidden_frame" method="post" enctype="multipart/form-data">
			<input type="file" class="select-file" name="attachment" value="<?=$select_file?>" target="hidden_frame" />
			<div class="progress progress-striped active">
			   <div class="progress-bar  progress-bar-info" role="progressbar" style="width: 0%;">
			      <span class="sr-only">40% 完成</span>
			   </div>
			</div>
			<div class="upload-result"></div>
			<input type="submit" class="upload" value="<?=$upload_file?>" />
			<input type="button" class="btn-confirm" value="<?=$confirm?>">
		</form>
	</div>
</div>
</div>
<script type="text/javascript">
	var jsonData = '{"<?=$movie?>":["<?=$cam?>","<?=$dvd?>","<?=$hdtv?>","<?=$seven_p?>","<?=$eight_p?>"],"<?=$music?>":["<?=$lossless?>","<?=$mp3?>","<?=$others?>"],"<?=$tv?>":["<?=$usa_tv?>","<?=$uk_tv?>","<?=$cn_tv?>"],"<?=$software?>":["<?=$win?>","<?=$linux?>","<?=$mac?>"]}';
	var obj = $.parseJSON(jsonData);
	var simpleData = '{"movie":["cam","dvd","hdtv","seven_p","eight_p"],"music":["lossless","mp3","others"],"tv":["usa_tv","uk_tv","cn_tv"],"software":["$win","linux","mac"]}';
	var simple = $.parseJSON(simpleData);
	function initializeCate(data){
		var one = "";
		var two="";
		var times = 0;
		var preg = /\$(\w)*\?/;
		$.each(obj,function(oneKey,oneVal){
			times++;
			var temp = "<?//=$"+oneKey+"?>";
			one += ('<option value="'+oneKey+'">'+oneKey+'</option>');
			if(times<=1){
				$.each(oneVal,function(twoKey,twoVal){
					two += ('<option value="'+twoVal+'">'+twoVal+'</option>');
				})
			}
		});
		$('select#category').append(one);
		$('select#subcategory').append(two);
	}
	function test(data){
		var temp = data.replace(/\/\//,"");
		return temp;
	}
	// declare the initialize method for category
	function selectinit(obj){
		var one = "";
		var two="";
		var times = 0;
		var preg = /\$(\w)*\?/;
		$.each(obj,function(oneKey,oneVal){
			times++;
			one += ('<option value="'+oneKey+'">'+oneKey+'</option>');
			if(times<=1){
				$.each(oneVal,function(twoKey,twoVal){
					two += ('<option value="'+twoVal+'">'+twoVal+'</option>');
				})
			}
		});
		$('select#category').append(one);
		$('select#subcategory').append(two);
	}
	// run the initialize method
	selectinit(obj);
	// declare the change subcategory method
	function changeSub(obj){
		var a = "";
		$('select#subcategory').html("");
		//var data = obj;
		var value = $('select#category').val();
		$.each(obj,function(one,oneVal){
			if((one==value)){
				$.each(oneVal,function(two,twoVal){
					a += ('<option value="'+twoVal+'">'+twoVal+'</option>');
				})
			}
		})
		$('select#subcategory').append(a);
	}
	// once select tag of category changed then run the relative method
	$('select#category').change(function(){
		changeSub(obj);
	});

	// method of showing the file upload dialog
	function showDialog(){
		//
		$('div.upload-dialog').css('display','block');
		$('div.dialog-cover').css('display','block');
		selectAgain();
		$('input.select-file').val("");
		$('div.progress').addClass('progress-striped');
	}
	// hide the file upload dialog method
	function hideDialog(){
		//
		$('div.upload-dialog').css('display','none');
		$('div.dialog-cover').css('display','none');
	}
	//
	$('input#upload-btn').click(function(){showDialog()});
	$('span.glyphicon-remove').click(function(){hideDialog()});
	// declare the methods for the progress of file uploading 
	function progress(){
		for (var i = 1; i <= 100; i++) {
			$('div.progress-bar').css('width',i+"%");
		}
	}
	function showResult(data){
		var fileLink = "<?=base_url()?>"+data['filedir'];
		$('div.progress').removeClass('progress-striped');
		$('div.upload-result').html('<?=$upload_success?>').show('5000');
		$('input.upload').css('display','none');
		$('input.btn-confirm').css('display','block');
		$('span.uploaded-file').html(data['filename']);
		$('input.attachment').val(data['filedir']);
		$('a.delete-file-action').attr('href',fileLink);
		$('div.attachment').css('display','block');
		$('a.delete-file-action').css('display','inline');
		$('input#upload-btn').attr('value','<?=$re_upload_file?>');
	}
	// after upload action to call the following function
	function CallbackFunction(data){
		if (data) {
			$('div.progress').css('display','block');
			setTimeout(function(){progress()},100);
			setTimeout(function(){showResult(data)},600);
		}else{
			alert('Failed');
		}
	}
	// select file again and remove the result and progress box
	function selectAgain(){
		$('div.progress').css('display','none');
		$('div.upload-result').css('display','none');
		$('div.upload-result').html();
		$('div.progress-bar').css('width',"0%");
		$('input.upload').css('display','block');
		$('input.btn-confirm').css('display','none');
	}
	// if click the select file button run the follow code 
	$('input.select-file').click(function(){selectAgain()});
	// if click the confirm btn run this code
	$('input.btn-confirm').click(function(){hideDialog()});
	// delete the file node method
	function deleteFile(){
		$('a.delete-file-action').css('display','none');
		$('span.uploaded-file').html("");
		$('div.attachment').css('display','none');
		$('input.attachment').val("");
	}
	// if click the delete-a-link then run deleteFile method
	$('a.delete-file-action').click(function(){deleteFile(); return false;});
	// declare the general method of ajax request
	function remoteProcess(type,url,data,success,fail){
		$.ajax({
			type:type,
			url:url,
			data:data,
			success:function(msg){
				success(msg);
			},
			error:function(msg){
				fail(msg);
			}
		})
	}
	$('button.submit').click(function(){
		//alert(data);
		editor.sync();
		var data = $('form.post').serialize();
		type = "post";
		url = '<?=base_url()."index.php/user/submit_post"?>';
		success = function(msg){alert(msg+"success")};
		fail = function(msg){alert(msg+"fail")};
		remoteProcess(type,url,data,success,fail);
		return false;
	})
</script>
<pre>
	



</pre>