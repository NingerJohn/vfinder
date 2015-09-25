<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<title><?=$website_title?></title>
	<meta name="keywords" content="美剧,电影,视频教程,英剧,字幕,无字幕" />
	<meta name="description" content="无字幕美剧英剧电影分享下载" />
	<link rel="stylesheet" href="<?php echo $style_folder.'/bootstrap/css/bootstrap.min.css';?>" />
	<link rel="stylesheet" href="<?php echo $style_folder.'css/index.css';?>" />
	<link rel="stylesheet" href="<?php echo $style_folder.'css/'.(isset($css)? $css: 'index' ).'.css';?>" />
	<script src="<?php echo $style_folder.'bootstrap/js/jquery.min.js';?>"></script>
	<script src="<?php echo $style_folder.'js/ninger.js';?>"></script>
	<script src="<?php echo $style_folder.'bootstrap/js/bootstrap.min.js';?>"></script>
</head>
<body>
<div id="Layer1">  
	<img src="<?php echo base_url('style/img/bg_breaking_bad.jpg') ?>" /> 
</div>
	<!-- 
	 -->
	<div class="head-bar container navbar-fixed-top" role="navigation">
		<ul class="nav nav-pills">
			<li><a href="<?=site_url().'/index'?>"><?=$home?></a></li>
			<li><a href="<?=site_url().'/tv'?>"><?=$tv?></a></li>
			<li><a href="<?=site_url().'/subtitle'?>"><?=$subtitle?></a></li>
			<li><a href="<?=site_url().'/movie'?>"><?=$movie?></a></li>
			<li><a href="<?=site_url().'/book'?>"><?=$book?></a></li>
			<li><a href="<?=site_url().'/video'?>"><?=$video?></a></li>
		</ul>
		<div class="container login">
			<?php
				if(isset($session['online'])){
					if($session['online']==1){
						echo '<a href="'.site_url().'/user"><span class="glyphicon glyphicon-user">'.$session['email'].'</span></a>';
						echo '&nbsp;<span><a href="'.site_url().'/entry/logout">'.$logout.'</a></span>';
						echo '&nbsp;&nbsp;&nbsp;<a href="" data-lang="chinese" class="lang">'.$chinese.'</a>&nbsp;';
						echo '<a href="" data-lang="english" class="lang">'.$english.'</a>&nbsp;&nbsp;';
					}
				}else{
					echo '<a href="'.site_url().'/entry/login">'.$login.'</a> ';
					echo '<a href="'.site_url().'/entry/signup">'.$signup.'</a>';
					echo '&nbsp;&nbsp;&nbsp;<a href="" data-lang="chinese" class="lang">'.$chinese.'</a>&nbsp;';
					echo '<a href="" data-lang="english" class="lang">'.$english.'</a>&nbsp;&nbsp;';
				}
			?>
		</div>
	</div>
	<!--  -->
	<div class="container leftbox">
		<!-- Ninger -->
	</div>
	<div class="container" id="body">
	<!--  -->
		<div class="container site-name">
			<h1><?=$site_name?></h1>
		</div>
<?php //print_r($session) ?>





<script type="text/javascript">
//
$('a.lang').click(function(){
	//
	var type = "POST";
	var url = "<?php echo site_url('index/set_language'); ?>";
	var data = 'lang='+$(this).data('lang');
	var success = function(msg){
		//
		if( msg ){
			alert("<?php echo $lang_change_success; ?>");
			window.location.reload();
		}
	}
	var fail = function(msg){
		//
		alert(msg);
	}
	remoteProcess(type, url, data, success, fail);
	return false;
})

</script>