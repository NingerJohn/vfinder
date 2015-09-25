	<div class="interest">
		<table class="table table-bordered">
			<tr>
				<td><?=$interest?></td>
			</tr>
			<tr>
				<td><form action="#"><input class="content" type="text" /><input class="add" type="submit" value="<?=$add?>"></form></td>
			</tr>
			<tr >
				<td class="tag-wall">

				</td>
				
			</tr>
		</table>
	</div>


	<td class="tag-wall">
		<div class="text">标签内容1111</div>
		<div class="text">标签内容222</div>
		<div class="text">标签内容333</div>
		<div class="text">标签内容444</div>
<!-- 
	div.text这样的标签是用户添加的
	现在问题是，在用$('.tag-wall').find('.text') 来获取类名为text的div标签的时候，如何知道是否td下面存在这样的div?????
-->
	</td>

<script type="text/javascript">
function addTag(){
		var status = "";
		var addVal = $('input.content').val();
		if(!addVal){
			alert('empty');
			return false;
		}
		var allTagsText = "";
		var allTagsObj = $('.tag-wall').find('.text'); //取得td标签墙里面所有带text类的div对象
		var tagObj = $('.tag-wall').find('.tag');
		var color = Math.floor(Math.random()*4+1);
		var add = '<div class="tag tag-'+color+'"><div class="delete-btn"><a class="delete-btn glyphicon glyphicon-remove"></a></div><div class="text">'+addVal+'</div></div>';
		alert($('.tag-wall').has('div.text'));
		if( allTagsObj.length>0 ){
			allTagsObj.each(function(){
				var value = $(this).text(); // 标签div.text的值
				if(value == addVal){
					status = 'same'; // 相同的话就直接返回status为same
					alert('checked is '+status);
					return status;
				}else{
					status = 'different'; // 不相同的话就继续each循环返回status为different
				}
			})
		}else{
			status = 'different';
		}
		if((status !== 'same')){
			$('td.tag-wall').append(add);
			alert(status + ', so run add action'); // 第一次运行的时候，如果标签墙没有标签的话，为啥status为空字符串????
			alert(addVal+':'+color+';');
		}else{
			alert('<?php echo $already_exist;?>');
			return false;
		}
}
$(document).mousemove(function(e){
	var x = e.pageX;
	var y = e.pageY;
	//$('td.tag-wall').html('X:'+x+' Y:'+y);
})
$(document).ready(function(){
	$('input.add').click(function(){
		addTag();
		return false;
	});
	$('body').on('click','a.delete-btn',function(){
		//alert("delter");
		var tag = $(this).parent().parent();
		tag.remove();
		return false;
	});

})
$(document).ready(function(e){

})
</script>
