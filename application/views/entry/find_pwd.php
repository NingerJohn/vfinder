<hr>

<div class="container findpwd-box">
	<form role="form" class="findpwd-box">
		<p>
			<?php echo $email; ?>:&nbsp;&nbsp;&nbsp;<input class="form-control email" type="text" placeholder="<?php echo $please_input_email; ?>">
		</p>
		<p>
			<?php echo $captcha; ?>：
			<img src="<?php echo base_url('style/code.php'); ?>">
			<input type="text" value="" class="form-control captcha">
		</p>
		<p>
			<input type="submit" value="<?php echo $confirm; ?>" class="btn btn-primary submit-btn" >
		</p>
	</form>
</div>

<hr>

<script type="text/javascript">
	// submit
	$('input.email').focus();
	$('input.submit-btn').click(function(){
		//
		var one = email();
		var two = captcha();
		if( one ){
			//alert('success');
			//alert('<?php echo $reset_link_sent ?>');
			if( two ){
				var type = "post";
				var url = "<?php echo base_url('index.php/entry/find_submit') ?>";
				var data = $('input.email').val();
				var success = function(data){
					//
					alert("success");
					if(data == 'true'){
						return true;
					}else{
						return false;
					}
				}
				var status = remoteProcess(type,url,data,success,null);
				if( status ){
					alert('<?php echo $reset_link_sent ?>');
				}else{
					alert('<?php echo $server_error ?>');
				}
			}else{
				$('input.captcha').focus();
				alert(two);
				return false;
			}
		}else{
			$('input.email').focus();
			alert('fail');
			alert(one);
		}
		return false;
	});
	// email check
	function email(){
		var obj = $('input.email');
		var temp = obj.val();
		if(temp==''){
			showMsg(obj,'span','<?php echo $please_input_email; ?>','fail');
			//$('input.email').focus();
			return false;
		}
		var format = '<?php echo $wrong_format; ?>';
		var result = emailCheck(obj,format);
		if(result){
			var type='post';
			var url = '<?php echo base_url("index.php/entry/email_check") ?>';
			var data = 'email='+temp;
			var success = function(data){
				if(data){
					showMsg(obj,'span','√','success');
					return true;
				}else{
					showMsg(obj,'span','<?php echo $email_unregistered?>','fail');
					//$('input.email').focus();
					return false;
				}
			};
			var fail = function(data){alert(data)};
			var status = remoteProcess(type,url,data,success,fail);
			if(status===true){
				return true;
			}else{
				return false;
			}
		}
	}
	// email check
	$('input.email').blur(function(){
		email();
	});
	// captcha check
	function captcha(){
		var obj = $('input.captcha');
		var temp = obj.val();
		var type='post';
		var url = '<?php echo base_url("index.php/entry/captcha_check") ?>';
		var data = 'captcha='+temp;
		var success = function(data){
			if(data){
				showMsg(obj,'span','√','success');
				return true;
			}else{
				showMsg(obj,'span','<?php echo $wrong_captcha ?>','fail');
				//$('input.captcha').focus();
				return false;
			}
		};
		var fail = function(data){
			showMsg(obj,data,'red');
			alert(data);
		};
		var status = remoteProcess(type,url,data,success,fail);
		if(status===true){
			return true;
		}else{
			return false;
		}
	}
	// captcha active
	$('input.captcha').blur(function(){
		captcha();
	});	
</script>

