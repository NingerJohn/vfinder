<?php
/**
* 
*/
class Subtitle_m extends MY_Model
{
	
	function __construct()
	{
		parent::__construct();
	}
	// # Model: get posts by category # a general model can be used for all pages
	function category_posts($cate,$table='post',$num='1',$start="0"){
		//
		$result = array();
		if(is_array($cate)){
			for ($i=0; $i < count($cate); $i++) { 
				$result = array_merge($result,array($cate[$i]=>$this->category_post($cate[$i],$table,$num,$start)));
			}
		}else{
			$result = array($cate=>$this->category_post($cate,$table,$num,$start));
		}
		return $result;
	}
	//
	function subtitle_count($table){
		$result = $this->db->get($table)->num_rows();
		return $result;		
	}
	// # Model: index page # get 10 posts by category
	function subtitle_posts($table='post',$num='10',$start="0"){
		//
		$result = $this->db->order_by('time DESC')->get($table,$num,$start)->result_array();
		return $result;
	}
	//
	function filepath_id($id){
		//
		$result = $this->db->select('filepath')->where(array('subtitle_id'=>$id))->get('subtitle')->result_array();
		return $result;
	}
	// subtitle comments
	function subtitle_comments($table, $cond, $order, $num, $start=0){
		//
		$temp = $this->db->order_by($order)->get_where($table, $cond, $num, $start)->result_array();
		return $temp;
	}
	//
	function rating($table, $cond, $field){
		//
		///$this->db->
		$result = $this->update_value($table,$field,$field.'+1',$cond);
		return $result;
	}
}














