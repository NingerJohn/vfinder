<?php
/**
*
*/
class Index extends Front_Controller
{
	public $final = '';
	function __construct()
	{
		parent::__construct();
		$this->load->model('front/index_m');
	}
	function index($start=0){
		$num = 2; // quantity of each category
		$table = array('subtitle','torrent_file');
		$session = $this->sess_data;
		// assign the language data in array  to $data
		$data = $this->load_language();
		// get the posts with specified categories and to data array
		//$data['posts'] = $this->index_m->tables_posts($table,$num,$start);
		$data['tv_posts'] = $this->tv_posts();
		$data['subtitle_posts'] = $this->subtitle_posts();
		$data['movie_posts'] = $this->movie_posts();
		$data['book_posts'] = $this->book_posts();
		$data['video_posts'] = $this->video_posts();
		$data['css'] = 'index';
		$data['style_folder'] = $this->style_folder;
		$data['session'] = $session;
		$view_arr = array('front/head','index/index','front/footer');
		$this->load_views($view_arr,$data);
	}
	// tv
	function tv_posts(){
		$table = 'tv_torrent';
		$order = "time DESC";
		$num = 5;
		$result = $this->index_m->tv_posts($table, $order, $num);
		return $result;		
	}
	// subtitle
	function subtitle_posts(){
		//
		$table = 'subtitle';
		$order = "time DESC";
		$num = 5;
		$result = $this->index_m->subtitle_posts($table, $order, $num);
		return $result;
	}
	// movie
	function movie_posts(){
		//
		$table = 'movie_torrent';
		$order = "time DESC";
		$num = 5;
		$result = $this->index_m->movie_posts($table, $order, $num);
		return $result;
	}
	// book
	function book_posts(){
		//
		$table = 'book_torrent';
		$order = "time DESC";
		$num = 5;
		$result = $this->index_m->book_posts($table, $order, $num);
		return $result;
	}
	// video
	function video_posts(){
		//
		$table = 'video_torrent';
		$order = "time DESC";
		$num = 5;
		$result = $this->index_m->video_posts($table, $order, $num);
		return $result;
	}
	//
	// infinite classify
	function category(){
		$result = $this->index_m->all_category();
		return $this->all_cate($result);
	}
	function all_cate($result,$sign=""){
		$final = '';
		$sign = "-".$sign;
		for ($i=0; $i < count($result); $i++) {
			$id = $result[$i]['id'];
			$final .= $sign.$result[$i]['name'].'<br>';
			$temp = $this->index_m->get_parent_id($id);
			if(count($temp)>=1){
				$final.= $this->all_cate($temp,$sign);
			}
		}
		return $final;
	}
	//
	function test(){
		//
		echo "Ninger";
	}
	//
}





/* */
/* */
