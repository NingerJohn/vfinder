<?php
/**
* 
*/
class Show extends Front_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('front/index_m');
	}
	function index(){
		//
		$data = $this->load_language();
		$data['style_folder'] = $this->style_folder;
		$data['session'] = $this->sess_data;
		$cate = $this->input->get('cate');
		$id = $this->input->get('id');
		$this->$cate($data,$id);
	}
	function subtitle($data, $id){
		//
		//require_once(base_url(""));
		$data['css'] = 'list';
		$table = 'subtitle';
		$cond = array('subtitle_id'=>$id);
		//
		$subtitle = $this->index_m->cond_post($table, $cond);
		$table = 'user';
		$cond = array('uid'=>$subtitle['0']['uid']);
		$user = $this->index_m->cond_post($table, $cond);
		$data['posts'] = $subtitle['0'];
		$data['user'] = $user['0'];
		$view_arr = array('front/head','subtitle/single','front/footer');
		$this->load_views($view_arr,$data);
	}
	function movie($data, $id){
		//
		$data['css'] = 'list';
		$table = 'torrent_file';
		$cond = array('torrent_id'=>$id);
		//
		$torrent = $this->index_m->cond_post($table, $cond);
		$table = 'user';
		$cond = array('uid'=>$torrent['0']['uid']);
		$user = $this->index_m->cond_post($table, $cond);
		$data['posts'] = $torrent['0'];
		$data['user'] = $user['0'];
		//$data['posts'] = $this->index_m->cond_post($table, $cond);
		$view_arr = array('front/head','movie/single','front/footer');
		$this->load_views($view_arr,$data);
	}
	function video($data, $id){
		//
		$data['css'] = 'list';
		$table = 'torrent_file';
		$cond = array('torrent_id'=>$id);
		//
		$torrent = $this->index_m->cond_post($table, $cond);
		$table = 'user';
		$cond = array('uid'=>$torrent['0']['uid']);
		$user = $this->index_m->cond_post($table, $cond);
		$data['posts'] = $torrent['0'];
		$data['user'] = $user['0'];
		//$data['posts'] = $this->index_m->cond_post($table, $cond);
		$view_arr = array('front/head','video/single','front/footer');
		$this->load_views($view_arr,$data);
	}
	function book($data, $id){
		//
		$data['css'] = 'list';
		$table = 'torrent_file';
		$cond = array('torrent_id'=>$id);
		//
		$torrent = $this->index_m->cond_post($table, $cond);
		$table = 'user';
		$cond = array('uid'=>$torrent['0']['uid']);
		$user = $this->index_m->cond_post($table, $cond);
		$data['posts'] = $torrent['0'];
		$data['user'] = $user['0'];
		//$data['posts'] = $this->index_m->cond_post($table, $cond);
		$view_arr = array('front/head','book/single','front/footer');
		$this->load_views($view_arr,$data);
	}	
}


/* show.php */
/* Location: /application/controllers/show.php */