$(function(){	
	/*--- loginAjax S---*/
	$('#mainLogin').bind('submit',function(){
		var $that=$(this);
		if($that.attr('data-check')==='true'){
			return true
		}
		if($.trim($that.find('input[name=username]').val()).length<4){			
			alert('请输入至少4位的用户名！')
			$that.find('#username').trigger('focus');			
			return false
		}
		if($.trim($that.find('input[name=password]').val()).length<4){
			alert('请输入至少4位密码！');
			$that.find('#password').trigger('focus');
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

})