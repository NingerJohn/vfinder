<div class="container leftbox">
	<h3 style="color:rgb(255, 154, 0)"><?php echo $movie?></h3>
	<table class="table table-hover table-bordered table-striped">

		<tr>
			<th><?php echo $t_title?></th>
			<th><?php echo $t_category?></th>
			<th><?php echo $t_quality?></th>
			<th><?php echo $t_time?></th>
			<th><?php echo $t_download_time?></th>
		</tr>
		<?php foreach($posts as $key=>$val ){ for ($i=0; $i < count($val); $i++): ?>
			<tr>
				<td><?php echo $val[$i]['title'];?></td>
				<td><?php echo $val[$i]['category'];?></td>
				<td><?php echo $val[$i]['quality'];?></td>
				<td><?php echo $val[$i]['time'];?></td>
				<td><?php echo $val[$i]['download'];?></td>
			</tr>
		<?php endfor;} ?>
	</table>
	<?php if(isset($paging)){ echo $paging;}?>

</div>
	
<div class="container rightbox">
		Rightbox
</div>