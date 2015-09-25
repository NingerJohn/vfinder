<?php
/*
*
* 
*
*
*/
class Index_m extends MY_Model
{
	
	function __construct()
	{
		parent::__construct();
	}
	// tv posts
	function tv_posts($table, $order, $num, $start=0){
		//
		$result = $this->db->order_by($order)->limit($num, $start)->get($table)->result_array();
		return $result;
	}
	// subtitle posts
	function subtitle_posts($table, $order, $num, $start=0){
		//
		$result = $this->db->order_by($order)->limit($num, $start)->get($table)->result_array();
		return $result;
	}
	//
	function movie_posts($table, $order, $num=1, $start=0){
		$result = $this->db->order_by($order)->limit($num, $start)->get($table)->result_array();
		return $result;
	}
	//
	function book_posts($table, $order, $num=1, $start=0){
		$result = $this->db->order_by($order)->limit($num, $start)->get($table)->result_array();
		return $result;
	}
	//
	function video_posts($table, $order, $num=1, $start=0){
		$result = $this->db->order_by($order)->limit($num, $start)->get($table)->result_array();
		return $result;
	}
	// All
	function cond_posts($table, $cond, $order, $num=1, $start=0){
		$result = $this->db->order_by($order)->get_where($table, $cond, $num, $start)->result_array();
		return $result;
	}
	// All
	function cond_post($table, $cond){
		$result = $this->db->get_where($table, $cond)->result_array();
		return $result;
	}
	// All
	function get_categories($table, $field){
		//
		$result = $this->db->select($field)->group_by($field)->get($table)->result_array();
		return $result;
	}
	// # get posts by category # a general model can be used for all pages
	function categories_posts($table, $cate, $num='1', $start="0"){
		//
		$result = array();
		for ($i=0; $i < count($cate); $i++) { 
			$cond = array('category'=>$cate[$i]);
			$result = array_merge($result,array($cate[$i]=>$this->cond_posts($table, $cond, $num, $start)));
		}
		return $result;
	}
	// # index page # get posts by category from torrent and subtitle table
	function tables_posts($table,$num='1',$start="0"){
		//
		$result = array();
		for ($i=0; $i < count($table); $i++) { 
			if ($table[$i] == 'torrent_file') {
				$field = 'category';
				$cates = $this->get_categories($table[$i],$field);
				for ($j=0; $j < count($cates); $j++) { 
					$cate = $cates[$j][$field];
					$cond = array($field=>$cate);
					$result = array_merge( $result, array( $cate => $this->cond_posts($table[$i], $cond, $num, $start) ) );
				}
			}else{
				$result = array_merge($result,array($table[$i]=>$this->get_limit($table[$i], $num, $start) ));	
			}
		}
		return $result;
	}
	//
	function all_posts(){
		//
	}
}














