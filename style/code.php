<?php
	function create_captcha($width=60,$height=32) { 
	    session_start();
	    //生成验证码图片
	    Header("Content-type: image/PNG");
	    $im = imagecreate($width,$height); // width and height of image
	    $back = ImageColorAllocate($im, 245,245,245); // specify background color
	    imagefill($im,0,0,$back); // fill the background color into image
	    $vcodes = "";
	    srand((double)microtime()*1000000);
	    //生成4位数字
	    for($i=0;$i<4;$i++){
		    $font = ImageColorAllocate($im, rand(100,255),rand(0,100),rand(100,255)); // 生成随机颜色
		    $authnum=rand(1,9);
		    $vcodes.=$authnum;
		    imagestring($im, 5, 2+$i*10, 1, $authnum, $font);
	    }
	    
	    for($i=0;$i<100;$i++) { // interuppting
			$randcolor = ImageColorallocate($im,rand(0,255),rand(0,255),rand(0,255));
			imagesetpixel($im, rand()%70 , rand()%30 , $randcolor); // 画像素点函数
	    }
	    ImagePNG($im);
	    ImageDestroy($im);
	    $_SESSION['captcha'] = $vcodes;
	}
	create_captcha();

?>
