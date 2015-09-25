<div class="container login-box">
		<div class="container login-form">
		<div class="msg"><font color="red"><?php if(isset($result)) echo $result;?></font></div>
		<form action="<?=base_url('index.php/entry/password_check')?>" name="" method="POST">
			<h2><?php echo $title ?></h2>
			<p><input type="email" name="email" class="email form-control" placeholder="email" /></p>
			<p><input type="password" name="password" class="pwd form-control" placeholder="password" /></p>
			<input type="submit" name="submit" class="loginbtn btn btn-primary" value="Login" />
		</form>
	</div>
</div>
<pre>
	



</pre>
<script type="text/javascript">
	$('input.email').focus();
$(function(){
	$('input.loginbtn').click(function(){
		var email = $('input.email').val();
		var password = $('input.pwd').val();
		if( ( email == "") || ( password == "") ){
			$('div.msg').html('<font color="red">'+'Email or Password can not be empty'+"</font>");
			return false;
		}
	});
});
</script>