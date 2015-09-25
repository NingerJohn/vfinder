<div class="container center">

<!-- movie -->
	<?php if(!empty($movie_posts)){  ?>
	<h3 style="color:rgb(255, 154, 0)"><a href="<?php echo site_url('movie'); ?>"><?php echo $movie; ?></a></h3>
	<table class="table table-hover table-bordered table-striped movie">
		<tr>
			<th><?php echo $t_title?></th>
			<th><?php echo $t_size?></th>
			<th><?php echo $t_file_count ?></th>
			<th><?php echo $t_quality?></th>
			<th><?php echo $t_time?></th>
			<th><?php echo $t_download_time?></th>
		</tr>
	<?php foreach($movie_posts as $val): ?>
		<tr>
			<td>
				<a href="<?php echo base_url('index.php/movie/id/'.$val['torrent_id']); ?>">
					<?php 
						$tv_name = $val['title']; 
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
			<td><?php echo $val['file_size'];?></td>
			<td><?php echo $val['file_count'];?></td>
			<td><?php echo $val['quality'];?></td>
			<td><?php echo date('Y-m-d',strtotime($val['time']));//echo (floor(time()/86400)-floor(strtotime($val['time'])/86400));?></td>
			<td><?php echo $val['download'];?></td>
		</tr>
	<?php endforeach; ?>
	</table>
	<?php } ?>

<!-- tv -->
	<?php if(!empty($tv_posts)){  ?>
	<h3 style="color:rgb(255, 154, 0)"><a href="<?php echo site_url('tv'); ?>"><?php echo $tv; ?></a></h3>
	<table class="table table-hover table-bordered table-striped tv">
		<tr>
			<th><?php echo $t_title?></th>
			<th><?php echo $t_size?></th>
			<th><?php echo $t_file_count ?></th>
			<th><?php echo $t_quality?></th>
			<th><?php echo $t_time?></th>
			<th><?php echo $t_download_time?></th>
		</tr>
	<?php foreach($tv_posts as $val): ?>
		<tr>
			<td>
				<a href="<?php echo base_url('index.php/tv/id/'.$val['torrent_id']); ?>">
					<?php 
						$tv_name = $val['title']; 
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
			<td><?php echo $val['file_size'];?></td>
			<td><?php echo $val['file_count'];?></td>
			<td><?php echo $val['quality'];?></td>
			<td><?php echo date('Y-m-d',strtotime($val['time']));//echo (floor(time()/86400)-floor(strtotime($val['time'])/86400));?></td>
			<td><?php echo $val['download'];?></td>
		</tr>
	<?php endforeach; ?>
	</table>
	<?php } ?>

<!-- subtitle -->
	<?php if(!empty($subtitle_posts)){  ?>
	<h3 style="color:rgb(255, 154, 0)"><a href="<?php echo site_url('subtitle'); ?>"><?php echo $subtitle; ?></a></h3>
	<table class="table table-hover table-bordered table-striped subtitle">
		<tr>
			<th><?php echo $t_title?></th>
			<th><?php echo $t_size?></th>
		<!-- 	<th><?php //echo $t_category?></th> -->
			<th><?php echo $t_quality?></th>
			<th><?php echo $t_time?></th>
			<th><?php echo $t_download_time?></th>
		</tr>
	<?php foreach($subtitle_posts as $val): ?>
		<tr>
			<td>
				<a href="<?php echo base_url('index.php/subtitle/id/'.$val['subtitle_id']); ?>">
					<?php 
						$tv_name = $val['title']; 
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
			<td><?php echo $val['file_size'];?></td>
			<td><?php echo $val['quality'];?></td>
			<td><?php echo date('Y-m-d',strtotime($val['time']));//echo (floor(time()/86400)-floor(strtotime($val['time'])/86400));?></td>
			<td><?php echo $val['download'];?></td>
		</tr>
	<?php endforeach; ?>
	</table>
	<?php } ?>

<!-- book -->
	<?php if(!empty($book_posts)){  ?>
	<h3 style="color:rgb(255, 154, 0)"><a href="<?php echo site_url('book'); ?>"><?php echo $book; ?></a></h3>
	<table class="table table-hover table-bordered table-striped book">
		<tr>
			<th><?php echo $t_title?></th>
			<th><?php echo $t_size ?></th>
			<th><?php echo $t_file_count ?></th>
			<th><?php echo $t_time?></th>
			<th><?php echo $t_download_time?></th>
		</tr>
	<?php foreach($book_posts as $val): ?>
		<tr>
			<td>
				<a href="<?php echo base_url('index.php/book/id/'.$val['torrent_id']); ?>">
					<?php 
						$tv_name = $val['title']; 
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
			<td><?php echo $val['file_size'];?></td>
			<td><?php echo $val['file_count'];?></td>
			<td><?php echo date('Y-m-d',strtotime($val['time']));//echo (floor(time()/86400)-floor(strtotime($val['time'])/86400));?></td>
			<td><?php echo $val['download'];?></td>
		</tr>
	<?php endforeach; ?>
	</table>
	<?php } ?>

<!-- video -->
	<?php if(!empty($video_posts)){  ?>
	<h3 style="color:rgb(255, 154, 0)"><a href="<?php echo site_url('video'); ?>"><?php echo $video; ?></a></h3>
	<table class="table table-hover table-bordered table-striped video">
		<tr>
			<th><?php echo $t_title?></th>
			<th><?php echo $t_size ?></th>
			<th><?php echo $t_file_count ?></th>
			<th><?php echo $t_time?></th>
			<th><?php echo $t_download_time?></th>
		</tr>
	<?php foreach($video_posts as $val): ?>
		<tr>
			<td>
				<a href="<?php echo base_url('index.php/video/id/'.$val['torrent_id']); ?>">
					<?php 
						$tv_name = $val['title']; 
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
			<td><?php echo $val['file_size'];?></td>
			<td><?php echo $val['file_count'];?></td>
			<td><?php echo date('Y-m-d',strtotime($val['time']));//echo (floor(time()/86400)-floor(strtotime($val['time'])/86400));?></td>
			<td><?php echo $val['download'];?></td>
		</tr>
	<?php endforeach; ?>
	</table>
	<?php } ?>

</div>
	


