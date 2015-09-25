<?php
/**
* 
*/
class User_m extends MY_Model
{
	
	function __construct()
	{
		parent::__construct();
	}
	/*
	* user information group
	*/
	// delete tag
	function del_interest($table,$data,$cond){
		//
		$sql = "UPDATE {$table} SET interest = ( Replace( interest, '{$data}', '') ) WHERE {$cond}";
		$temp = $this->db->query($sql);
		$result = $this->db->affected_rows();
		return $result;
	}
	// concatenate a new string to the end of old one
	function concat($table,$data,$cond){
		$sql = "UPDATE {$table} SET interest = CONCAT (interest, '{$data['interest']}') WHERE {$cond}";
		$temp = $this->db->query($sql);
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
	// # get user information by uid #
	function get($table,$cond){
		$result = $this->db->get_where($table,$cond)->result_array();
		return $result;
	}
	//
	function get_specify($table, $target, $cond){
		$result = $this->db->select($target)->get_where($table,$cond)->result_array();
		return $result;		
	}
	// insert uploaded file into DB
	// add interest tags into DB
	function insert($table,$data){
		//
		$temp = $this->db->insert($table,$data);
		$result = $this->db->affected_rows();
		return $result;
	}
	/* 
	* Group: vshare
	* 
	*/
	function torrent_list($tables,$cond){
		//
		$temp = array();
		for ($i=0; $i < count($tables); $i++) { 
			$temp = array_merge($temp, array($tables[$i]=>$this->db->order_by('time DESC')->get_where($tables[$i],$cond)->result_array()));
		}
		return $temp;
	}
	// total quantity of specified post
	function torrent_count($tables, $cond){
		$temp = 0;
		for ($i=0; $i < count($tables); $i++) {
			$temp = $temp + $this->db->get_where($tables[$i],$cond)->num_rows();
		}
		//$temp = $this->db->get_where($tables,$cond)->num_rows();
		return $temp;
	}
	// delete the file from DB
	function delete_torrent($table,$cond){
		//
		$temp = $this->db->delete($table,$cond);
		$result = $this->db->affected_rows();
		return $result;
	}
	// md5 value of file check before confirm of upload
	function file_md5_check($tables,$md){
		$temp = 0;
		for ($i=0; $i < count($tables); $i++) { 
			$one = $this->db->get_where($tables[$i],array('md5'=>$md))->num_rows();
			if($one){
				return true;
			}
		}
		return false;
	}
	// subtitle page 
	function subtitle_list($tables, $cond, $start, $num){
		//
		$temp = array();
		for ($i=0; $i < count($tables); $i++) { 
			$temp = array_merge($temp, $this->db->order_by('time DESC')->get_where($tables[$i], $cond, $start, $num)->result_array());
		}
		return $temp;
	}
	// total quantity of specified post
	function subtitle_count($tables, $cond){
		$temp = 0;
		for ($i=0; $i < count($tables); $i++) {
			$temp = $temp + $this->db->get_where($tables[$i],$cond)->num_rows();
		}
		//$temp = $this->db->get_where($tables,$cond)->num_rows();
		return $temp;
	}
	// delete the subtitle from DB
	function delete_subtitle($table,$cond){
		//
		$temp = $this->db->delete($table,$cond);
		$result = $this->db->affected_rows();
		return $result;
	}
	// full-text search 
	function rename(){
		// $sql = SELECT * FROM torrent_file WHERE MATCH (title) AGAINST ('*I Origin*'IN BOOLEAN MODE); 
		// I.Origins.2014.HDRip.XviD.AC3-EV
	}
}
















