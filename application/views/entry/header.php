<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<title><?=$title?></title>
	<link rel="stylesheet" href="<?php echo $style_folder.'/bootstrap/css/bootstrap.min.css';?>" />
	<link rel="stylesheet" href="<?php echo $style_folder.'css/index.css';?>" />
	<link rel="stylesheet" href="<?php echo $style_folder.'css/'.(isset($css)? $css: 'index' ).'.css';?>" />
	<script src="<?php echo $style_folder.'bootstrap/js/jquery.min.js';?>"></script>
	<script src="<?php echo $style_folder.'js/ninger.js';?>"></script>
	<script src="<?php echo $style_folder.'bootstrap/js/bootstrap.min.js';?>"></script>
</head>
<body>
<div id="Layer1" style="position:absolute; width:100%; height:100%; z-index:-1">  
	<!-- <img src="http://b.zol-img.com.cn/desk/bizhi/image/5/1366x768/1417743927755.jpg" height="100%" width="100%"/>   -->
</div>
<!-- body of div -->
<div class="container body">

	<div class="head-bar container navbar-fixed-top" role="navigation">
		<ul class="nav nav-pills">
			<li><a href="<?=base_url().'index.php/index'?>"><?=$home?></a></li>
			<li><a href="<?=base_url().'index.php/movie'?>"><?=$movie?></a></li>
			<li><a href="<?=base_url().'index.php/tv'?>"><?=$tv?></a></li>
		</ul>
		<div class="container login">
			<?php
				if(isset($session['online'])){
					if($session['online']==1){
						echo '<a href="'.base_url().'index.php/user"><span class="glyphicon glyphicon-user">'.$session['email'].'</span></a>';
						echo '&nbsp;<span><a href="'.base_url().'index.php/index/logout">'.$logout.'</a></span>';
					}
				}else{
					echo '<a href="'.base_url().'index.php/entry/login">'.$login.'</a> ';
					echo '<a href="'.base_url().'index.php/entry/signup">'.$signup.'</a>';
				}
			?>
		</div>
	</div>
<br />
	<div class="container">
		<h1><?=$site_name?></h1>
	</div>






