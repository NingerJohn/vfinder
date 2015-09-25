<!-- <pre>
	<?php 
		//print_r($posts);
	 ?>
</pre> -->
<div class=" container mainpart">
	<h3 style="color:rgb(255, 154, 0)"><?php echo $movie?></h3>
	<table class="table table-hover table-bordered table-striped">
		<tr>
			<th><?php echo $t_title?></th>
			<th><?php echo $t_category?></th>
			<th><?php echo $t_quality?></th>
			<th><?php echo $t_time?></th>
			<th><?php echo $t_download_time?></th>
		</tr>
		<?php if(isset($posts)){ for ($i=0; $i < count($posts); $i++): ?>
			<tr>
				<td><?php echo $posts[$i]['title'];?></td>
				<td><?php echo $posts[$i]['category'];?></td>
				<td><?php echo $posts[$i]['quality'];?></td>
				<td><?php echo $posts[$i]['time'];?></td>
				<td><?php echo $posts[$i]['download'];?></td>
			</tr>
		<?php endfor;} ?>
	</table>
	<?php if(isset($paging)){ echo $paging;}?>
</div>