<?php
//设置时间戳
$timezone = "Asia/Shanghai"; 
if(function_exists('date_default_timezone_set')) date_default_timezone_set($timezone);
$time = date("Y-m-d");
$quire_number = 10;//每页显示信息数
$top_num = rand(1,10);
$mysql_c =mysql_connect('localhost','register','123456');
$mysql_list = 'register';
$mysql_title = "user_news";
$address = '上海博华国际展览有限公司';//使用单位
$copyright = '韵贵科技';//网站版权
$copyright_list = 'http://www.iscod.com';//版权博客网址
//转换数据库信息为变量
	$id = $user_news['0'];
	$user_last_name = $user_news['1'];
	$user_first_name = $user_news['2'];
	$user_title = $user_news['3'];
	$user_job = $user_news['4'];
	$user_company = $user_news['5'];
	$user_country = $user_news['6'];
	$user_province = $user_news['7'];
	$user_city = $user_news['8'];
	$user_address = $user_news['9'];
	$user_postalcode = $user_news['10'];
	$user_tel_area = $user_news['11'];
	$user_tel = $user_news['12'];
	$user_fax_area = $user_news['13'];
	$user_fax = $user_news['14'];
	$user_mobile = $user_news['15'];
	$user_email = $user_news['16'];
	$user_qq = $user_news['17'];
	$user_websit = $user_news['18'];
	$user_date = $user_news['19'];
	$user_profession = $user_news['20'];
	$user_objective = $user_news['21'];
	$user_interest = $user_news['22'];
	$user_road = $user_news['23'];
	$user_sign = $user_news['24'];
//
?>