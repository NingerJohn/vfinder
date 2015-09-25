
<hr class="site-name-hr">
<!--  <pre>
<?php //print_r($posts); ?>
	
</pre> -->
<?php //print_r($user); ?>

<?php $info = $posts; ?>
<div class="container video">
	<a name="rating-box"></a>
	<h3 style="color:rgb(255, 154, 0)"><?php echo $video?></h3>
	<hr class="video-title-hr">
	<div class="container video-info">
		<span class="sub-id" style="display:none;">
			<?php echo $info['torrent_id']; ?>
		</span>
		<div class="rating-box">
			<a href="#" class="btn btn-info up-btn glyphicon glyphicon-thumbs-up" data-rating="up"><?php echo '<br>'.$info['up']; ?></a>
			<a href="#" class="btn btn-danger down-btn glyphicon glyphicon-thumbs-down" data-rating="down"><?php echo '<br>'.$info['down']; ?></a>
		</div>
		<div class="sub-info-row title">
			<?php echo $video_name.$colon.$info['title']; ?>
		</div>
		<div class="sub-info-row upload_time">
			<?php echo $upload_time.$colon.$info['time']; ?>
		</div>
		<div class="sub-info-row version">
			<?php echo $version.$colon.$info['quality']; ?>
		</div>
		<div class="sub-info-row uploader">
			<?php echo $uploader.$colon.$user['username']; ?>		
		</div>
		<!-- anchor file details box -->
		<a name="file-details-box"></a>
		<div class="sub-info-row download-link">
			<a href="<?php echo site_url('video/download_torrent').'/'.$info['torrent_id']?>"class="btn btn-primary download"><?php echo $download; ?></a>
		</div>
		<div class="sub-info-row download-count">
			<?php echo $download_count.$colon.$info['download'] ?>		
		</div>
		<div class="torrent-details" style="display:block">
			<div class="file-details">
				<div class="torrent-title">
					<span class="glyphicon glyphicon-folder-close folder-icon"></span>
					<a href="" class="preview-btn"> <?php echo $info['title']; ?></a>
				</div>
				<div class="torrent-files-list" style="display:none">
					<font color="#428BCA">
					<?php 
						$list = $info['preview_info']; 
						//print_r($list);
						if(!empty($list)){
							arsort($list);
							foreach ($list as $firstkey => $firstvalue) {
								if (is_array($firstvalue)) {
									//
									asort($firstvalue);
									echo '<div class="first-dir-box"><span class="glyphicon glyphicon-folder-close folder-icon"></span><a href="" class="first-dir-title"> '.$firstkey.'</a></div><div class="first-subsidiary-box" style="display:none">';
									//
									foreach ($firstvalue as $secondkey => $secondvalue) {
										if (is_array($secondvalue)) {
											//
											asort($secondvalue);
											echo '<div class="second-dir-box"><span class="glyphicon glyphicon-folder-close folder-icon"></span><a href="" class="second-dir-title"> '.$secondkey.'</a></div><div class="second-subsidiary-box" style="display:none">';
											foreach ($secondvalue as $thirdkey => $thirdvalue) {
												if (is_array($thirdvalue)) {
													asort($thirdvalue);
													echo '<div class="third-dir-box"><span class="glyphicon glyphicon-folder-close folder-icon"></span><a href="" class="third-dir-title"> '.$thirdkey.'</a></div><div class="third-subsidiary-box" style="display:none">';
													foreach ($thirdvalue as $fourthkey => $fourthvalue) {
														//
														echo '<div class="single-file"><table class="table single-file">';
														$arr = explode(':', str_replace(';', '', $fourthvalue));
														echo '<tr><td>'.$arr['0'].'</td><td>'.$arr['1'].'</td></tr>';
														echo '</table></div>';
													}
													echo '</div>';
												}else{
													//
													echo '<div class="single-file"><table class="table single-file">';
													$arr = explode(':', str_replace(';', '', $thirdvalue));
													echo '<tr><td>'.$arr['0'].'</td><td>'.$arr['1'].'</td></tr>';
													echo '</table></div>';
												}
											}
											echo '</div>';
										}else{
											//
											echo '<div class="single-file"><table class="table single-file">';
											$arr = explode(':', str_replace(';', '', $secondvalue));
											echo '<tr><td>'.$arr['0'].'</td><td>'.$arr['1'].'</td></tr>';
											echo '</table></div>';
										}
									}
									echo '</div>';
								}else{
									//
									if (gettype($firstkey)=='string') {
										echo '<div class="first-dir-box"><span class="glyphicon glyphicon-folder-close folder-icon"></span><a href="" class="first-dir-title"> '.$firstkey.'</a></div><div class="first-subsidiary-box" style="display:none">';
											echo '<div class="single-file"><table class="table single-file">';
											$arr = explode(':', str_replace(';', '', $firstvalue));
											echo '<tr><td>'.$arr['0'].'</td><td>'.$arr['1'].'</td></tr>';
											echo '</table></div>';
										echo '</div>';
									}else{
										echo '<div class="single-file"><table class="table single-file">';
										$arr = explode(':', str_replace(';', '', $firstvalue));
										echo '<tr><td>'.$arr['0'].'</td><td>'.$arr['1'].'</td></tr>';
										echo '</table></div>';
									}
								}
							}
						}else{
							echo $empty_file;
						}
					?>
					</font>					
				</div>

			</div>
		</div>
	</div>
