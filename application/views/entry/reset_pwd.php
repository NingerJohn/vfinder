<?php if($result==1){ ?>

<hr>

<form action="#" role="form" class="resetpwd-box" method="post">
	<h3><?php echo $reset_pwd ?></h3>
	<input type="text" name="email" value="<?php echo $this->input->get('email'); ?>" style="display:none">
	<input type="text" name="code" value="<?php echo $this->input->get('code'); ?>" style="display:none">
	<p>&nbsp;&nbsp;&nbsp;<?php echo $new_password ?>: <input type="password" name="password" class="form-control password"></p>
	<p><?php echo $con_password ?>: <input type="password" class="form-control con-pwd"></p>
	<p><input type="submit" name="password" class="submit-btn btn btn-primary" value="<?php echo $confirm ?>"></p>
</form>

<hr>

<script type="text/javascript">
	$('input.submit-btn').click(function(){
		//
		var one = password();
		var two = confirmPwd();
		if( one && two ){
			var data = $('form').serialize();
			alert(data);
			var link = "<?php echo base_url('index.php/entry/login'); ?>";
			var type = "POST";
			var url = "<?php echo base_url('index.php/entry/reset_password') ?>";
			var data = data;
			var success = function (msg){
				if(msg == '1'){
					alert("<?php echo $pwd_change_success ?>"+msg);
					setTimeout(function(){jumpTo(link)},2000);
				}else{
					alert("<?php echo $pwd_change_fail ?>"+msg);
				}
			}
			var fail = function (msg){
				alert("<?php echo $server_error ?>");
			}
			remoteProcess(type,url,data,success,fail);
			return false;			
		}else{
			var data = $('form').serialize();
			alert(data);
			return false;
		}
	})
	// check the first password
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
	// first password input check action
	$('input.password').blur(function(){
		//
		password();
	})
	// confirm password
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
	// confirm password action
	$('input.con-pwd').blur(function(){
		//
		confirmPwd();
	})
</script>



<?php }else{ ?>

<div class="container">
	<?php echo $link_outdate; ?>
</div>


<?php } ?>