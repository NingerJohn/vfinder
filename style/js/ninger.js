/*
* 
* 
* 
* 
*/
//
function jumpTo(link){
	//
	window.location.href = link;
}
function winClose(){
	window.close();
}
// hide the obj
function hideObj(data,effect){
	data.hide(effect);
}
// disable btn or input
function disable(obj){
	//
	obj.addAttr('disable',true);
}
// enable btn or input
function enable(obj){
	//
	obj.removeAttr('disable');
}
// declare the general method of ajax request
function remoteProcess(type, url, data, success, fail){
	var status = null;
	$.ajax({
		async: false,
		type:type,
		url:url,
		data:data,
		success:function(msg){
			status = success(msg);
			//console.log(msg);
		},
		error:function(msg){
			status = fail(msg);
			//console.log(msg);
		}
	})
	return status;
}
// check login
function loginCheck(type, url, success){
	var status = null;
	$.ajax({
		async: false,
		type:type,
		url:url,
		success:function(msg){
			status = success(msg);
		}
	})
	return status;
}
// refresh page
function pageRefresh(){
	window.location.reload();
}
// to show message
function showMsg(obj,target,msg,status){
	if(!arguments['1']){
		arguments['1'] ='span';
	}
	if(obj.siblings(target).length>=1){
		obj.siblings(target).remove();
		obj.after('<span class="'+status+'">'+msg+'</span>');
	}else{
		obj.after('<span class="'+status+'">'+msg+'</span>');
	}
}
// check the email format
function emailCheck(obj,format){
	//
	var next ='span';
	var value = obj.val();
	var reg = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
	var result = reg.test(value);
	if(!result){
		//
		showMsg(obj,'span',format,'fail');
		return false;
	}else{
		obj.siblings(next).remove();
		return true;
	}
}
// password check
function pwdCheck(obj,empty,short){
	//
	var msgObj = obj;
	var value = obj.val();
	if(value==''){
		showMsg(msgObj,'span',empty,'fail');
		return false;
	}else if(value.length<=6){
		showMsg(msgObj,'span',short,'fail');
		return false;
	}else{
		showMsg(msgObj,'span','√','success');
		return true;
	}
}
// confirm password check
function conpwd(obj,empty,short,preval,different){
	//
	var msgObj = obj;
	var value = obj.val();
	var result = !(preval==value) ? true:false;
	if(value==''){
		showMsg(msgObj,'span',empty,'fail');
		return false;
	}else if(result){
		showMsg(msgObj,'span',different,'fail');
		return false;		
	}else{
		showMsg(msgObj,'span','√','success');
		return true;		
	}
}

