<div class="container upload-window">

	<!--  -->
	<div class="shortcut">
		<a href="<?=base_url('index.php/user?manage=vshare&act=go_back')?>" class="btn btn-info"><?php echo $go_back?></a>
	</div>
	<hr/>
	<!-- warning -->
	<div class="container warning">
		<font style="color:red"><?php echo $upload_warning?></font>
	</div>
	<!-- upload-tips -->
	<div class="container upload-tips">
		<font style="color:green"><?php echo $vs_upload_tips ?></font>
	</div>
	<!--  -->
	<hr>
	<!--  -->
	<div class="container upload-box">
		<!-- upload window -->
		<div class="dialog-cover"></div>
		<div class="upload-dialog">
			<div class="dialog-head"> <span class="glyphicon glyphicon-remove"></span> </div>

			<form action="<?=base_url().'index.php/user/upload_torrent'?>" target="hidden_frame" method="post" enctype="multipart/form-data">
				<input type="file" class="select-file" name="attachment" value="<?=$select_file?>"/>
				<div class="progress progress-striped active">
				   <div class="progress-bar  progress-bar-info" role="progressbar" style="width: 0%;">
				      <span class="sr-only">40%</span>
				   </div>
				</div>
				<input type="submit" class="upload btn btn-primary" value="<?=$upload_file?>" />
				<span class="upload-result"></span>
			</form>
			<iframe name="hidden_frame" style="display:none;"></iframe>
		</div>
		<!-- final attachment -->
		<!--<input name="attachment" type="text" class="attachment" />-->
		<div class="attachment">
			<span class="glyphicon glyphicon-tag"></span>
			<span class="uploaded-file"></span>
			<a href="" class="delete-file-action"><?=$delete?></a>
		</div>
		<!--  -->
		<span class="delete-status"></span>
	</div>
	<!--  -->
	<hr>
	<!--  -->
	<div class="container submit">
		<form action="<?php echo base_url("index.php/user?manage=vshare")?>" method="post" class="submit">
			<input name="title" type="text" class="title"/>
			<div class="msg"></div>
			<!-- <div class="add-brief-box"><a href="" class="add-brief-btn"><?php echo $add_brief_intro?></a></div> 
			<textarea name="content" class="content"></textarea> -->
			<label for=""><?php echo $select_category?></label>
			<input name="filepath" type="text" class="attachment" />
			<input name="file_size" type="text" class="filesize" />
			<input name="file_count" type="text" class="filecount" />
			<select name="category" id="category" class="form-control"></select>
			<input name="quality" type="text" class="quality"/>
			<input type="submit" class="btn btn-primary submit-btn" value="<?php echo $confirm?>">
			<!-- <input type="text" name="table" value="torrent_info"> -->
		</form>
	</div>
</div>

