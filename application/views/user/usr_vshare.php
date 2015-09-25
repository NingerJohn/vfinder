<!-- <pre>
<?php 
//print_r($posts); 
//echo count($posts); 
//echo $posts; 
?>
</pre> -->
<div class="container vshare">

	<div class="shortcut">
		<a href="<?=base_url('index.php/user?manage=vshare&act=post_new')?>"  class="btn btn-primary"><?php echo $upload_file; ?></a>
		<!-- <a href="<?=base_url('index.php/user?manage=vshare&act=post_edit&id=12345')?>" class="btn btn-primary">post_edit</a> -->
	</div>
<hr/>
<div class="container summary-info">
	<?php echo $upload_torrent_count.$colon.$total; ?>
</div>
	<div class="container vshare-list">
		<?php if(count($posts)==0){
			echo $have_not_upload_file;
			}else{
		?>
		<table class="table table-bordered vshare-list">
			<tr>
				<th colspan="6"><?php echo $vshare_list;?></th>
			</tr>
			<tr class="table-title">
				<!-- <td><?php echo $sequence;?></td> -->
				<td><?php echo $t_title;?></td>
				<td><?php echo $t_upload_time;?></td>
				<td><?php echo $t_category;?></td>
				<td><?php echo $t_edit;?></td>
				<td><?php echo $t_download_time;?></td>
			</tr>
			<?php 
				$a = $this->input->get('page');
				if(!($a)){ $a = 0;}
				foreach( $posts as $key => $val ):
			?>
				<tr>
					<!-- <td><?php echo (++$a); ?></td> -->
					<td>
						<?php 
							$tv_name = $val['title']; 
							$length = strlen($tv_name);
							$show_length = 80;
							if($length > $show_length ){ 
								echo substr($tv_name, 0, $show_length).'....';
							}else{
								echo $tv_name;
							}
						?>
					</td>
					<td><?php echo date('Y-m-d',strtotime($val['time'])); ?></td>
					<td><?php echo $$val['category']; ?></td>
					<td>
						<a data-table="<?php echo substr($key,0,-2); ?>" data-torrent="<?php echo $val['torrent_id']; ?>" href="<?php echo site_url( 'user/delete_torrent?' ); ?>" class="torrent-delete-btn" >
							<?php echo $delete ?>
						</a>
					</td>
					<td><?php echo $val['download']; ?></td>
				</tr>
			<?php endforeach; ?>
		</table>
		<?php echo $paging;?>
		<?php } ?>
	</div>
</div>
<script type="text/javascript">
$('a.torrent-delete-btn').click(function(){
	var type = "POST";
	var url = $(this).attr('href');
	var data = 'table='+$(this).data('table')+"&torrent="+$(this).data('torrent');
	//alert(url);
	//alert($(this).data('table'));
	//alert($(this).data('torrent'));
	//return false;
	var success = function(data){
		//
		if(data=='true'){
			//
			alert('<?php echo $delete_success ?>');
		}else{
			//
			alert('<?php echo $delete_fail ?>');
		}
	}
	var fail = function(data){
		//
		alert(data);
	}
	if(confirm("<?php echo $delete_confirm; ?>")){
       remoteProcess(type, url, data, success,fail);
       window.location.reload();
       return false;
   }
	return false;
});

</script>