<div class="container menu">
	<ul class="nav nav-tabs nav-block">
		<li class="active"><a href="<?=base_url('index.php/user?manage=user_info')?>"><?=$userinfo?></a></li>
		<li><a href="<?=base_url('index.php/user?manage=vshare')?>"><?=$vshare?></a></li>
		<li><a href="<?=base_url('index.php/user?manage=subtitle')?>"><?=$subtitle?></a></li>

		<!-- 
			<li><a href="<?=base_url('index.php/user?manage=post')?>">Post</a></li>
			<li class="active"><a href="<?=base_url('index.php/user?manage=general_info')?>">general_info</a></li>
		 -->
	</ul>
</div>
<!-- <pre>
	
<?php 
//print_r($p_info); 
//print_r($session);
?>
	
</pre> -->
<?php //print_r($user_info); ?>
<div class="container info">

	<ul class="nav nav-pills nav-stacked">
		<li class="active"><a href="<?=base_url('index.php/user?manage=user_info&act=personal_info')?>"><?=$personal_info?></a></li>
		<!-- <li class="active"><a href="<?=base_url('index.php/user?manage=user_info&act=avatar')?>"><?=$avatar?></a></li> -->
		<li><a href="<?=base_url('index.php/user?manage=user_info&act=interest')?>"><?=$interest?></a></li>		
	</ul>
	<div class="personal-info">
	<form name="personal-info" action="" method="post" class="personal-info">
		<table class="table table-bordered table-striped table-hover personal-info">
			<tbody>
				<tr>
					<td><?php echo $user_name;?></td>
					<td><?php echo $user_info['username']; ?></td>
					<td>&nbsp;</td>
				</tr>
				<tr>
					<td><?php echo $email;?></td>
					<td><input disabled="true" class="email" type="text" value="<?php echo $user_info['email']; ?>"><?php if($user_info['mail_verify']==0)echo $mail_unverified; ?></td>
					<td>
						<button class="change-email"  style="display:none"><?php echo $change;?></button>
						<button class="update-email" style="display:none"><?php echo $update;?></button>
					</td>
				</tr>
				<tr>
					<td><?php echo $real_name;?></td>
					<td><input type="text" name="real_name" value="<?php echo $p_info['real_name']; ?>" /></td>
					<td>
						<select name="real_name_p" class="status">
							<option value="1" <?php if($p_info['real_name_p']=='1'){ echo 'selected';}?> ><?php echo $public;?></option>
							<option value="0" <?php if($p_info['real_name_p']=='0'){ echo 'selected';}?> ><?php echo $private;?></option>
						</select>
					</td>
				</tr>
				<tr>
					<td><?php echo $gender;?></td>
					<td>
						<select name="gender" class="gender">
							<option value="1" <?php if($p_info['gender']=='1'){ echo 'selected';}?> ><?php echo $male;?></option>
							<option value="2" <?php if($p_info['gender']=='2'){ echo 'selected';}?> ><?php echo $female;?></option>
						</select>
					</td>
					<td>
						<select name="gender_p" class="status">
							<option value="1" <?php if($p_info['gender_p']=='1'){ echo 'selected';}?> ><?php echo $public;?></option>
							<option value="0" <?php if($p_info['gender_p']=='0'){ echo 'selected';}?> ><?php echo $private;?></option>
						</select>
					</td>
				</tr>
				<tr>
					<td><?php echo $age;?></td>
					<td><input type="text" name="birthday" value="<?php echo $p_info['birthday']; ?>" /></td>
					<td>
						<select name="birthday_p" class="status">
							<option value="1" <?php if($p_info['birthday_p']=='1'){ echo 'selected';}?> ><?php echo $public;?></option>
							<option value="0" <?php if($p_info['birthday_p']=='0'){ echo 'selected';}?> ><?php echo $private;?></option>
						</select>
					</td>
				</tr>
				<tr>
					<td><?php echo $homeland;?></td>
					<td><input type="text" name="homeland" value="<?php echo $p_info['homeland']; ?>" /></td>
					<td>
						<select name="homeland_p" class="status">
							<option value="1" <?php if($p_info['homeland_p']=='1'){ echo 'selected';}?> ><?php echo $public;?></option>
							<option value="0" <?php if($p_info['homeland_p']=='0'){ echo 'selected';}?> ><?php echo $private;?></option>
						</select>
					</td>
				</tr>
				<tr>
					<td><?php echo $live_place;?></td>
					<td><input type="text" name="live_place" value="<?php echo $p_info['live_place']; ?>" /></td>
					<td>
						<select name="live_place_p" class="status">
							<option value="1" <?php if($p_info['live_place_p']=='1'){ echo 'selected';}?> ><?php echo $public;?></option>
							<option value="0" <?php if($p_info['live_place_p']=='0'){ echo 'selected';}?> ><?php echo $private;?></option>
						</select>
					</td>
				</tr>
				<tr>
					<td><?php echo $major;?></td>
					<td><input type="text" name="major" value="<?php echo $p_info['major']; ?>" /></td>
					<td>
						<select name="major_p" class="status">
							<option value="1" <?php if($p_info['major_p']=='1'){ echo 'selected';}?> ><?php echo $public;?></option>
							<option value="0" <?php if($p_info['major_p']=='0'){ echo 'selected';}?> ><?php echo $private;?></option>
						</select>
					</td>
				</tr>
				<tr>
					<td><?php echo $job;?></td>
					<td><input type="text" name="job" value="<?php echo $p_info['job']; ?>" /></td>
					<td>
						<select name="job_p" class="status">
							<option value="1" <?php if($p_info['job_p']=='1'){ echo 'selected';}?> ><?php echo $public;?></option>
							<option value="0" <?php if($p_info['job_p']=='0'){ echo 'selected';}?> ><?php echo $private;?></option>
						</select>
					</td>
				</tr>
				<tr>
					<td colspan="3"><input class="update-all" type="submit" value="<?php echo $submit;?>"></td>
				</tr>
			</tbody>
		</table>
	</form>
	<!-- <pre><div class="msg"></div></pre> -->
	</div>
</div>
<script type="text/javascript">
	var formVal = $('form').serialize();
	//$('div.msg').html(formVal);
	// $('body').on('click','button.update-email',function(){
	// 	alert('sfsa');
	// 	console.log(11231);
	// 	return false;
	// });
$(document).ready(function(){
	var orginalData = $('form').serialize();
	var orginalEmail = $('input.email').val();
	// click change the email btn
	$('button.change-email').click(function(){
		//alert($(this).attr('class'));
		//$('input.email').removeAttr('disabled');
		$(this).css('display','none');
		//$('button.update-email').css('display','block');
		return false;
	})
	// change email
	$('button.update-email').click(function(){
		var email = $('input.email').val();
		if((email==orginalEmail)){
			alert('<?php echo $same_email;?>');
			return false;
		}else{
			alert("okay");
			alert($("form.personal-info").serialize());
			return false;
		}
	})
	// submit personal information into DB
	$('input.update-all').click(function(){
		var value = $('form').serialize();
		if((value==orginalData)){
			alert('<?php echo $same_person_info;?>');
			alert(value);
			return false;
		}else{
			//alert("okay");
			var data = $("form.personal-info").serialize();
			var url = '<?php echo base_url("index.php/user/update_info")?>';
			var type = "POST";
			var success = function(msg){alert('<?php echo $update_success;?>')};
			var fail = function(msg){alert(msg+'Failed')};
			//alert(data);
			//return false;
			remoteProcess(type,url,data,success,fail);
			setTimeout(function(){pageRefresh()},1000);
			return false;
		}
	})
})

</script>
