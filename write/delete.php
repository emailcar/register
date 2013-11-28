<?php
	require "../data/config.php";
	$dbc = mysql_connect($db_host,$db_user,$db_pass);
	if($dbc){
		echo "lianjie chenggong<br/>";
		mysql_select_db($mysql_list);
		mysql_query("SET NAMES 'utf8'");
		for($i=570;$i<6300;$i++){
			$x = "DELETE FROM `marryys`.`user_news` WHERE `user_news`.`id` = ".$i.";";
			$query = mysql_query($x);
			if($query){
			echo "ID".$i."删除成功！<br/>";
		}else{
			echo "ID".$i."删除失败！<br/>";
		}
		}
		mysql_close($dbc);
	}
?>