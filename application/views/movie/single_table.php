
<hr>
<?php print_r($posts); ?>
<br>
<?php print_r($user); ?>

<?php $info = $posts; ?>
<div class="container subtitle">
	<h3 style="color:rgb(255, 154, 0)"><?php echo $movie?></h3>
	<table class="table">
		<tr>
			<td class="poster" rowspan="7"><img src="<?php echo $info['post_link']; ?>"></td>
			<td><?php echo $title.$colon.$info['title']; ?></td>
		</tr>
		<tr>
			<td>
				<?php echo $reference_link.$colon; ?>
				<a href="<?php echo 'http://movie.mtime.com/'.$info['mtime_link'].'/' ?>" target="blank">
					<?php echo $mtime ?>
				</a>
			</td>
		</tr>
		<tr>
			<td><?php echo $upload_time.$colon.$info['time'] ?></td>
		</tr>
		<tr>
			<td><?php echo $uploader.$colon.$user['username'] ?></td>
		</tr>
		<tr>
			<td><?php echo $version.$colon.$info['quality'] ?></td>
		</tr>
		<tr>
			<td><a href="<?php echo site_url('movie/download_torrent').'/'.$info['torrent_id']?>"class="btn btn-primary download"><?php echo $download; ?></a></td>
		</tr>
		<tr>
			<td><?php echo $download_count.$colon.$info['download'] ?></td>
		</tr>
	</table>
</div>
<hr>
<script type="text/javascript">
	//
</script>