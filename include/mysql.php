<?php
	require "common.inc";
	mysql_select_db($mysql_list);
	$dbc = $mysql_c;
	if($dbc)
	{
		mysql_select_db($mysql_list);
		$dbc_w = "SELECT * FROM `$mysql_title` WHERE 1";
		$f = mysql_query($dbc_w);
		if($f){
			$number = mysql_num_rows($f);
		}
	}
?>