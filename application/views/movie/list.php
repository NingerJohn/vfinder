<!-- <pre>
	<?php 
		//print_r($posts);
	 ?>
</pre> -->
<hr>
<div class=" container mainpart">
	<span class="title" style="color:rgb(255, 154, 0)"><?php echo $movie?></span>
	<span class="download-btn">
		<a href="<?php echo site_url('/user?manage=vshare&act=post_new'); ?>" class="btn btn-primary"><?php echo $upload_file; ?></a>
	</span>
	<table class="table table-hover table-bordered table-striped movie-list">
		<tr>
			<th><?php echo $t_title?></th>
			<th><?php echo $t_size?></th>
			<th><?php echo $t_file_count?></th>
			<th><?php echo $t_quality?></th>
			<th><?php echo $t_time?></th>
			<th><?php echo $t_download_time?></th>
		</tr>
		<?php if(isset($posts)){ for ($i=0; $i < count($posts); $i++): ?>
		<tr>
			<td>
				<a href="<?php echo base_url('index.php/movie/id/'.$posts[$i]['torrent_id']); ?>">
					<?php 
						$tv_name = $posts[$i]['title']; 
						$length = strlen($tv_name);
						$show_length = 70;
						if($length > $show_length ){ 
							echo substr($tv_name, 0, $show_length).'....';
						}else{
							echo $tv_name;
						}
					?>
				</a>
			</td>
			<td><?php echo $posts[$i]['file_size'];?></td>
			<td><?php echo $posts[$i]['file_count'];?></td>
			<td><?php echo $posts[$i]['quality'];?></td>
			<td><?php echo date('Y-m-d',strtotime($posts[$i]['time']));//echo (floor(time()/86400)-floor(strtotime($posts[$i]['time'])/86400));?></td>
			<td><?php echo $posts[$i]['download'];?></td>
		</tr>
		<?php endfor;} ?>
	</table>
	<?php if(isset($paging)){ echo $paging;}?>
</div>