<?php
/**
* 
*/
class One extends Front_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->helper('file');
	}
	function index(){
		//
		//$this->load->view('front/user');
		//
	}
	function filter(){
		//
		$arr = array('id'=>array('1','2','5'),'title'=>array('1','2','3','5'),'category'=>array('Movie'));
		if(empty($arr)){
			$result_obj = $this->db->select('title, content, category');
		}else{
			$result_obj = $this->db->select('title, content, category');
			$keys = array_keys($arr);
			for ($i=0; $i < count($arr); $i++) { 
					$result_obj = $result_obj->where_in($keys[$i],$arr[$keys[$i]]);
			}
		}
		echo '<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">';
		$final = $result_obj->get('post')->result_array();
		echo '<pre>';
		print_r($final)."<br>";
		echo '</pre>';
	}
}




