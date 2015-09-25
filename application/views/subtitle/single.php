<hr class="site-name-hr">
<?php //print_r($posts); ?>
<!-- <br> -->
<?php //print_r($user); ?>

<?php $info = $posts; ?>
<div class="container subtitle">
	<a name="rating-box"></a>
	<h3 style="color:rgb(255, 154, 0)"><?php echo $subtitle?></h3>
	<hr class="subtitle-hr">
	<div class="container subtitle-info">
		<span class="sub-id" style="display:none;">
			<?php echo $info['subtitle_id']; ?>
		</span>
		<div class="rating-box">
			<a href="#" class="btn btn-info up-btn glyphicon glyphicon-thumbs-up" data-rating="up"><?php echo '<br>'.$info['up']; ?></a>
			<a href="#" class="btn btn-danger down-btn glyphicon glyphicon-thumbs-down" data-rating="down"><?php echo '<br>'.$info['down']; ?></a>
		</div>
		<div class="sub-info-row title">
			<?php echo $subtitle_name.$colon.$info['title']; ?>
		</div>
		<div class="sub-info-row upload_time">
			<?php echo $upload_time.$colon.$info['time'] ?>
		</div>
		<div class="sub-info-row version">
			<?php echo $version.$colon.$$info['quality'] ?>
		</div>
		<div class="sub-info-row uploader">
			<?php echo $uploader.$colon.$user['username'] ?>		
		</div>
		<!-- anchor file details box -->
		<a name="file-details-box"></a>
		<div class="sub-info-row download-link">
			<a href="<?php echo site_url('subtitle/download_subtitle').'/'.$info['subtitle_id']?>"class="btn btn-primary download"><?php echo $download; ?></a>
		</div>
		<div class="sub-info-row download-count">
			<?php echo $download_count.$colon.$info['download'] ?>		
		</div>
		<div class="sub-info-row show-more-info">
			<a href="#" class="preview-btn"><?php echo $subtitle_preview; ?></a>
		</div>
		<!-- details of subtitle -->
		<div class="sub-info-row show-preview" style="display:none">
			<pre><?php echo $info['preview_info']; ?></pre>
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
		<input type="text" name="subtitle_id" value="<?php echo $info['subtitle_id']; ?>" style="display:none">
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
</div>
<hr class="footer-hr">
<script type="text/javascript">
	//
	$('a.preview-btn').click(function(){
		//
		if($(this).html()=='<?php echo $subtitle_preview ?>'){
			$('div.show-preview').show();
			$('a.preview-btn').html('<?php echo $hide ?>');
			return false;
		}else{
			$('div.show-preview').hide();
			$('a.preview-btn').html('<?php echo $subtitle_preview ?>');
			return false;
		}
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
		var url = '<?php echo site_url("subtitle/login_check") ?>';
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
			var url = "<?php echo site_url('subtitle/add_comment/') ?>";
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
	});
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
	});
	$('a.up-btn').click(function(){
		//
		var type = "POST";
		var url = "<?php echo site_url('subtitle/login_check') ?>";
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
			var url = '<?php echo site_url("subtitle/rating"); ?>';
			var data = "subtitle_id=<?php echo $info['subtitle_id']; ?>"+"&rating="+rate+"&url="+actionUrl+"&action_name="+"<?php echo $page_title; ?>";
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
	});
	$('a.down-btn').click(function(){
		//
		var type = "POST";
		var url = "<?php echo site_url('subtitle/login_check') ?>";
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
			var url = '<?php echo site_url("subtitle/rating"); ?>';
			var data = "subtitle_id=<?php echo $info['subtitle_id']; ?>"+"&rating="+rate+"&url="+actionUrl+"&action_name="+"<?php echo $page_title; ?>";
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
	});
</script>