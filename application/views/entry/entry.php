<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<title><?php echo $title; ?></title>
	<link rel="stylesheet" href="<?php echo $style_folder.'/bootstrap/css/bootstrap.min.css';?>" />
	<link rel="stylesheet" href="<?php echo $style_folder.'css/index.css';?>" />
	<link rel="stylesheet" href="<?php echo $style_folder.'css/'.(isset($css)? $css: 'index' ).'.css';?>" />
	<script src="<?php echo $style_folder.'bootstrap/js/jquery.min.js';?>"></script>
	<script src="<?php echo $style_folder.'js/ninger.js';?>"></script>
	<script src="<?php echo $style_folder.'bootstrap/js/bootstrap.min.js';?>"></script>
</head>
<body>
		<a href="<?php echo $link;?>"><?php echo $signup; ?></a>
		<a href="<?php echo $link;?>"><?php echo $login; ?></a>
</body>
</html>