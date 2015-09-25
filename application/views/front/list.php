<pre>
	<?php 
		print_r($posts);
	 ?>
</pre>
<div class="mainpart">
	<?php 
		if(isset($posts)){
			foreach ($posts as $key => $val) {
				echo '<h3 style="color:rgb(255, 154, 0)">'.$key.'</h3>';
				echo '<table class="table table-hover table-bordered table-striped">';
				echo '<tr><th> '.$t_title.' </th><th> '.$t_content.' </th><th> '.$t_category.' </th><th> '.$t_time.' </th><th> '.$t_download.' </th></tr>';
				for ($i=0; $i < count($val); $i++) { 
					echo '<tr><td>'.$val[$i]['title'].'</td>';
					echo '<td>'.$val[$i]['content'].'</td>';
					echo '<td>'.$val[$i]['category'].'</td>';
					echo '<td>'.$val[$i]['time'].'</td>';
					echo '<td>'.$val[$i]['download'].'</td></tr>';
				}
				echo '</table>';
			}
		}
		?>
		<?php if(isset($paging)){ echo $paging;}?>
</div>