</div>
<a name="comment-box"></a>
<hr>
<!--  -->
<div class="container comment" name="comment">
	<div class="comment-title">
		<?php echo $add_comment; ?>
	</div>
	<form action="#">
		<input type="text" name="torrent_id" value="<?php echo $info['torrent_id']; ?>" style="display:none">
		<p><textarea name="content" class="content form-control" placeholder="<?php echo $add_comment; ?>"></textarea></p>
		<p><input type="submit" class="btn btn-primary add-comment-btn" value="<?php echo $comment_btn;?>"></p>
	</form>
</div>
<hr>
<div class="container comment-list">
		<?php
			//echo '<pre>';
			//print_r($comment);
			//echo '</pre>';
			if (count($comment)==0) {
				echo '<div class="zero-comment">';
				echo $zero_comment;
				echo '</div>';
			}else{
				foreach ($comment as $onekey => $onevalue) {
					//
					if (gettype($onekey)=='integer') {
						echo '<div class="single-comment">';
						//
						echo '<div class="comment-title">';
						echo '<span class="comment-username">'.$onevalue['username'].'</span> ';
						echo '<span class="comment-time">'.$onevalue['time'].'</span>';
						echo '</div>';
						//
						echo '<div class="comment-content">'.$onevalue['content'].'</div>';
						//
						echo '<div class="reply-comment-box">';
						echo '<div class="reply-comment-btn"><button class="btn btn-primary comment-control-btn">'.$reply.'</button></div>';
						echo '</div>';
						//
						echo '<form action="" class="reply-comment-form" style="display:none">';
						echo '<input type="text" name="torrent_id" value="'.$info['torrent_id'].'" style="display:none">';
						echo '<input type="text" name="at" value="'.$onevalue['comment_id'].'" style="display:none">';
						echo '<p><textarea name="content" class="content form-control" placeholder="Add_Comment"></textarea></p>';
			echo '<p><input type="submit" class="btn btn-primary add-comment-btn" value="'.$reply.'"></p>';
						echo '</form>';
						echo '</div>';
					}else{
						foreach ($onevalue as $twokey => $twovalue) {
							echo '<div class="single-child-comment">';
							//
							echo '<div class="comment-title">';
							echo '<span class="comment-username">'.$twovalue['username'].'</span> ';
							echo '<span class="comment-time">'.$twovalue['time'].'</span>';
							echo '</div>';
							//
							echo '<div class="comment-content">'.$twovalue['content'].'</div>';
							//
							echo '<div class="reply-comment-box">';
							echo '<div class="reply-comment-btn"><button class="btn btn-primary comment-control-btn">'.$reply.'</button></div>';
							echo '</div>';
							//
							echo '<form action="" class="reply-comment-form" style="display:none">';
							echo '<input type="text" name="torrent_id" value="'.$info['torrent_id'].'" style="display:none">';
							echo '<input type="text" name="at" value="'.$twovalue['comment_id'].'" style="display:none">';
							echo '<p><textarea name="content" class="content form-control" placeholder="Add_Comment"></textarea></p>';
							echo '<p><input type="submit" class="btn btn-primary add-comment-btn" value="'.$reply.'"></p>';
							echo '</form>';
							echo '</div>';
						}
					}
				}
			}
		?>
