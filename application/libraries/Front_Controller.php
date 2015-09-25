<?php
/**
* 
*/
class Front_Controller extends MY_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('front/index_m');
		$this->style_folder = base_url().'style/';
	}
	//	download file
	public function download($table, $field, $id,$ext){
		//
		$cond = array($field=>$id);
		$file = $this->index_m->cond_post($table, $cond);
		$this->index_m->update_value($table, 'download', 'download+1', $cond);
		header('Content-Type: application/octet-stream');
		header('Content-Disposition: attachment; filename='.$file['0']['title']); //
		header('Pragma: no-cache');
		readfile( $file['0']['filepath'] );
	}
	/*
	* $data = array("uid"=>$uid, "username"=>$username, "action_type"=>$action_type, "url"=>$current_url);
	*/
	public function user_action_record($table, $data){
		//
		$ip_address = $this->get_user_ip();
		$data['ip_address'] = $ip_address;
		$table = "user_action_history";
		$result = $this->index_m->user_action_record($table, $data);
		if ($result === 1) {
			echo "true";
		}else{
			echo "false";
		}
	}
}














