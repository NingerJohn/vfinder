<?php
/**
* 
*/
class MY_Entry extends CI_Controller
{
	public $view_folder;
	public $sess_data;
	function __construct()
	{
		parent::__construct();
		$this->sess_data = $this->session->all_userdata();
		$sess= $this->sess_data;
		// echo  'Previous URL is  "'.$_SERVER['HTTP_REFERER'].'"';
	}
	// load language file
	function load_language(){
		$session = $this->session->all_userdata();
		// set the language
		if(isset($session['language'])){
			$this->lang->load('front',$session['language']);
			return $data = $this->lang->line('language');
		}else{
			$this->lang->load('front','chinese');
			return $data = $this->lang->line('language');
		}
	}
	// load view file thru array format
	function load_views($arr, $data=NULL, $status=false, $view_folder=""){
		//
		$result = '';
		if(is_array($arr)){
			for ($i=0; $i < count($arr); $i++) { 
				if($status){
					if( $i==0 && !$data==null ){
						$result .= $this->load->view($view_folder.$arr[$i], $data, $status);
					}else{
						$result .= $this->load->view($view_folder.$arr[$i], NULL, $status);
					}
				}else{
					if( $i==0 && !$data==null ){
						$this->load->view($view_folder.$arr[$i], $data, $status);
					}else{
						$this->load->view($view_folder.$arr[$i], NULL, $status);
					}
				}
			}
		}else{
			if($status){
				$result = $this->load->view($view_folder.$arr, $data, $status);
			}else{
				$this->load->view($view_folder.$arr, $data, $status);
			}
		}
		return $result;
	}
	// gain user ip address
	function get_user_ip(){
		$client  = @$_SERVER['HTTP_CLIENT_IP'];
		$forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
		$remote  = $_SERVER['REMOTE_ADDR'];
		if(filter_var($client, FILTER_VALIDATE_IP)){
			$ip = $client;
		}elseif(filter_var($forward, FILTER_VALIDATE_IP)){
			$ip = $forward;
		}else{
			$ip = $remote;
		}
		return $ip;
	}
	// captcha code
	public function create_captcha($width=60,$height=32) { 
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
}














