<div class="container menu">
	<ul class="nav nav-tabs nav-block">
		<li class="active"><a href="<?=base_url('index.php/user?manage=user_info')?>"><?=$userinfo?></a></li>
		<li><a href="<?=base_url('index.php/user?manage=vshare')?>"><?=$vshare?></a></li>
		<li><a href="<?=base_url('index.php/user?manage=subtitle')?>"><?=$subtitle?></a></li>

		<!-- 
			<li><a href="<?=base_url('index.php/user?manage=post')?>">Post</a></li>
			<li class="active"><a href="<?=base_url('index.php/user?manage=general_info')?>">general_info</a></li>
		 -->
	</ul>
</div>
<?php //echo $session['uid']; print_r($interests);?>
<div class="container info">
		<ul class="nav nav-pills nav-stacked">
			<li><a href="<?=base_url('index.php/user?manage=user_info&act=personal_info')?>"><?=$personal_info?></a></li>
			<!-- <li class="active"><a href="<?=base_url('index.php/user?manage=user_info&act=avatar')?>"><?=$avatar?></a></li> -->
			<li class="active"><a href="<?=base_url('index.php/user?manage=user_info&act=interest')?>"><?=$interest?></a></li>
		</ul>
	<div class="interest">
		<table class="table table-bordered info-interest">
			<tr>
				<td><?=$interest?></td>
			</tr>
			<tr>
				<td><form action="#"><input class="content" type="text" /><input class="add" type="submit" value="<?=$add?>"></form></td>
			</tr>
			<tr>
				<td class="tag-wall">
					<?php $interest = explode(';',$interests); for($i=0;$i < (count($interest)-1);$i++): ?>
						<div class="tag tag-<?php $a=1; $temp = explode(":", $interest[$i]); echo$temp[$a]; ?>">
							<div class="delete-btn">
								<a class="delete-btn glyphicon glyphicon-remove"></a>
							</div>
							<div class="text"><?php echo $temp[--$a]; ?></div>
						</div>
					<?php endfor; ?>
				</td>	
			</tr>
		</table>
	</div>
</div>
<!-- dfas           asdfsf --><!-- <td>300*300 -> 1130*600</td> -->
<script type="text/javascript">
	// add a new tag;
	function addTag(){
		// claim status as empty which used to record whether new one is different with tags aleady exist
		var status = "";
		// check whether new one is empty or not;
		var addVal = $('input.content').val();
		if(!addVal){
			alert('<?php echo $please_input_content?>');
			return false;
		}
		// get the obj of all tags' content on the wall
		var allTagsObj = $('.tag-wall').find('div.text');
		// produce color #
		var color = Math.floor(Math.random()*4+1);
		// the content of new tag;
		var add = '<div class="tag tag-'+color+'"><div class="delete-btn"><a class="delete-btn glyphicon glyphicon-remove"></a></div><div class="text">'+addVal+'</div></div>';
		// check whether addval is same as exist text or not and return true or false
		if(allTagsObj.length>0){
			allTagsObj.each(function(){
				var value = $(this).text();
				if(value == addVal){
					status = 'same'; // false stands for same
					return false; // return false
				}else{
					status = 'different'; //
				}
			})
		}else{
			status = 'different';
		}
		// if same do nothing;
		// if they're different, add it into the tag wall and call the backend dealing function 
		if(!(status === 'same')){
			$('td.tag-wall').append(add);
			var data = 'interest='+addVal+':'+color+';';
			//alert(status + ', so run add action');
			//alert(data);
			// call the PHP function with Ajax to add content to Database;
			var type = 'POST';
			var url = '<?php echo base_url("index.php/user/add_interest")?>';
			var success = function(msg){
				alert("<?php echo $add_interest_success;?>"+msg);
				//location.href='<?php echo base_url("index.php/user?manage=vshare")?>';
			};
			var fail = function(msg){
				alert(msg+"---Failed");
			};
			remoteProcess(type,url,data,success,fail);
		}else{
			alert('<?php echo $already_exist;?>');
			return false;
		}
	}
	// get the info of text content and tag color
	function tagInfo(obj){
		//
		var content = obj.parent().next().text();
		var temp = obj.parents('.tag').attr('class');
		var reg = /\d/;
		var tagColor = temp.match(reg);
		var data = content+':'+tagColor+';';
		return data;
	}
	$(document).ready(function(){
		$('input.add').click(function(){
			addTag();
			return false;
		});
		$('body').on('click','a.delete-btn',function(){
			var temp = tagInfo($(this));
			//alert(temp);
			var tag = $(this).parents('.tag');
			tag.remove();
			var type = 'post';
			var url = '<?php echo base_url("index.php/user/del_interest")?>';
			var data = 'interest='+temp;
			var success = function(msg){
				alert("<?php echo $del_interest_success;?>");
			};
			var fail = function(msg){
				alert(msg+"---Failed");
			};
			remoteProcess(type,url,data,success,fail);
			return false;
		});
	})
/*$(document).mousemove(function(e){
	var x = e.pageX;
	var y = e.pageY;
	//$('td.tag-wall').html('X:'+x+' Y:'+y);
})*/
</script>
