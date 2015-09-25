<?php if( $result == 1 ){ ?>

<div class="container">
	<?php echo $mail_verify_success ?>
</div>
<script type="text/javascript">
	var link = "<?php echo base_url('index.php/user') ?>";
	setTimeout(function(){jumpTo(link);}, 3000);
</script>
<?php }else{ ?>

<div class="container">
	<?php echo $link_outdate; ?>
</div>


<?php } ?>