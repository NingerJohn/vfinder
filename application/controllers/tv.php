<?php
/**
* 
*/
class Tv extends Front_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('front/tv_m');
		$this->load->helper('file');
		$this->table = 'tv_torrent';
		//$this->temp = array();
	}
	function index(){
		//
		$table = $this->table;
		$cate = 'tv';
		$num = 10;
		$start = $this->input->get('page');
		$url = 'index.php/tv?';
		$total = $this->tv_m->posts_count($table,$cate);
		$posts = $this->tv_m->category_post($cate,$table,$num,$start);
		$paging = $this->paging($num,$url,$total);
		//
		$data = $this->load_language();
		$data['session'] = $this->session->all_userdata();
		$data['page_title'] = 'Movie';
		$data['posts'] = $posts;
		$data['paging'] = $paging;
		$data['css'] = 'tv';
		$data['style_folder'] = $this->style_folder;
		$view_arr = array('front/head','tv/list','front/footer');
		$this->load_views($view_arr,$data);
		//
	}
	// download torrent
	function download_torrent($id){
		//
		$table = $this->table;
		$field = 'torrent_id';
		$ext = '.torrent';
		$this->download($table, $field, $id, $ext);
	}

	// format size of torrent file
	function file_size_format($size=0){
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
	// get all files into a string from a torrent file
	function torrent_files_array($filepath){
		$files_arr = array();
		$final = array();
		$temp = array();
		require_once('./plugins/bittorrent/Decode.php');
		$Torrent_Decode = new File_Bittorrent2_Decode;
		//$filepath = './data/torrent/1420772477/Stonehearst_Asylum_2014_720p.torrent';
		//$info = $Torrent_Decode->decodeFile($filepath);
		try{
			$info = $Torrent_Decode->decodeFile($filepath);
		}
		catch(Exception $e){
			return false;
		}
		$files = $info['files'];
		for ($i=0; $i < count($files); $i++) {
			$files_arr = array_merge($files_arr,array( $i => ($files[$i]['filename'].':'.$this->file_size_format($files[$i]['size']).';')));
		}
		$temp = $this->parse_file_arr($files_arr);
		//ksort($temp);
		return $temp;
	}
	//
	function id($id){
		//
		$data = $this->load_language();
		$data['session'] = $this->sess_data;
		// get information of torrent
		$table = $this->table;
		$cond = array('torrent_id'=>$id);
		$torrent = $this->index_m->cond_post($table, $cond);
		// get information of comment
		$table = $table.'_cmt';
		$cond = array('torrent_id'=>$torrent['0']['torrent_id']);
		$comment = $this->tv_m->tv_comments($table, $cond, 'time DESC', $num=100, $start=0);
		// get user's information
		$table = 'user';
		$cond = array('uid'=>$torrent['0']['uid']);
		$user = $this->index_m->cond_post($table, $cond);
		// get information of all files in the torrent file
		$filepath = $torrent['0']['filepath'];
		$torrent['0']['preview_info'] = $this->torrent_files_array($filepath);
		$data['posts'] = $torrent['0'];
		$data['page_title'] = $torrent['0']['title'];
		$data['comment'] = $this->comment_process($comment);
		$data['user'] = $user['0'];
		//$data['comment'] = $comment;
		$data['css'] = 'tv';
		$data['style_folder'] = $this->style_folder;
		//$data['posts'] = $this->index_m->cond_post($table, $cond);
		$view_arr = array('front/head-single','tv/single','front/footer');
		$this->load_views($view_arr,$data);
	}
	//
	function comment_process($arr){
		//
		$temp = array();
		//$count = 0;
		foreach ($arr as $onekey => $onevalue) {
			if ($onevalue['at']==0) {
				//$count++;
				$this->temp = array();
				$temp = array_merge($temp, array($onevalue));
				//
				/*
				foreach ( $arr as $twokey => $twovalue ) {
					if ($onevalue['comment_id']==$twovalue['at']) {
						$temp = array_merge($temp, array($twovalue));
						foreach ($arr as $threekey => $threevalue) {
							if ($twovalue['comment_id']==$threevalue['at']) {
								$temp = array_merge($temp, array($threevalue));
								foreach ($arr as $fourkey => $fourvalue) {
									if ($threevalue['comment_id']==$fourvalue['at']) {
										$temp = array_merge($temp, array($fourvalue));
									}
								}
							}
						}
					}
				}
				*/
				//
			}else{
				$temp = array_merge($temp, array($onevalue['content'] => $this->cmt_callback($arr,$onevalue['comment_id'])));
			}
		}
		return $temp;
	}
	// callback method for comment process
	function cmt_callback($arr, $cmt_id){
		//
		foreach ( $arr as $key => $value ) {
			if ($cmt_id == $value['at']) {
				$this->temp = array_merge($this->temp, array($value));
				$this->cmt_callback($arr,$value['comment_id']);
			}
		}
		return $this->temp;
	}
	// deal with key and value make it like key=>value
	function key_val_arr($arr){
		//
		$kv = count($arr);
		if($kv == 0){
			return $arr;
		}elseif ($kv==1) {
			return array('0',$arr['0']);
		}elseif ($kv==2) {
			return array($arr['0'],$arr['1']);
		}elseif ($kv==3) {
			return array($arr['0'],array($arr['1']=>$arr['2']));
		}elseif ($kv==4) {
			return array($arr['0'],array($arr['1']=>array($arr['2']=>$arr['3'])));
		}
		//return array($one=>$two);
	}
	//
	function parse_file_arr($array){
		$result=array();
		foreach($array as $s=>$arr) {
			$b=explode('\\',$arr);
			$f=$this->key_val_arr($b);
			@$data[$s][$f[0]]=$f[1];
		}//foreach
		foreach($data as $arr){
			$result=array_merge_recursive($result,$arr);
		}
		return $result;
	}
	// add a comment
	function add_comment(){
		//
		$session = $this->sess_data;
		$temp = $this->input->post();
		$table = $this->table.'_cmt';
		$temp['uid'] = $session['uid'];
		$temp['username'] = $session['username'];
		$data = $temp;
		$result = $this->tv_m->insert($table,$data);
		if($result==1){
			echo 'true';
		}else{
			echo 'false';
		}
	}
	// rating method
	function rating(){
		//
		$table = $this->table;
		$session = $this->sess_data;
		$temp_data = $this->input->post();
		$field = $temp_data['rating'];
		$cond = array('torrent_id'=>$this->input->post('torrent_id'));
		array_shift($temp_data);
		array_shift($temp_data);
		$final_data = $temp_data;
		$status = $this->tv_m->rating($table, $cond, $field);
		if ($status==1) {
			echo "true";
		}else{
			echo "false";
		}
	}
	//
	function test(){
		$end = strtotime(date("Y-m-d"))+3600*24-1;
		$now = time();
		echo $end;
		echo date('Y-m-d H:i:s',$end);
		echo date('Y-m-d H:i:s');
	}
}




