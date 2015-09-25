<?php
/**
* 
*/
class Subtitle extends Front_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('front/subtitle_m');
		$this->load->helper('file');
		$this->table = 'subtitle';
	}
	function index(){
		//
		$table = $this->table;
		$cate = 'Movie';
		$num = 10;
		$start = $this->input->get('page');
		$url = 'index.php/subtitle?';
		$total = $this->subtitle_m->subtitle_count($table);
		$posts = $this->subtitle_m->subtitle_posts($table,$num,$start);
		$paging = $this->paging($num,$url,$total);
		//
		//$this->lang->load('front','chinese');
		//$data = $this->lang->line('language');
		$data = $this->load_language();
		$data['session'] = $this->session->all_userdata();
		$data['title'] = 'Movie';
		$data['posts'] = $posts;
		$data['paging'] = $paging;
		$data['css'] = 'subtitle';
		$data['style_folder'] = $this->style_folder;
		$view_arr = array('front/head','subtitle/list','front/footer');
		$this->load_views($view_arr,$data);
		//
	}
	// download subtitle
	function download_subtitle($id){
		//
		$table = $this->table;
		$field = 'subtitle_id';
		$ext = '.srt';
		$this->download($table, $field, $id, $ext);
		//
		/*		
		//$data = $this->load_language();
		//$session = $this->sess_data;
		if(isset($session['username'])){
			$table = 'subtitle';
			$field = 'subtitle_id';
			$ext = '.srt';
			$this->download($table, $field, $id, $ext);
		}else{
			echo '<script>alert("'.$data['please_login'].'");</script>';
		}*/
		//
	}
	//
	function preview_subtitle($filepath){
		//
		$content =  @file_get_contents($filepath);
		$temp_content = substr($content, 0, 1000);
		$encode = mb_detect_encoding($temp_content, array("ASCII",'UTF-8',"GB2312","GBK",'BIG5'));
		$final_content = iconv($encode, 'UTF-8', $temp_content);
		return $final_content;
	}
	//
	function id($id){
		//
		$data = $this->load_language();
		$data['style_folder'] = $this->style_folder;
		$data['css'] = 'subtitle';
		// get information of subtitle
		$table = $this->table;
		$cond = array('subtitle_id'=>$id);
		$subtitle = $this->index_m->cond_post($table, $cond);
		$filepath = $subtitle['0']['filepath'];
		$encode = mb_detect_encoding($filepath, array("ASCII",'UTF-8',"GB2312","GBK",'BIG5'));
		if( $encode =='ASCII' ){
			$subtitle['0']['preview_info'] = $this->preview_subtitle( $filepath );
		}else{
			$subtitle['0']['preview_info'] = $this->preview_subtitle( base_url().$filepath);
		}
		// get information of comment
		$table = $table.'_cmt';
		$cond = array('subtitle_id'=>$subtitle['0']['subtitle_id']);
		$comment = $this->subtitle_m->subtitle_comments($table, $cond, 'time DESC', $num=100, $start=0);
		// get user's information
		$table = 'user';
		$cond = array('uid'=>$subtitle['0']['uid']);
		$user = $this->index_m->cond_post($table, $cond);
		// pass all above value to $data;
		$data['posts'] = $subtitle['0'];
		$data['comment'] = $this->comment_process($comment);
		$data['user'] = $user['0'];
		$data['page_title'] = $subtitle['0']['title'];
		$data['session'] = $this->sess_data;
		$view_arr = array('front/head-single','subtitle/single','front/footer');
		$this->load_views($view_arr,$data);
		//print_r($data['posts']);
		//$filepath = $subtitle['0']['filepath'];
		//echo $encode = mb_detect_encoding(iconv('UTF-8','ASCII//IGNORE',$filepath), array("ASCII",'UTF-8',"GB2312","GBK",'BIG5'));
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
	//
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
	//
	function add_comment(){
		//
		$session = $this->sess_data;
		$temp = $this->input->post();
		$table = $this->table.'_cmt';
		$temp['uid'] = $session['uid'];
		$temp['username'] = $session['username'];
		$data = $temp;
		$result = $this->subtitle_m->insert($table,$data);
		if($result==1){
			echo 'true';
		}else{
			echo 'false';
		}
	}
	//
	function rating(){
		//
		$table = $this->table;
		$session = $this->sess_data;
		$temp_data = $this->input->post();
		$field = $temp_data['rating'];
		$cond = array('subtitle_id'=>$this->input->post('subtitle_id'));
		array_shift($temp_data);
		array_shift($temp_data);
		$final_data = $temp_data;
		$status = $this->subtitle_m->rating($table, $cond, $field);
		if ($status==1) {
			echo "true";
		}else{
			echo "false";
		}
	}
	//
	//
}




