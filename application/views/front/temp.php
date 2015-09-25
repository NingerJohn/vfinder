	<div class="interest">
		<table class="table table-bordered">
			<tr>
				<td>
					<form action="#">
						<input class="content" type="text" />
						<input class="add" type="submit" value="<?=$add?>">
					</form>
				</td>
			</tr>
			<tr >
				<td class="tag-wall">

				</td>
				
			</tr>
		</table>
	</div>

<script type="text/javascript">
function addTag(){
		var status = "";
		var addVal = $('input.content').val();
		if(!addVal){
			alert('empty');
			return false;
		}
		var originalTags = $('div.text');
		var allTagsText = "";
		var allTagsObj = $('.tag-wall').find('.text');
		var tagObj = $('.tag-wall').find('.tag');
		var color = Math.floor(Math.random()*4+1);
		var add = '<div class="tag tag-'+color+'"><div class="delete-btn"><a class="delete-btn glyphicon glyphicon-remove"></a></div><div class="text">'+addVal+'</div></div>';
		allTagsObj.each(function(){
			var value = $(this).text();
			if(value == addVal){
				status = 'same'; // false stands for same
				alert('checked is '+status);
				return status;
			}else{
				status = 'different'; //
				alert(status);
			}
		})
		if((status !== 'same')){
			$('td.tag-wall').append(add);
			alert(status + ', so run add action');
			alert(addVal+':'+color+';');
		}else{
			alert('<?php echo $already_exist;?>');
			return false;
		}
}
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
</script>
