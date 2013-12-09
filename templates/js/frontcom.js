$(function(){
	/*联系方式弹出框 S*/
	$('.fnDialog').bind('click',function(){
		var $dialog=$($(this).attr('data-dialog'));
		$dialog.fadeIn('slow');
		$dialog.find('.fnDialogClose').bind('click',function(){
			$dialog.fadeOut('slow');
		})
	})
	/*联系方式弹出框 E*/
	/*QQ聊天 S*/	
	$('.qq-service').each(function(){
		var iIndex=$(this).index('.qq-service');
		var sIdName='qq'+iIndex;
		$(this).attr('id',sIdName);
		try{
		 BizQQWPA.addCustom({
		 	aty: '0', //接入到指定工号
		 	type: '1', //使用按钮类型 WPA
		 	nameAccount: '4000602012', //营销 QQ 号码
		 	selector:sIdName //将 WPA 放置在 ID 为 testAdd 的元素里
		 });
		}catch(err){
		 	$(this).bind('click',function(){
		 		window.open('http://b.qq.com/webc.htm?new=0&sid=4000602012&eid=218808P8z8p8x8q8K8y8x&o=&q=7&ref='+document.location, '_blank', 'height=544, width=644,toolbar=no,scrollbars=no,menubar=no,status=no');
		 	})
		}
	})		
	try{
		BizQQWPA.visitor({
		 nameAccount: '4000602012'
		});
	}catch(err){

	}
	/*QQ聊天 E*/

	/*头部登录 S*/
	$("#loginBtn").bind('click',function(){
		if($(this).hasClass('hover')){
			$(this).removeClass("hover");
			$('#loginBox').hide();						

		}else{
			$(this).addClass("hover");
			$('#loginBox').show();
			$('#com-user-name').trigger('focus')			
		}
	})
	$('body').bind('click.close',function(event){
		if($(event.target).closest('#i_login2').size()===0){
			$("#loginBtn").removeClass("hover");
			$('#loginBox').hide();
			$('body').unbind('click.close');
		}
	})
	$('#com-loginForm').bind('submit',function(){
		var $that=$(this);
		if($that.attr('data-check')==='true'){
			return true
		}
		if($.trim($that.find('input[name=username]').val()).length<4){			
			alert('请输入至少4位的用户名！');
			$that.find('#com-user-name').trigger('focus');	
			return false
		}
		if($.trim($that.find('input[name=password]').val()).length<4){
			alert('请输入至少4位密码！');
			$that.find('#com-user-password').trigger('focus');			
			return false
		}
		$.post('/main/userLog/',$that.serializeArray(),function(data){			
			var rError=new RegExp('<');
			if(rError.test(data)){
				$that.attr('data-check','true');
				$that.trigger('submit');
			}else{								
				alert(data)
			}
		})		
		return false
	})
	/*头部登录 E*/
	
	/*全局input的占位符 S*/
	seajs.use('jquery.customplaceholder.1.0.js',function(){
		$(function(){
			$('.login-module').customplaceholder({
				inputs:'.imitate-input'
			})
		})		
	})
	/*全局input的占位符 E*/
})