</div>
<!--  -->
<hr>
<script type="text/javascript">
	//
	$('a.preview-btn').click(function(){
		//
		var obj = $('div.torrent-files-list');
		var status = obj.css('display');
		if(status=='block'){
			obj.css('display','none');
			$(this).prev().attr('class','glyphicon glyphicon-folder-close folder-icon');
		}else{
			$(this).prev().attr('class','glyphicon glyphicon-folder-open folder-icon');
			obj.css('display','block');
		}
		return false;
	});
	$('a.first-dir-title').click(function(){
		var obj = $(this).parent().next();
		var status = obj.css('display');
		if(status=='block'){
			obj.css('display','none');
			$(this).prev().attr('class','glyphicon glyphicon-folder-close folder-icon');
		}else{
			$(this).prev().attr('class','glyphicon glyphicon-folder-open folder-icon');
			obj.css('display','block');
		}
		return false;
	});
	$('a.second-dir-title').click(function(){
		var obj = $(this).parent().next();
		var status = obj.css('display');
		if(status=='block'){
			obj.css('display','none');
			$(this).prev().attr('class','glyphicon glyphicon-folder-close folder-icon');
		}else{
			$(this).prev().attr('class','glyphicon glyphicon-folder-open folder-icon');
			obj.css('display','block');
		}
		return false;
	});
	$('a.third-dir-title').click(function(){
		var obj = $(this).parent().next();
		var status = obj.css('display');
		if(status=='block'){
			obj.css('display','none');
			$(this).prev().attr('class','glyphicon glyphicon-folder-close folder-icon');
		}else{
			$(this).prev().attr('class','glyphicon glyphicon-folder-open folder-icon');
			obj.css('display','block');
		}
		return false;
	});
	$('input.add-comment-btn').click(function(){
		//
		var val = $(this).parent('p').prev('p').children().val();
		if(val==''){
			alert('<?php echo $can_not_empty; ?>');
			return false;
		}
		//alert($(this).parents('form').serialize());
		//return false;
		var type = 'post';
		//Needs to be modified
		var url = '<?php echo site_url("video/login_check") ?>';
		var success = function(msg){
			if (msg != 'true') {
				alert('<?php echo $please_login ?>');
				return status = 'false';
			}else{
				return status = 'true';
			}
		}
		var status = loginCheck(type, url, success);
		if(status=='true'){
			var type = "POST";
			//Needs to be modified
			var url = "<?php echo site_url('video/add_comment/') ?>";
			var data = $(this).parents('form').serialize();
			//alert(data);
			var success = function(msg){
				//
				if(msg=='true'){
					alert('<?php echo $comment_success; ?>');
					window.location.reload();
				}else{
					alert('<?php echo $comment_fail; ?>');
				}
			}
			remoteProcess(type, url, data, success, null);
			return false;
		}else{
			alert('false');
			return false;
		}
	})
	$('button.comment-control-btn').click(function(){
		//
		var obj = $(this).parents('.reply-comment-box').next();
		if (obj.css('display')==='none') {
			$(this).text('<?php echo $close; ?>');
			obj.css('display','block');
		}else{
			$(this).text('<?php echo $reply; ?>');
			obj.css('display','none');
		}
	})
	$('a.up-btn').click(function(){
		//
		var type = "POST";
		var url = "<?php echo site_url('video/login_check') ?>";
		var success = function(data){
			//
			if (data !== 'true') {
				alert('<?php echo $please_login ?>');
				return status = 'false';
			}else{
				return status = 'true';
			}
		}
		var result = loginCheck(type, url, success);
		if (result === "true") {
			var rate = $(this).data('rating');
			var actionUrl = "<?php echo 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']; ?>";
			//alert(rate);
			var type = 'POST';
			var url = '<?php echo site_url("video/rating"); ?>';
			var data = "torrent_id=<?php echo $info['torrent_id']; ?>"+"&rating="+rate+"&url="+actionUrl+"&action_name="+"<?php echo $page_title; ?>";
			var success = function(msg){
				//
				if (msg==='true') {
					alert('<?php echo $rating_success; ?>');
				}else{
					alert('<?php echo $rating_fail; ?>');
				}
			};
			//alert(data);
			remoteProcess(type,url,data,success,null);
		};
		return false;
	})
	$('a.down-btn').click(function(){
		//
		var type = "POST";
		var url = "<?php echo site_url('video/login_check') ?>";
		var success = function(data){
			//
			if (data !== 'true') {
				alert('<?php echo $please_login ?>');
				return status = 'false';
			}else{
				return status = 'true';
			}
		}
		var result = loginCheck(type, url, success);
		//alert(result);
		//console.log(result);
		if (result === "true") {
			var rate = $(this).data('rating');
			var actionUrl = "<?php echo 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']; ?>";
			//alert(rate);
			var type = 'POST';
			var url = '<?php echo site_url("video/rating"); ?>';
			var data = "torrent_id=<?php echo $info['torrent_id']; ?>"+"&rating="+rate+"&url="+actionUrl+"&action_name="+"<?php echo $page_title; ?>";
			var success = function(msg){
				//
				if (msg==='true') {
					alert('<?php echo $rating_success; ?>');
				}else{
					alert('<?php echo $rating_fail; ?>');
				}
			};
			//alert(data);
			remoteProcess(type,url,data,success,null);
		};
		return false;
	})
</script>