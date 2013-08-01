$(document).ready(function(){
	$("li#mian_meun_i").click(function(){
		$('#frame_content').attr('src','include/home.php')
	})
	$("li#mian_meun_t").click(function(){
		$('#frame_content').attr('src','include/today.php')
		
	})
	$("li#mian_meun_a").click(function(){
		$('#frame_content').attr('src','include/all.php')
		
	})
})