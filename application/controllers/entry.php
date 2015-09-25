<?php
/**
* 
*/
class Entry extends MY_Entry
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('front/entry_m');
		$this->style_folder = base_url().'style/';
	}
	//
	function index(){
		$act = $this->input->get('act');
		if($act==false){
			$act = '';
		}
		switch ($act) {
			case 'mail_verify':
				$this->mail_verify();
				break;
			case 'signup':
				$this->signup();
				break;
			case 'find_pwd':
				$this->find_pwd();
				break;
			case 'reset_pwd':
				$this->reset_pwd();
				break;
			default:
				$this->login();
				break;
		}
	}
	// sign up page
	function signup(){
		//
		$this->load->library('captcha_code');
		$data = $this->load_language();
		$data['session'] = $this->sess_data;
		$data['title'] = 'Signup';
		$data['css'] = 'entry';
		$data['style_folder'] = $this->style_folder;
		$view_arr = array('front/head','entry/signup','entry/footer');
		$this->load_views($view_arr,$data);
		$user_ip = $this->get_user_ip();
		//echo $user_ip;
	}
	//
	function login(){
		//
		$sess = $this->sess_data;
		if( isset( $sess['online'] ) ){
			redirect(base_url("index.php/user"));
			//print_r($sess);
		}
		$data = $this->load_language();
		$data['title'] = 'Login';
		$data['css'] = 'entry';
		$data['style_folder'] = $this->style_folder;
		$view_arr = array('front/head','entry/login','entry/footer');
		$this->session->set_userdata(array('prev_link' => @$_SERVER['HTTP_REFERER']));
		$this->load_views($view_arr,$data);
	}
	// check the conbination of email and password
	function password_check(){
		//
		$data = $this->load_language();
		$session = $this->session->all_userdata();
		$password = $this->input->post('password');
		$email = $this->input->post('email');
		$status = $this->entry_m->pwd_check($email,$password);
		if ( $status==1 ) {
			$this->entry_m->online($email,$password);
			redirect(base_url("index.php/user"));
		}else{
			$result = $data['wrong_conbination'];
			$data['result'] =$result;
			$data['title'] = 'Login';
			$data['css'] = 'entry';
			$data['style_folder'] = $this->style_folder;
			$view_arr = array('front/head','entry/login','entry/footer');
			$this->load_views($view_arr,$data);
		}
	}
	// signup page
	function username_check(){
		//
		$username = $this->input->post('username');
		$result = $this->entry_m->username_check($username);
		if($result==1){
			echo true;
		}else{
			echo false;
		}		
	}
	//
	function email_check(){
		//
		$email = $this->input->post('email');
		$result = $this->entry_m->email_check($email);
		if($result==1){
			echo true;
		}else{
			echo false;
		}
	}
	//
	function email_verify_check(){
		//
		$email = $this->input->post('email');
		$result = $this->entry_m->email_verify_check($email);
		if($result['0']['mail_verify']==1){
			echo true;
		}else{
			echo false;
		}
	}
	function captcha_check(){
		//
		session_start();
		$val = $this->input->post('captcha');
		if($_SESSION['captcha']==$val){
			echo true;
		}else{
			echo false;
		}
	}
	// submit email and password into user table and insert a new line into mail_verify table
	function signup_submit(){
		//
		$title = 'signup_mail_title';
		$ip = $this->get_user_ip();
		$table = 'user';
		$username = $this->input->post('username');
		$email = $this->input->post('email');
		$password = $this->input->post('password');
		$rand = md5(rand(1000,9999));
		$pwd = md5($password.$rand);
		$code = md5($email.time());
		$link = base_url("index.php/entry/mail_verify?email=".$email."&code=".$code);
		$data = array('username'=>$username ,'email'=>$email,'password'=>$pwd,'rand'=>$rand,'ip'=>$ip,'code'=>$code);
		$result = $this->entry_m->signup($table,$data);
		if($result==false){
			echo 'same';
			return false;
		}
		$email_template = 'entry/mail/signup';
		$status = $this->send_mail($email, $email_template, $title,$link);
		$status = true;
		if( $status ){
			echo 'true';
		}else{
			echo 'false';
		}
	}
	// mail_verify page
	function mail_verify(){
		//
		$data = $this->load_language();
		$table = 'mail_verify';
		$code = $this->input->get();
		$status = $this->entry_m->exist_check( $table, $code );
		if($status == 1 ){
			//
			$this->entry_m->mail_verify($code);
			$result = '1';
		}else{
			//
			$result = '0';
		}
		$data['title'] = $data['mail_verify'];
		$data['css'] = 'entry';
		$data['email'] = $code['email'];
		$data['result'] = $result;
		$data['style_folder'] = $this->style_folder;
		$view_arr = array('front/head', 'entry/mail_verify', 'entry/footer');
		$this->load_views($view_arr,$data);
		//
	}
	// send email method
	function send_mail($email, $email_template, $title, $link){
		// assign the language data in array  to $data
		$data = $this->load_language();
		$this->load->library('email');
		$this->email->from('admin@vfinder.cn', 'NingerJohn');
		$this->email->to($email);
		$this->email->bcc('admin@vfinder.cn');
		$subject = $data[$title];
		$data['link'] = $link;
		$content = $this->load_views($email_template, $data, true);
		$this->email->subject($subject);
		$this->email->message($content);
		$status = $this->email->send();
		if ($status) {
			return true;
		}else{
			return false;
		}
		//echo $this->email->print_debugger();
	}
	//
	function find_pwd(){
		//
		$data = $this->load_language();
		$data['title'] = $data['find_pwd'];
		$data['css'] = 'entry';
		$data['style_folder'] = $this->style_folder;
		$view_arr = array('front/head','entry/find_pwd','entry/footer');
		$this->load_views( $view_arr, $data);
	}
	//
	function find_submit(){
		//
		$title = 'find_mail_title';
		$table = 'mail_verify';
		$email = $this->input->post('email');
		$email = '1084046180@qq.com';
		$rand = md5(rand(1000,9999));
		$code = md5($rand.time());
		$email_template = 'entry/mail/find_pwd';
		$link = base_url("index.php/entry/reset_pwd?email=".$email."&code=".$code);
		$data = array('email'=>$email , 'code'=>$code );
		$result = $this->entry_m->insert($table, $data);
		$status = $this->send_mail($email, $email_template, $title, $link);
		//$status = true;
		if( $status ){
			echo 'true';
		}else{
			echo 'false';
		}
	}
	// reset password page
	function reset_pwd(){
		//
		$data = $this->load_language();
		$table = 'mail_verify';
		$code = $this->input->get();
		$result = $this->entry_m->exist_check($table,$code);
		$data['title'] = $data['find_pwd'];
		$data['css'] = 'entry';
		$data['email'] = $code['email'];
		$data['result'] = $result;
		$data['style_folder'] = $this->style_folder;
		$view_arr = array('front/head', 'entry/reset_pwd', 'entry/footer');
		$this->load_views($view_arr,$data);
	}
	// reset password function
	function reset_password(){
		//
		$table = 'user';
		$data = $this->input->post();
		$rand = md5(rand(1000,9999));
		$data['rand'] = $rand;
		$data['password'] = md5($data['password'].$rand);
		$result = $this->entry_m->reset_password($table, $data);
		if($result == 1 ){
			echo '1';
		}else{
			echo '0';
		}
	}
	// # logout method # destroy the session data
	function logout(){
		$this->session->sess_destroy();
		redirect( base_url().'index.php/entry/login' );
		exit("ninger");
	}
	// # output captcha code
	public function output_captcha(){
		$this->create_captcha();
	}
}

















