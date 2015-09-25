<?php
/**
* 
*/
class MY_Model extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
	}

	//
	// # Model: pagination # get posts with num and start parameter
	function get_posts($table,$num,$start){
		$result = $this->db->limit($num,$start)->get($table)->result_array();
		return $result;
	}
	// # Model: pagination # total Qty of posts
	function posts_count($table,$cate=NULL){
		if(!empty($cate)){
			$result = $this->db->where('category',$cate)->get($table)->num_rows();
			return $result;
		}else{
			$result = $this->db->get($table)->num_rows();
			return $result;
		}
	}
	// # Model: check email # used on login page
	function username_check($username){
		$result = $this->db->get_where('user',array('username'=>$username))->num_rows();
		return $result;
	}
	// # Model: check email # used on login page
	function email_check($email){
		$result = $this->db->get_where('user',array('email'=>$email))->num_rows();
		return $result;
	}
	// # Model: check email # used on login page
	function email_verify_check($email){
		$result = $this->db->select('mail_verify')->get_where('user',array('email'=>$email))->result_array();
		return $result;
	}
	// # Model: check email and password # used on login page
	function pwd_check($email,$pwd){
		$table = "user";
		$cond = array('email'=>$email);
		$rand = $this->db->select('rand')->get_where($table,$cond)->result_array();
		$result = $this->db->get_where($table, array('email'=>$email,'password'=>md5($pwd.$rand['0']['rand'])))->num_rows();
		return $result;
	}
	// # Model: get user information # 
	function online($email,$pwd){
		$table = "user";
		$cond = array('email'=>$email);
		$rand = $this->db->select('rand')->get_where($table,$cond)->result_array();
		$data = array('online'=>'1');
		$this->db->where('email',$email)->update($table,$data);
		$account_info = $this->db->select('uid,username,email,type,reg_time,mail_verify,online,forbid')->get_where($table,array('email'=>$email,'password'=>md5($pwd.$rand['0']['rand'])))->result_array();
		$this->session->set_userdata($account_info[0]);
	}
	// # Common Model: insert function # like ad_comment
	function insert($table,$data){
		//
		$this->db->insert($table,$data);
		$result = $this->db->affected_rows();
		return $result;
	}
	// update into DB
	function update($table,$data,$cond){
		//
		$temp = $this->db->update($table,$data,$cond);
		$result = $this->db->affected_rows();
		return $result;
	}
	// update into DB
	function update_value($table,$field,$val,$cond){
		//
		$temp = $this->db->where($cond)->set($field,$val,false)->update($table);
		$result = $this->db->affected_rows();
		return $result;
	}
	// # get user information by uid #
	function get($table,$cond){
		$result = $this->db->get_where($table,$cond)->result_array();
		return $result;
	}
	// # get user information by uid #
	function get_limit($table, $num, $start){
		$result = $this->db->limit($num, $start)->get($table)->result_array();
		return $result;
	}
	// delete $data with $cond from $table
	function delete($table, $cond){
		//
		$temp = $this->db->delete($table, $cond);
		$result = $this->db->affected_rows();
		return $result;
	}
	// for whole site
	function user_action_record($table, $data){
		//
		$status = $this->insert($table, $data);
		return $status;
	}
	//
	function action_repeat_check(){
		//
	}
}











