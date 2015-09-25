<?php
/**
* 
*/
class Test extends Front_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->helper('file');
	}
	function index(){
		//
		//$this->
		$b = 3;
		$one = 0;
		$end = $b;
		for ($i=0; $i < 46; $i++) { 
			$mid = ($one+$end)/2;
			if ($mid*$mid < $b) {
				$one = $mid;
			}else{
				$end = $mid;
			}
		}
		echo $mid;
		$x = (1+2)/2;
		for($i=0;$i<2;$i++){
			$x= ($x + 2/$x)/2;
		}
		echo $x;
	}
	//
	function classify($data){
		//
		for ($i=0; $i < count($data); $i++) {
			$data[$i] = explode('(', $data[$i]);
			for ($j=0; $j < count($data[$i]); $j++) { 
				$temp = str_replace(')', '', $data[$i][$j]);
				if($j==0){
					$final[$i]['chinese'] = ucwords(trim($temp));
				}else{
					$final[$i]['english'] = ucwords(trim($temp));
				}
			}
		}
		return $final;
	}
	//
	function insert_db($data){
		//
		$result;
		for ($i=0; $i < count($data); $i++) { 
			$this->db->insert('dictionary',$data[$i]);
			$result .= $this->db->affected_rows();
		}
		return $result;
	}
	//
	function quality_match($str){
		$quality = array('DVD','HDRip','HDTV','WEB','BRRip;BluRay;BR','BDRip');
		for($i=0;$i<count($quality);$i++){
			$arr = explode(';', $quality[$i]);
			for($j=0;$j<count($arr);$j++){
				if(stripos($str, $arr[$j])){
					return $result = $arr[$j];
				}
			}
		}
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
	function one(){
		return $data['info'] = 'ninger';
	}
	//
	// how to use bittorrent
	function bittorrent(){
		//
		require_once('./plugins/bittorrent/Encode.php');
		require_once('./plugins/bittorrent/Decode.php');
		$Torrent_Decode = new File_Bittorrent2_Decode;
		$Torrent_Encode = new File_Bittorrent2_Encode;
		$info = $Torrent_Decode->decodeFile('./data/torrent/1420772477/Stonehearst_Asylum_2014_720p.torrent');
		echo '<pre>';
		print_r($info);
		echo '</pre>';
		echo $this->size_format($info['size']);		
	}
	// show information of torrent file
	function torrent_file_info(){
		//
		require_once('./plugins/bittorrent/Decode.php');
		$Torrent_Decode = new File_Bittorrent2_Decode;
		$info = $Torrent_Decode->decodeFile('./data/torrent/1420772477/Stonehearst_Asylum_2014__720p.torrent');
		echo '<pre>';
		print_r($info);
		echo '</pre>';
		echo $this->size_format($info['size']);
	}
	// format size of torrent file
	function size_format($size=0){
		//
		$base = 1024;
		if( ( pow($base,2) > $size) ){
			return round( ($size/pow($base,1)), 2 ).'KB';
		}elseif ( (pow($base,2) <= $size) and ( pow($base,3) > $size) ) {
			return round( ($size/pow($base,2)), 2 ).'MB';
		}elseif ( ( pow($base,3) <= $size) and ( pow($base,4) > $size) ) {
			return round( ($size/pow($base,3)), 2 ).'GB';
		}
	}
}




