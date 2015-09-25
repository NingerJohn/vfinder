<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<script src="<?php echo $style_folder.'bootstrap/js/jquery.min.js';?>"></script>
	<title>Test</title>
</head>
<body>
	<pre>
	<?php print_r($result); ?>	
		
	</pre>





</body>
<script type="text/javascript">
	b = 0;
	function add(c){
		return (c++);
	}
	function check(){
		a= ++b;
		a= add(a);
		alert(a);
		return false;
	}

</script>

 



<!-- 
<div id="testDiv">放在我上面</div> 

<div class="show">


</div>

<pre>
</pre>
<div class="next">
	
</div>
<script type="text/javascript"> 
$(document).mousemove
(function(e) { 
	var xx = e.originalEvent.x || e.originalEvent.layerX || 0; 
	var yy = e.originalEvent.y || e.originalEvent.layerY || 0; 
	$('div.show').text(xx + '---' + yy); 
	var x = e.pageX;
	var y = e.pageY;
	$('div.next').html('X:'+x+'Y:'+y);
}
/*
function (e){
	var x = e.pageX;
	var y = e.pageY;
	//$('div.next').html('X:'+x+'Y:'+y);
}*/
);
</script> 

<form action="<?=base_url().'index.php/user/upload_file'?>" method="post" enctype="multipart/form-data">
	<input type="file" name="attachment" />
	<input type="submit" onclick="return check()" />
</form>

 -->



</html>