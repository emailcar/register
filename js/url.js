$(document).ready(function(){
	$("li#mian_meun_i").click(function(){
		$('#frame_content').attr('src','include/index.php')
		$('#frame_content').attr('height','500px')
	})
	$("li#mian_meun_t").click(function(){
		$('#frame_content').attr('src','include/today.php')
		$('#frame_content').attr('height','950px')
	})
	$("li#mian_meun_a").click(function(){
		$('#frame_content').attr('src','include/all.php')
		$('#frame_content').attr('height','1500px')
		
	})
	$("li#mian_meun_m").click(function(){
		$('#frame_content').attr('src','include/manage.php')
	})
})