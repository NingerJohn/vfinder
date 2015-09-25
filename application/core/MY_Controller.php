<?php
/**
* 
*/
class MY_Controller extends CI_Controller
{
	public $view_folder;
	public $sess_data;
	function __construct()
	{
		parent::__construct();
		$this->sess_data = $this->session->all_userdata();
		$sess= $this->sess_data;
		if(!isset($sess['online'])){
			//echo "register";
			//redirect(base_url("index.php/entry/index/login"));
		}
		// echo  'Previous URL is  "'.$_SERVER['HTTP_REFERER'].'"';
		//print_r($sess);
	}
	//
	function verify(){
		$sess= $this->sess_data;
		if(!isset($sess['online'])){
			echo "register";
		}else if($sess['mail_verify']=='0'){
			echo "Mail";
			return false;
		}		
	}
	// load language file
	function load_language(){
		$session = $this->session->all_userdata();
		// set the language
		if(isset($session['language'])){
			//
			if (empty($session['language'])) {
				$this->lang->load('front','chinese');
				return $data = $this->lang->line('language');
			}else{
				$this->lang->load('front',$session['language']);
				return $data = $this->lang->line('language');
			}
		}else{
			//
			$this->lang->load('front','chinese');
			return $data = $this->lang->line('language');
		}
	}
	//
	function set_language(){
		$lang = $this->input->post('lang');
		$this->session->set_userdata(array('language'=>$lang));
		echo 'true';
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
	// # pagination method # a general pagination method for the whole site
	function paging($num,$url,$total){
		$config['per_page'] = $num;
		$config['base_url'] = base_url().$url;
		$config['total_rows'] = $total;
		$config['page_query_string'] = TRUE;
		$config['query_string_segment'] = 'page';
		$config['cur_tag_open'] = '<li class="active"><a href="#">';
		$config['cur_tag_close'] = '</a></li>';
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['prev_tag_open'] = '<li>';
		$config['prev_link'] = '上一页';
		$config['prev_tag_close'] = '</li>';
		$config['next_tag_open'] = '<li>';
		$config['next_link'] = '下一页';
		$config['next_tag_close'] = '</li>';
		$config['first_link'] = '首页';
		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';
		$config['last_link'] = '末页';
		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '</li>';
		$config['full_tag_open'] = '<ul class="pagination pagination-sm">';
		$config['full_tag_close'] = '</ul>';
		$this->pagination->initialize($config);
		return $this->pagination->create_links();
	}
	// # login_check method # get the data of session and return online status 0 or 1
	function login_check(){
		//
		$session = $this->sess_data;
		if( isset($session['online']) and (!empty($session['online'])) ){
			return 'true';
		}else{
			return 'false';
		}
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
	//
	//
}














