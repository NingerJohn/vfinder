<?php
/**
* 
* 
* 
*/
class Entry_m extends MY_Model
{
	
	function __construct()
	{
		parent::__construct();
	}
	// signup page
	function signup($table, $data){
		//
		$check = $this->db->get_where($table,array('signup_ip'=>$data['ip']))->num_rows();
		if( $check == 1 ){
			return false;
		}
		$two = array('username'=>$data['username'] ,'email'=>$data['email'], 'password'=>$data['password'], 'rand'=>$data['rand'], 'signup_ip'=>$data['ip']);
		$this->insert($table,$two);
		$result = $this->db->select('uid')->get_where($table,array('email'=>$data['email']))->row_array();
		$this->insert('user_info',array('uid'=>$result['uid']));
		$this->insert('mail_verify',array('email'=>$data['email'], 'code'=>$data['code']));
		$result = $this->db->affected_rows();
		return $result;
	}
	// find password page
	function find_pwd($table,$data){
		//
		$result = $this->insert();
		return $result;
	}
	// check exist or not
	function exist_check($table, $data){
		//
		$result = $this->db->get_where($table,$data)->num_rows();
		return $result;
	}
	// mail verify methods
	function mail_verify($code){
		//
		$table = 'user';
		$table_info = 'mail_verify';
		$cond = array('email'=>$code['email']);
		$data = array('mail_verify'=>1);
		$this->update($table, $data, $cond);
		$cond_info = array('email'=>$code['email'],'code'=>$code['code']);
		$this->delete($table_info,$cond_info);
	}
	// reset password and delete the conbination from mail_verify table
	function reset_password($table, $data){
		//
		$pwd = array('password'=>$data['password'], 'rand'=>$data['rand']);
		$code = array('email'=>$data['email'], 'code'=>$data['code']);
		$this->update($table, $pwd, array('email'=>$data['email']));
		$table = 'mail_verify';
		$result = $this->delete($table, $code);
		return $result;
	}
	// Just for Test
	// get all categories' name
	function all_category(){
		$result = $this->db->get_where('category',array('parent_id'=>0))->result_array();
		return $result;
	}
	//
	function check_parent_id(){
		//echo "";
	}
	//
	function get_parent_id($id){
		$result = $this->db->get_where('category',array('parent_id'=>$id))->result_array();
		return $result;
	}
}














