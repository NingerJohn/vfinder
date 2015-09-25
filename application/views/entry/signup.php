<hr>
<div class="container signup-box">
	<div class="container signup-form">
		<div class="msg"><font color="red"><?php if(isset($result)) echo $result;?></font></div>
		<form class="signup-box" method="POST">
			<h3><?php echo $signup?></h3>
			<p>
				<input type="text" name="username" class="username form-control" placeholder="<?php echo $username?>" />
			</p>
			<p>
				<input type="email" name="email" class="email form-control" placeholder="<?php echo $email?>" />
			</p>
			<p>
				<input type="password" name="password" class="password form-control" placeholder="<?php echo $password?>" />
			</p>
			<p>
				<input type="password" class="con-pwd form-control" placeholder="<?php echo $confirm_password?>" />
			</p>
			<p>
				<img src="<?php echo site_url('entry/output_captcha'); ?>">
				<input type="text" class="captcha form-control">
			</p>
				<input type="submit" name="submit" class="btn btn-primary signup-btn" value="<?php echo $signup; ?>" />
		</form>
	</div>
</div>

<hr>
<script type="text/javascript">
$(function(){
	$('input.username').focus();
	submitBtn = $('input.signup-btn');
	$('input.loginbtn').click(function(){
		var email = $('input.email').val();
		var password = $('input.pwd').val();
		if( ( email == "") || ( password == "") ){
			$('div.msg').html('<font color="red">'+'Email or Password can not be empty'+"</font>");
			return status = false;
		}
	});
	//
	//
	$('input.signup-btn').click(function(){
		//
		// remote process
		var name = username();
		var mail = email();
		var pwd = password();
		var con = confirmPwd();
		var cap = captcha();
		if( name && mail && pwd && con && cap ){
			var one = $('form.signup-box').serialize();
			alert('success');
			alert(one);
			var type = 'POST';
			var url = '<?php echo base_url("index.php/entry/signup_submit")?>';
			var data = one;
			var success = function(data){
				if(data=='same'){
					alert('<?php echo $already_registered ?>');
					//alert('<?php echo $register_success ?>');
					return false;
				}else if(data=='false'){
					alert('<?php echo $register_fail_retry ?>');
					console.log(data);
					return false;
				}else{
					alert('<?php echo $register_success ?>');
					window.location.href = '<?php echo base_url("index.php/entry/login"); ?>';
				}
			};
			var fail = function(data){
				console.log(data);
				return false;
			};
			remoteProcess(type,url,data,success,fail);
			return false;
		}else{
			alert($('form.signup-box').serialize());
			alert('fail '+name+'  '+mail+'  '+pwd+'  '+con+'  '+cap);
			return false;
		}
	});
	//
	function username(){
		var obj = $('input.username');
		var temp = obj.val();
		if(temp==''){
			showMsg(obj,'span','<?php echo $please_input_username; ?>','fail');
			return false;
		}
		var type='post';
		var url = '<?php echo base_url("index.php/entry/username_check") ?>';
		var data = 'username='+temp;
		var success = function(data){
			if(data){
				showMsg(obj,'span','<?php echo $username_used?>','fail');
				return false;
			}else{
				showMsg(obj,'span','√','success');
				return true;
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
	//
	$('input.username').blur(function(){
		username();
	});
	//
	function email(){
		var obj = $('input.email');
		var temp = obj.val();
		if(temp==''){
			showMsg(obj,'span','<?php echo $please_input_email; ?>','fail');
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
					showMsg(obj,'span','<?php echo $email_used?>','fail');
					return false;
				}else{
					showMsg(obj,'span','√','success');
					return true;
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
	//
	function password(){
		var obj = $('input.password');
		obj.next().remove();
		var temp = obj.val();
		var empty = '<?php echo $please_input_password; ?>';
		var short = '<?php echo $short_password; ?>';
		var format = '<?php echo $different_password; ?>';
		var status = pwdCheck(obj,empty,short);
		if(status){
			return true;
		}else{
			return false;
		}
	}
	//
	$('input.password').blur(function(){
		//
		password();
	})
	//
	function confirmPwd(){
		var obj = $('input.con-pwd');
		var preval = $('input.password').val();
		obj.next().remove();
		var temp = obj.val();
		var empty = '<?php echo $please_input_password; ?>';
		var short = '<?php echo $short_password; ?>';
		var different = '<?php echo $different_password; ?>';
		var status = conpwd(obj,empty,short,preval,different);
		if(status){
			return true;
		}else{
			return false;
		}
	}
	$('input.con-pwd').blur(function(){
		//
		confirmPwd();
	})	
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
});
</script>