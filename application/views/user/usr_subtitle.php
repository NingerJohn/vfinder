<!-- <pre>
<?php 
print_r($posts); 
//echo count($posts); 
//echo $posts; 
?>
</pre> -->

<div class="container subtitle">

	<div class="shortcut">
		<a href="<?=base_url('index.php/user?manage=subtitle&act=post_new')?>"  class="btn btn-primary"><?php echo $upload_subtitle; ?></a>
		<!-- <a href="<?=base_url('index.php/user?manage=vshare&act=post_edit&id=12345')?>" class="btn btn-primary">post_edit</a> -->
	</div>
<hr/>
<div class="container summary-info">
	<?php echo $upload_subtitle_count.$colon.$total; ?>
</div>
	<div class="container subtitle-list">
		<?php if(count($posts)==0){
			echo $have_not_upload_file;
			}else{
		?>
		<table class="table table-bordered subtitle-list">
			<tr>
				<th colspan="6"><?php echo $vshare_list;?></th>
			</tr>
			<tr class="table-title">
				<!-- <td><?php echo $sequence;?></td> -->
				<td><?php echo $t_title;?></td>
				<td><?php echo $t_upload_time;?></td>
				<td><?php echo $t_category;?></td>
				<!-- <td><?php echo $t_quality;?></td> -->
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
					<!-- <td><?php echo $val['quality']; ?></td> -->
					<td>
						<a data-subtitle="<?php echo $val['subtitle_id']; ?>" href="<?php echo site_url('user/delete_subtitle?'); ?>" class="subtitle-delete-btn" >
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
$('a.subtitle-delete-btn').click(function(){
	var type = "POST";
	var url = $(this).attr('href');
	var data = "subtitle="+$(this).data('subtitle');
	//alert($(this).data('subtitle'));
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