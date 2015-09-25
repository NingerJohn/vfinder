<div class="container menu">
	<ul class="nav nav-tabs nav-block">
		<li class="active"><a href="<?=base_url('index.php/user?manage=user_info')?>"><?=$user_info?></a></li>
		<li><a href="<?=base_url('index.php/user?manage=vshare')?>"><?=$vshare?></a></li>
		<li><a href="<?=base_url('index.php/user?manage=subtitle')?>"><?=$subtitle?></a></li>

		<!-- 
			<li><a href="<?=base_url('index.php/user?manage=post')?>">Post</a></li>
			<li class="active"><a href="<?=base_url('index.php/user?manage=general_info')?>">general_info</a></li>
		 -->
	</ul>
</div>

<div class="container info">

		<ul class="nav nav-pills nav-stacked">
			<li><a href="<?=base_url('index.php/user?manage=user_info&act=personal_info')?>"><?=$personal_info?></a></li>
			<!-- <li class="active"><a href="<?=base_url('index.php/user?manage=user_info&act=avatar')?>"><?=$avatar?></a></li> -->
			<li class=""><a href="<?=base_url('index.php/user?manage=user_info&act=interest')?>"><?=$interest?></a></li>
			
		</ul>

	<div class="content">
		asdf
	</div>
</div>
