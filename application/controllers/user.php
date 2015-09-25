<?php
/**
*
*/
class User extends MY_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('front/user_m');
		$this->style_folder = base_url().'style/';
		if( $this->login_check() === 'false' ){
			redirect(base_url().'index.php/entry/login');
		}
		//print_r($this->session->all_userdata());
	}
	function index(){
		//
		$data = $this->load_language();
		$session = $this->sess_data;
/*		if($session['mail_verify']=='0'){
			$data['style_folder'] = $this->style_folder;
			$data['css'] = 'user';
			$data['title'] = $data['mail_verify'];
			$view_arr = array('front/mail_verify');
			$this->load_views($view_arr,$data);
			return false;
		}*/
		$data['session'] = $session;
		$data['style_folder'] = $this->style_folder;
		$data['css'] = 'user';
		$data['menu_arr'] = array('Home'=>'active','Post'=>'','Download'=>'');
		$view_arr = array('front/head');
		$this->load_views($view_arr,$data);
		//
		$action = $this->input->get('manage');
		switch ($action) {
			case 'vshare':
				$this->vshare();
				break;
			case 'post':
				$this->post();
				break;
			case 'subtitle':
				$this->subtitle();
				break;
			case 'user_info':
				return $this->info();
				break;
			default:
				$this->info();
				break;
		}
		$this->load_views('front/footer');
		//$this->benchmark->mark('end');
		//$run_time = $this->benchmark->elapsed_time('start','end');
		//echo '<script>alert('.$run_time.')</script>';
		//echo $_SERVER['HTTP_REFERER']; // previous visited url
	}
	//* User Center Group *//
	// user_info controller
	function info(){
		$act = $this->input->get('act');
		switch ($act) {
			case 'avatar':
				$this->info_avatar();
				break;
			case 'interest':
				$this->info_interest();
				break;
			case 'personal_info':
				$this->personal_info();
				break;
			default:
				$this->personal_info();
				break;
		}
	}
	// Offline -> avatar function
	function info_avatar(){
		//
		$this->load_views('front/info_avatar');
	}
	// Online -> personal_info
	function personal_info(){
		//
		$table = 'user_info';
		$session = $this->sess_data;
		$cond = array('uid'=>$session['uid']);
		$temp = $this->user_m->get($table,$cond);
		$mail_verify = $this->user_m->get_specify('user','username, mail_verify,email',$cond);
		//$temp['0']['gender'] = $this->gender($temp['0']['gender']);
		$data['user_info'] = $mail_verify['0'];
		$data['p_info'] = $this->info_format($temp['0']);
		//$data['info'] = $temp['0'];
		$this->load_views('user/personal_info',$data);
		//print_r($this->sess_data);
	}
	// deal with privacy of p_info;
	function info_format($info){
		//
		foreach ($info as $key => $value) {
		 	if(!($value=='')){
			 	$arr = explode(';', $value);
			 	for ($i=0; $i < count($arr); $i++) { 
			 		if($key!=='interest'){
				 		if($i==0){
				 			$info[$key] = $arr[$i];
				 		}else{
				 			$temp = $key.'_p';
				 			$info[$temp] = $arr[$i];
				 		}
			 		}
			 	}
			}else{
				$temp = $key.'_p';
				$info[$temp] = $value;
			}
		}
		return $info;
	}
	//
	function update_info_format($info){
		//
		$final ="";
		$keys = array_keys($info);
		$i = 0;
		foreach ($info as $key => $value) {
			if(($i%2)==0){
				$final[$keys[$i]] = $value;
			}else{
				$temp = --$i;
				$final[$keys[$temp]] = $info[$keys[$temp]].';'.$value;
				$i++;
			}
			$i++;
		}
		return $final;
	}
	// update perosonal information
	function update_info(){
		//
		$temp = $this->input->post();
		$session = $this->sess_data;
		$data =$this->update_info_format($temp);
		$table = 'user_info';
		$cond = array('uid'=>$session['uid']);
		$result = $this->user_m->update($table, $data, $cond);
		echo $result;
	}
	// language: gender of user
	function gender($one){
		//
		$data = $this->load_language();
		switch ($one) {
			case '2':
				return $one = $data['female'];
				break;
			case '3':
				return $one = $data['transex'];
				break;
			default:
				return $one = $data['male'];
				break;
		}
	}
	// Online -> interest
	function info_interest(){
		//
		$session = $this->sess_data;
		$table = 'user_info';
		$cond = array('uid'=>$session['uid']);
		$temp = $this->user_m->get($table,$cond);
		$data['interests'] = $temp['0']['interest'];
		$this->load_views('user/info_interest',$data);
	}
	///
	function del(){
		//
		$session = $this->sess_data;
		$table = 'user_info';
		$cond = 'uid='.$session['uid'];
		$arr = 'Well:5;';
		echo $this->user_m->del_interest($table,$arr,$cond);
	}
	// add interest tag into DB
	function add_interest(){
		// UPDATE `user_info` SET `interest` = CONCAT ( interest, 'One' )
		$session = $this->sess_data;
		$table = 'user_info';
		$cond = 'uid='.$session['uid'];
		$arr = $this->input->post();
		$status = $this->user_m->concat($table,$arr,$cond);
		echo $status;
	}
	// delete interest tag
	function del_interest(){
		// SELECT substring_index ('Movie:2;Music:2;One:3','One:3',1)
		// SELECT replace ('Movie:2;Music:2;One:3;','One:3;','')
		$table = 'user_info';
		$session = $this->sess_data;
		$cond = 'uid='.$session['uid'];
		$data = $this->input->post('interest');
		$status = $this->user_m->del_interest($table,$data,$cond);
		echo $status;
	}
	/*
	* 
	* Group : Vshare
	* Status: Online
	*
	*/
	function vshare(){
		//
		$act = $this->input->get('act');
		switch ($act) {
			case 'post_new':
				$this->vshare_new();
				break;
			case 'post_edit':
				$this->vshare_edit();
				break;
			case 'go_back':
				$this->vshare_list();
				break;
			default:
				$this->vshare_list();
				break;
		}
	}
	//
	function multi_tables_sort($arr,$field,$start=0,$num){
		//
		$fianl_arr = array();
		$one =array();
		$two =array();
		foreach ($arr as $onekey => $oneval) {
			//$keys = array_keys($oneval);
			$vals = array_values($oneval);
			for ($i=0; $i < count($vals); $i++) { 
				$one = array_merge_recursive($one, array(($onekey.'_'.$i)=>$oneval[$i]));
			}
		}
		$arr = $one; // original array of 2D data
		foreach ($one as $key => $value) {
			$one = array_merge($one, array($key=>$value[$field]));
		}
		arsort($one);
		//return $one;
		$total = count($one);
		$target = (($start / $num) + 1) * $num;
		$keys = array_keys($one);
		$vals = array_values($one);
		if ( $total>= $target ) {
			for ($i = $start; $i < ($start+$num); $i++) { 
				$two = array_merge($two,array($keys[$i]=>$vals[$i]));
			}
		}else{
			for ($i = $start; $i < ($total); $i++) { 
				$two = array_merge($two,array($keys[$i]=>$vals[$i]));
			}
		}
		//return $two;
		$keys = array_keys($two);
		for ($i=0; $i < count($keys); $i++) { 
			$fianl_arr = array_merge($fianl_arr,array($keys[$i]=>$arr[$keys[$i]]));
		}
		//return $one;
		return $fianl_arr;
	}	
	// vshare list page
	function vshare_list(){
		$tables = array('tv_torrent','movie_torrent','book_torrent','video_torrent');
		$num = 5;
		$url = 'index.php/user?manage=vshare&act=list';
		$start = $this->input->get('page');
		if(empty($start)){
			$start = 0;
		}
		$session = $this->sess_data;
		$cond = array('uid'=>$session['uid']);
		$total= $this->user_m->torrent_count($tables,$cond);
		//$data['posts'] = $this->user_m->torrent_list($tables,$cond,$num,$start);
		$arr = $this->user_m->torrent_list($tables,$cond);
		$posts = $this->multi_tables_sort($arr,'time',$start,$num);
		$data['total'] = $total;
		$data['posts'] = $posts;
		$data['paging'] = $this->paging($num,$url,$total);
		$view_arr = array('user/usr_vshare_menu','user/usr_vshare');
		$this->load_views($view_arr,$data);
	}
	//  vshare list page, user click delete btn
	function delete_torrent_file($filepath){
		//
		if(empty($filepath)){
			return false;
		}
		$arr = explode('/', $filepath);
		$sub_dir = $arr['2'];
		if(empty($sub_dir)){
			return false;
		}
		$this->load->helper('file');
		$test = delete_files('./data/torrent/'.$sub_dir,true); // delete uploaded torrent file
		rmdir('./data/torrent/'.$sub_dir); // remove current directory
	}
	// vshare list page, user click delete btn 
	function delete_torrent(){
		//
		$session = $this->sess_data;
		$table = $this->input->post('table');
		$torrent_id = $this->input->post('torrent');
		$cond = array('uid'=>$session['uid'],'torrent_id'=>$torrent_id);
		$field = 'filepath';
		$filepath = $this->user_m->get_specify($table, $field, $cond);
		$this->delete_torrent_file($filepath['0']['filepath']);
		$result = $this->user_m->delete_torrent($table, $cond);
		if($result==1){
			echo 'true';
		}else{
			echo 'false';
		}
	}
	//
	function vshare_new(){
		$view_arr = array('user/usr_vshare_menu','user/usr_vshare_edit');
		$this->load_views($view_arr);
	}
	//
	function vshare_edit(){
		$view_arr = array('user/usr_vshare_menu','user/usr_vshare_edit');
		$this->load_views($view_arr);
	}
	/*
	* 
	* Subtitle Group 
	* Online -> subtitle controller
	*
	*/
	function subtitle(){
		$act = $this->input->get('act');
		switch ($act) {
			case 'post_new':
				$this->subtitle_new();
				break;
			case 'post_edit':
				$this->subtitle_edit();
				break;
			case 'go_back':
				$this->subtitle_list();
				break;
			default:
				$this->subtitle_list();
				break;
		}
	}
	//
	function subtitle_list(){
		$tables = array('subtitle');
		$num = 3;
		$url = 'index.php/user?manage=subtitle';
		$start = $this->input->get('page');
		$session = $this->sess_data;
		$cond = array('uid'=>$session['uid']);
		$total= $this->user_m->subtitle_count($tables,$cond);
		//$arr = $this->user_m->torrent_list($tables,$cond,$num,$start);
		//$posts = $this->multi_tables_sort($arr,'time');
		$posts = $this->user_m->subtitle_list($tables,$cond,$num,$start);
		$data['posts'] = $posts;
		$data['total'] = $total;
		$data['paging'] = $this->paging($num,$url,$total);
		$view_arr = array('user/usr_subtitle_menu','user/usr_subtitle');
		$this->load_views($view_arr,$data);
	}
	//
	function delete_subtitle_file($filepath){
		if(empty($filepath)){
			return false;
		}		
		$arr = explode('/', $filepath);
		$sub_dir = $arr['2'];
		$this->load->helper('file');
		$test = delete_files('./data/subtitle/'.$sub_dir,true); // delete uploaded torrent file
		rmdir('./data/subtitle/'.$sub_dir); // remove current directory
	}
	//
	function delete_subtitle(){
		$session = $this->sess_data;
		$table = 'subtitle';
		$subtitle_id = $this->input->post('subtitle');
		$cond = array('uid'=>$session['uid'],'subtitle_id'=>$subtitle_id);
		$field = 'filepath';
		$filepath = $this->user_m->get_specify($table, $field, $cond);
		$this->delete_subtitle_file($filepath['0']['filepath']);
		$result = $this->user_m->delete_subtitle($table, $cond);
		if($result==1){
			echo 'true';
		}else{
			echo 'false';
		}
	}	
	//
	function subtitle_new(){
		$view_arr = array('user/usr_subtitle_menu','user/usr_subtitle_edit');
		$this->load_views($view_arr);
	}
	//
	function subtitle_edit(){
		$view_arr = array('user/usr_subtitle_menu','user/usr_subtitle_edit');
		$this->load_views($view_arr);
	}
	//
	// general info controller
	//
	function general_info(){
		$view_arr = array('user/usr_general_info');
		$this->load_views($view_arr);
	}
	// blog controller
	function post(){
		$action = $this->input->get('action');
		$id = $this->input->get('id');
		switch ($action) {
			case 'post_list':
				$this->post_list();
				break;
			case 'post_new':
				$this->post_new();
				break;
			case 'post_edit':
				$this->post_edit($id);
				break;
			case 'user_info':
				$this->user_info();
				break;
			default:
				$this->post_list();
				break;
		}
		$view_arr = array('front/footer');
		$this->load_views($view_arr);
	}
	//
	function post_list(){
		$this->load_views('front/usr_post');
	}
	//
	function post_new(){
		$this->load_views('front/usr_post_edit');
	}
	//
	function post_edit($id){
		$data['id']=$id;
		$this->load_views('front/usr_post_edit',$data);
	}
	// check the post before insert into database
	function post_check(){
		//
	}
	// insert post to database
	function submit_post(){
		//
		$table = $this->input->post('category');
		//echo '<script>alert("'.$table.'")</script>';
		if( isset($table) ){
			$session = $this->sess_data;
			$data = $this->input->post();
			$filepath = $this->input->post('filepath');
			//unset($data['table']);
			$encode = mb_detect_encoding($filepath, array("ASCII",'UTF-8',"GB2312","GBK",'BIG5'));
			if($encode == 'UTF-8'){
				$temp = iconv('utf-8','gbk',$filepath);
			}else{
				$temp = $filepath;
			}
			$data['md5'] = md5_file($temp);
			$data['uid'] = $session['uid'];
			if($table == 'subtitle'){
				$status = $this->user_m->insert($table,$data);
			}else{
				$status = $this->user_m->insert($table.'_torrent',$data);
			}
			echo json_encode($data);
		}else{
			$data = $this->input->post();
			echo json_encode($data);
		}
	}
	// quality match
	function quality_match($str){
		$quality = array('DVDSCR','DVD','HDRip','HDTV','WEB','BRRip;BRrip;BluRay','BDRip','720p;1080p');
		for($i=0;$i<count($quality);$i++){
			$arr = explode(';', $quality[$i]);
			for($j=0;$j<count($arr);$j++){
				if(stripos($str, $arr[$j])){
					return $result = $arr[$j];
				}
			}
		}
		return "Unknown";
	}
	// move to movie control page get all files into a string from a torrent file
	function torrent_files_array($filepath){
		$files_arr = '';
		require_once('./plugins/bittorrent/Decode.php');
		$Torrent_Decode = new File_Bittorrent2_Decode;
		//$filepath = './data/torrent/1420772477/Stonehearst_Asylum_2014_720p.torrent';
		$info = $Torrent_Decode->decodeFile($filepath);
		$files = $info['files'];
		for ($i=0; $i < count($files); $i++) {
			$files_arr .= ($files[$i]['filename'].':'.$this->file_size_format($files[$i]['size']).';');
		}
		return $files_arr;
	}
	// get the total number of files in a torrent 
	function torrent_file_count($filepath){
		require_once('./plugins/bittorrent/Decode.php');
		$Torrent_Decode = new File_Bittorrent2_Decode;
		//$filepath = './data/torrent/1420772477/Stonehearst_Asylum_2014_720p.torrent';
		$info = $Torrent_Decode->decodeFile($filepath);
		return count($info['files']);
	}
	// # Test torrent parsing method
	function torrent(){
		require_once('./plugins/bittorrent/Decode.php');
		$Torrent_Decode = new File_Bittorrent2_Decode;
		$filepath = './data/torrent/1420772477/Stonehearst_Asylum_2014_720p.torrent';
		$info = $Torrent_Decode->decodeFile($filepath);
		echo count($info['files']);
		echo '<pre>';
		print_r($info);
		echo '</pre>';
	}
	// check whether file is broken or not
	function torrent_valid_check($filepath){
		require_once('./plugins/bittorrent/Decode.php');
		$Torrent_Decode = new File_Bittorrent2_Decode;
		try{
			return $info = $Torrent_Decode->decodeFile($filepath);
		}
		catch(Exception $e){
			return false;
		}
	}
	// # Test function of file parsing
	function valid_check(){
		$check = $this->torrent_valid_check();
		if($check){
			echo 'Right';
		}else{
			echo 'File error';
		}
	}
	// show information of torrent file
	function torrent_file_size($filepath){
		//
		//$filepath = './data/torrent/1420772477/Stonehearst_Asylum_2014__720p.torrent';
		require_once('./plugins/bittorrent/Decode.php');
		$Torrent_Decode = new File_Bittorrent2_Decode;
		$info = $Torrent_Decode->decodeFile($filepath); // './data/torrent/1420772477/Stonehearst_Asylum_2014__720p.torrent'
		return $this->file_size_format($info['size']);
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
	//
	function upload_error($sub_dir,$error){
		//
		$this->load->helper('file');
		$test = delete_files('./data/torrent/'.$sub_dir,true); // delete uploaded torrent file
		rmdir('./data/torrent/'.$sub_dir); // remove current directory
		echo '<script>window.parent.FileError("'.$error.'");</script>';
	}
	// check whether file exists or not
	function file_md5_check($tables,$dir){
		//
		$md_val = md5_file($dir);
		return $this->user_m->file_md5_check($tables,$md_val);
	}
	//
	function encoding_process($filepath){
		$encode = mb_detect_encoding($filepath, array("ASCII",'UTF-8',"GB2312","GBK",'BIG5'));
		$final_path = iconv($encode, 'UTF-8', $filepath);
		return $final_path;
	}
	// upload torrent file
	function upload_torrent(){
		// torrent file uploading process
		$data = $this->load_language();
		$file = $_FILES["attachment"]; //$file infomation
		$tables = array('tv_torrent','movie_torrent','book_torrent','video_torrent');
		//$tables = 'torrent';
		if( !empty($file) ){
	        $error = $file["error"];
	        $sub_dir= time();
	        $target_dir = 'data/torrent/'.$sub_dir.'/';
	        // upload status check
	        if( $error == 0 ){
	            if( $file['size'] < 2097152 ){ // check file size shall less than 2MB 2097152
		            $filename = $file['name'];
		            $reg = '#(torrent)$#';
		            $ext_check = preg_match($reg,$filename)?1:0;
		            // Check if file extension is '.torrent'
		            if($ext_check){
			            if(!is_dir($target_dir)){
			            	mkdir($target_dir,0777,true);
			            }
			            $final_path = $target_dir.md5($file["name"]).'.torrent';
			            //$final_path = $this->encoding_process($original_path);
			            $move_result = move_uploaded_file($file["tmp_name"],$final_path);
			            $hash_check = $this->file_md5_check($tables,$final_path);
			            $file_valid_result = $this->torrent_valid_check($final_path);
			            // check if file already exsit or not 
			            if( $file_valid_result ){
			            	if( !$hash_check ){
					            $temp = $file;
					            $temp['name'] = $this->encoding_process($file["name"]); //remove ".torrent" extension
					            $temp['result'] = $move_result;
					            $temp['filepath'] = $final_path;
					            $temp['file_size'] = $this->torrent_file_size($final_path);
					            $temp['file_count'] = $this->torrent_file_count($final_path);
					            $temp['delete_link'] = $sub_dir;
					            $temp['ext'] = 'torrent';
					            $temp['year'] = $target_dir;
					            $temp['final_file'] = md5_file($final_path);
					            $temp['quality'] = $this->quality_match($temp['name']);
					            $status = json_encode($temp);
					            //echo '<script>alert("'.$temp['name'].'");</script>';
					            echo '<script>window.parent.CallbackFunction('.$status.');</script>';
				        	}else{
				        		$this->upload_error($sub_dir, $data['file_already_exist']);
				        	}
				        }else{
			        		$this->upload_error($sub_dir, $data['file_broken']);
				        }
		        	}else{
		        		echo '<script>alert("'.$data['vs_extension_error'].'");</script>';
		        	}
		        }else{
		        	echo '<script>alert("'.$data['file_too_large'].'");</script>';
		        }
		    }else{
		        echo '<script>alert("'.$data['choose_file'].'");</script>';
		    }
    	}else{
    		echo '<script>alert("Failed");</script>';
    	}
	}
	# if user click delete button during uploading process
	function delete_temp_torrent(){
		//
		$sub_dir = $this->input->post('file_dir');
		if(empty($sub_dir)){
			return false;
		}
		$this->load->helper('file');
		$test = delete_files('./data/torrent/'.$sub_dir,true); // delete uploaded torrent file
		rmdir('./data/torrent/'.$sub_dir); // remove current directory
		if($test){
			echo 'true';
		}else{
			echo 'false';
		}
	}
	// upload subtitle file page
	// extesion check
	function sub_ext_check($filename){
		$temp = 0;
		$ext_arr = array('.srt','.ass');
		for ($i=0; $i < count($ext_arr); $i++) { 
			$reg = '#('.$ext_arr[$i].')$#';
	        $ext_check = preg_match($reg,$filename)? true:false ;
	        if($ext_check){
	        	$temp++;
	        	$extesion = $ext_arr[$i];
	        }
		}
		if( $temp < 1 ){
			return false;
		}else{
			return $extesion;
		}
	}
	//
	function subtitle_upload_error($sub_dir,$error){
		$this->load->helper('file');
		$test = delete_files('./data/subtitle/'.$sub_dir,true); // delete uploaded subtitle file
		rmdir('./data/subtitle/'.$sub_dir); // remove current directory
		echo '<script>window.parent.FileExist("'.$error.'");</script>';
	}
	// upload subtitle file
	function upload_subtitle(){
		// subtitle file uploading process
		$data = $this->load_language();
		$file = $_FILES["attachment"]; //$file infomation
		$tables = array('subtitle');
		if( !empty($file) ){
	        $error = $file["error"];
	        $sub_dir= time();
	        $target_dir = 'data/subtitle/'.$sub_dir.'/';
	        // upload status check
	        if( $error == 0 ){
	        	$filename = $file['name'];
	            $ext_check_result = $this->sub_ext_check($filename);
	            if($ext_check_result){
		            if(!is_dir($target_dir)){
		            	mkdir($target_dir,0777,true);
		            }
		            $final_path = $target_dir.md5($filename).$ext_check_result;
		            //$final_path = iconv('utf-8', 'gb2312', $final_path);
		            $move_result = move_uploaded_file($file["tmp_name"],$final_path);
		            $hash_check = $this->file_md5_check($tables,$final_path);
		            // check whether file already exsit or not 
		            if( !$hash_check ){
			            $temp = $file;
			            $temp['name'] = $this->encoding_process($filename); //remove ".srt" extension
			            $temp['result'] = $move_result;
			            $temp['filepath'] = iconv('gb2312', 'utf-8', $final_path);
			            $temp['file_size'] = $this->file_size_format($file['size']);
			            $temp['delete_link'] = $sub_dir;
			            $temp['ext'] = $ext_check_result;
			            $temp['year'] = $target_dir;
			            $temp['final_file'] = md5_file($final_path);
			            $temp['quality'] = $this->quality_match($temp['name']);
			            $status = json_encode($temp);
			            echo '<script>//alert("'.$temp['name'].'");</script>';
			            echo '<script>window.parent.CallbackFunction('.$status.');</script>';
			        }else{
			        	//
			        	$this->subtitle_upload_error($sub_dir,$data['file_already_exist']);
			        }
	        	}else{
	        		echo '<script>alert("'.$data['sub_extension_error'].'");</script>';
	        	}
	        }else{
	        	echo '<script>alert("'.$data['choose_file'].'");</script>';
	        }
    	}else{
    		echo '<script>alert("Failed");</script>';
    	}
	}
	# if user click delete button during uploading process
	function delete_temp_subtitle(){
		//
		$sub_dir = $this->input->post('file_dir');
		if(empty($sub_dir)){
			return false;
		}
		$this->load->helper('file');
		$test = delete_files('./data/subtitle/'.$sub_dir,true); // delete uploaded torrent file
		rmdir('./data/subtitle/'.$sub_dir); // remove current directory
		if($test){
			echo 'true';
		}else{
			echo 'false';
		}
	}
	// submit subtitle file
	function subtitle_submit(){
		//
		$table = 'subtitle';
		if( isset($table) ){
			$session = $this->sess_data;
			$data = $this->input->post();
			$filepath = $this->input->post('filepath');
			//unset($data['table']);
			$encode = mb_detect_encoding($filepath, array("ASCII",'UTF-8',"GB2312","GBK",'BIG5'));
			if($encode == 'UTF-8'){
				$temp = iconv('utf-8','gbk',$filepath);
			}else{
				$temp = $filepath;
			}
			$data['md5'] = md5_file($temp);
			$data['uid'] = $session['uid'];
			$status = $this->user_m->insert($table,$data);
			echo json_encode($data);
		}else{
			$data = $this->input->post();
			echo json_encode($data);
		}
	}
	// upload file into DB
	function upload_file($table,$data){
		return $this->user_m->insert($table,$data);
	}
	function test(){
		// $one = "data/one.torrent";
		// $two = "data/two.torrent";
		// $three = "data/three.torrent";
		// echo "One: ".md5_file($one)."<br>";
		// echo "Two: ".md5_file($two)."<br>";
		// echo "Three: ".md5_file($three)."<br>";
		// echo md5_file($one).md5_file($two);
		// echo time();
		// highlight_file(__FILE__);
		//echo md5_file(iconv('utf-8','gbk',"data/subtitle/1420444714/修改版.srt"));
		//file_get_contents(iconv('utf-8','gbk',"data/subtitle/1420444714/修改版.srt"));
		$keytitle = "data/subtitle/1420444714/修改版.srt";
		//$keytitle = 'data/torrent/1419760125/[kickass.so]gone.girl.2014.720p.brrip.x264.yify.torrent';
		echo $encode = mb_detect_encoding($keytitle, array("ASCII",'UTF-8',"GB2312","GBK",'BIG5'));
		echo iconv('ascii','utf-8', $keytitle);
	}
	//
	function time_select($kind){

		$now = time(); // 现在的时间值，你需要根据这个时间得到昨天结束的时间来做为初始时间
		var_dump($now);
		if($kind = 'Month'){
			// 如果是取出1个月的数据
			$period = 86400 ;  //1天对应的时间戳值
			for ($i=0; $i < 30; $i++) {   //一个月按照30天来算，循环30天
				$end = ($now - $period*($i+1)); // 取数据的时候，1天时间段对应的最大值
				$start = ($now - $period*($i)); // 取数据的时候，1天时间段对应的最小值
				$arr = array_merge(
						array(
							$this->db->select()->where('time<',$end)->where('time>',$start)->get('post')->result_array()
						)
					); // 用数组追加函数来把每天的数据追加进来，结果肯定是多维索引数组
			}
		}else if($kind == "day"){
			// 如果只去一天的话
		}
	}
}
