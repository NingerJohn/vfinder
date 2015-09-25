<hr>
<div class="container login-box">
		<div class="container login-form">
		<form action="<?=base_url('index.php/entry/password_check')?>" class="form-box" method="POST">
		<div class="login-error"><font color="red"><?php if(isset($result)) echo $result;?></font></div>
			<h3><?php echo $login ?></h3>
			<p><input type="email" name="email" class="email form-control" placeholder="email" /></p>
			<p><input type="password" name="password" class="pwd form-control" placeholder="password" /></p>
			<p>
				<input type="submit" name="submit" class="loginbtn btn btn-primary" value="<?php echo $login; ?>" />
				&nbsp;<a href="<?php echo base_url('index.php/entry/find_pwd') ?>"><?php echo $forgot_password?></a>
				&nbsp;<a href="<?php echo base_url('index.php/entry/signup') ?>"><?php echo $signup?></a>
			</p>
		</form>
	</div>
</div>
<hr>
<script type="text/javascript">
$(function(){
	$('input.email').focus();
	$('input.loginbtn').click(function(){
		var one = email();
		//alert(one);
		if(one){
			return true;
		}else{
			return false;
		}
	});
		//
	function email(){
		var obj = $('input.email');
		var temp = obj.val();
		if(temp==''){
			showMsg(obj,'span','<?php echo $please_input_email; ?>','fail');
			return false;
		}
		var type = 'post';
		var data = 'email='+temp;
		//
		var url = '<?php echo base_url("index.php/entry/email_check") ?>';
		var success = function(data){
			if(data){
				showMsg(obj,'span','√','success');
				return temp = 'true';
			}else{
				showMsg(obj,'span','<?php echo $email_unregistered?>','fail');
				return temp = 'false';
			}
		};
		var status = remoteProcess(type,url,data,success,fail);
		//alert(typeof(status));
		if( status ==='true' ){
			//return true;
			// 
			var url = '<?php echo base_url("index.php/entry/email_verify_check") ?>';
			var success = function(data){
				if(data){
					showMsg(obj,'span','√','success');
					return true;
				}else{
					showMsg(obj,'span','<?php echo $email_unverify?>','fail');
					return false;
				}
			};
			var fail = function(data){alert(data)};
			var status = remoteProcess(type,url,data,success,fail);
			//alert(status);
			if( status === true ){
				return true;
			}else{
				return false;
			}
		}else{
			//alert('false');
			return false;
		}

	}
	// email check
	$('input.email').blur(function(){
		email();
	});
});
</script>