<script type="text/javascript">
	$('input.submit-btn').attr('disabled',true);
	$('button.submit').click(function(){
		var data = $('form.post').serialize();
		type = "post";
		url = '<?=base_url()."index.php/user/submit_post"?>';
		success = function(msg){alert(msg+"success")};
		fail = function(msg){alert(msg+"fail")};
		remoteProcess(type,url,data,success,fail);
		return false;
	})	
	function initialize(data){
		var father = "";
		$.each(data,function(oneKey,oneVal){
			father += '<option value="'+oneKey+'">'+oneVal+'</option>';
		})
		$('select#category').append(father);
	}
	var cateData = '{"movie":"<?php echo $movie?>","tv":"<?php echo $tv?>","music":"<?php echo $music?>","book":"<?php echo $book?>","video":"<?php echo $video?>"}';
	var temp = $.parseJSON(cateData);
	initialize(temp);
	//
	function echoArr(arr){
		var result = '';
		for(var i in arr){
			var type = typeof(arr[i]);
			if(type=='object'){
				$.each(arr[i],function(oneKey,oneVal){
					result += (i+': '+oneKey+': '+oneVal+'<br>');
				})
			}else{
				result += (i+': '+arr[i]+'<br>');
			}
		}
		return result;
	}
	// declare the methods for the progress of file uploading bar
	function progress(){
		for (var i = 1; i <= 100; i++) {
			$('div.progress-bar').css('width',i+"%");
		}
	}
	function showResult(data){
		$('div.progress').removeClass('progress-striped'); // remove class striped
		$('span.upload-result').html('<?=$upload_success?>!').show(); // tell user upload successed
		$('input.upload').attr('value','<?=$re_upload_file?>'); // after first upload the btn value will be re-upload
		$('span.uploaded-file').html(data['name']); // show the name of uploaded file
		// insert file info into submit form
		$('input.title').val(data['name']); // set the value of post's title
		$('input.quality').val(data['quality']); // set the value of post's quality
		$('input.filesize').val(data['file_size']); // set the filesize of torrent file
		$('input.filecount').val(data['file_count']); // set the filesize of torrent file
		$('input.attachment').val(data['filepath']); // set the value of post's attachment
		// show the delete action
		$('a.delete-file-action').attr('href',data['delete_link']); // set the a link href
		$('div.attachment').css('display','inline-block'); // show the attachment box
		$('a.delete-file-action').css('display','inline'); // show the a link delete
		$('div.submit').css('display','block'); // show the submit div box, like brief intro and submit btn
		$('div.progress').hide('slow'); // hide the progress bar
		setTimeout(function(){hideObj($('span.upload-result'))},1000);
		$('input.upload').css('display','none');
		$('input.submit-btn').removeAttr('disabled');
		//$('div.msg').html(echoArr(data)); // *** just for test of file information
		//alert(data['filepath']); // *** just for test
	}
	// after upload action to call the following function
	function CallbackFunction(data){
		if (data) {
			$('div.progress').css('display','block');
			setTimeout(function(){progress()},100);
			setTimeout(function(){showResult(data)},600);
		}else{
			alert(data+'led');
		}
	}
	// if file exists, run this method
	function FileError(data){
		//
		$('input.upload').attr('disabled',true);
		$('input.submit-btn').attr('disabled',true);
		alert(data);
	}
	// select file again and remove the result and progress box
	function selectAgain(){
		$('input.upload').removeAttr('disabled');
		$('div.progress').css('display','none');
		$('div.progress-bar').css('width',"0%");
		$('span.upload-result').html('');
		$('input.upload').css('display','inline-block');
		$('div.progress').addClass('progress-striped');

	}
	// if click the select file button run the follow code
	$('input.select-file').click(function(){selectAgain()});
	// delete the file node method
	function deleteFile(){
		$('a.delete-file-action').css('display','none');
		$('span.uploaded-file').html("");
		$('div.attachment').css('display','none');
		$('input.attachment').val(""); // empty the value of post's attachment
		$('input.title').val(''); // empty the value of post's title
		var dir = $('a.delete-file-action').attr('href');
		var data = 'file_dir='+dir;
		type = "post";
		url = '<?php echo site_url("user/delete_temp_torrent?"); ?>';
		//alert(data);
		//return false;
		success = function(msg){
			if(msg=='true'){
				$('input.select-file').val('');
				$('span.delete-status').html('');
				$('span.delete-status').css('display','inline-block');
				$('span.delete-status').html("<span><?php echo $delete_success?></span>");
				setTimeout(function(){hideObj($('span.delete-status'))},1000);
				$('input.upload').show();
				$('input.submit-btn').attr('disabled',true);
			}else{
				alert(msg+'Failed');
			}
		};
		fail = function(msg){
			alert(msg+"fail");
		};
		remoteProcess(type,url,data,success,fail);
		return false;
	}
	// if click the delete-a-link then run deleteFile method
	$('a.delete-file-action').click(function(){deleteFile(); return false;});
	//
	// global variables
	var attachment = $('input.attachment').val();
	// submit the torrent file
	$('input.submit-btn').click(function(){
		$('input.submit-btn').attr('disabled',true);
		var attach = $('input.attachment').val();
		// check whether uploaded file or not
		if(attachment == attach){
			alert('<?php echo $select_file;?>');
			return false;
		}
		var tempObj = $("form.submit");
		var temp = tempObj.serialize();
		//alert(temp);
		//return false;
		var url = '<?php echo base_url("index.php/user/submit_post/")?>';
		var type = 'post';
		var data = temp;
		var success = function(msg){
			alert("<?php echo $upload_success;?>");
			location.href='<?php echo base_url("index.php/user?manage=vshare")?>';
		};
		var fail = function(msg){
			alert(msg+"---Failed");
		};
		remoteProcess(type,url,data,success,fail);
		return false;
	})
</script>
