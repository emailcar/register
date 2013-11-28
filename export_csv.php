<?php
define('YSPAY', true);
//函数用于生成文件
function esport_csv(){
$filename = date('ymdhis').".csv";//生成文件名
header("Content-type:text/csv");
header("Content-Disposition:attachment;filename=".$filename);
header("Cache-Control:must-revalidate,post-check=0,pre-check=0");
header("Expires:0");
header("Pragma:public");
}
require(dirname(__FILE__) . '/includes/init.php');
if(isset($_REQUEST['move']) && $_REQUEST['move'] == 'esport'){
if(isset($_REQUEST['act']) && $_REQUEST['act'] == 'register')
{
	$order_sn=isset($_REQUEST['order_sn'])?trim($_REQUEST['order_sn']):'';//查询ID号：
	$computer_name= isset($_REQUEST['computer_name'])?trim($_REQUEST['computer_name']):'';//查询公司
	$user_last = isset($_REQUEST['user_last'])?trim($_REQUEST['user_last']):'';//查询姓
	$user_first = isset($_REQUEST['user_first'])?trim($_REQUEST['user_first']):'';//查询名
	$group_id = isset($_REQUEST['group_id'])? trim($_REQUEST['group_id']):0;
	$site_id = isset($_REQUEST['site_id'])? trim($_REQUEST['site_id']):0;
	if($group_id)
	{
		$site_ids = implode(",",find_site_ids($group_id));
	}else{
		$site_ids = $site_id;
	}
	$state=isset($_REQUEST['state'])?trim($_REQUEST['state']):'';//状态
	$news_staff_query = isset($_REQUEST['news_staff_query'])?trim($_REQUEST['news_staff_query']):'';//查询某种状态的登记人员
	$news_source_query = isset($_REQUEST['news_source_query']) ?trim($_REQUEST['news_source_query']):'';//查询登记来源
	$news_staff_set = isset($_REQUEST['news_staff_set'])?trim($_REQUEST['news_staff_set']):'';//更改登记人员状态
	$page_title = "登记记录";
	$page_size = 99999;//每页显示条数
	$page_index = 1;//页码
	$numeric_count = 5;//索引长度
	
	$type = isset($_REQUEST['view']) ? $_REQUEST['view'] : 'register_toady';
	$page_index = isset($_REQUEST['page_index']) ? $_REQUEST['page_index'] : 1;//页码数
	
	$start_time = 0;
	$end_time = 0;
	
	if($type == 'register_toady')
	{
		$page_title = "今日预登记";
		$timezone = "Asia/Shanghai"; 
		if(function_exists('date_default_timezone_set')) date_default_timezone_set($timezone);
		$date = date("y-m-d");
		$start_date = strtotime("-1 days");
		$start_time = date("y-m-d",$start_date).' 23:59:59';
		$end_time = $date.' 23:59:59';
	}
	$total=find_order_count($start_time,$end_time,0,'','4',$site_ids,'');//查询所有
	$badTotal=find_order_count($start_time,$end_time,0,'','2',$site_ids,'');
	$success=find_order_count($start_time,$end_time,0,'','1',$site_ids,'');
	$payclickcount=find_order_count($start_time,$end_time,0,'','4',$site_ids,1);
	$summoney=find_order_amount($start_time,$end_time,0,'','1',$site_ids);
	
	$ordersCR=0;
	$ordersCPR=0;
	$ordersPR=0;
	if($payclickcount>0)
	{
		$ordersCR=round($payclickcount/$total*100,2);
	}
	if($success>0)
	{
	$ordersCPR=round($success/$payclickcount*100,2);
	$ordersPR=round($success/$total*100,2);
	}
	$payState=4;
	if($state)
	{
		if($state == '未付款')
		{
			$payState=0;
		}elseif($state == '已付款')
		{
			$payState=1;
		}
		elseif($state == '付款失败')
		{
			$payState=2;
		}else
		{
			$payState=4;
		}
	}
	//echo $state.'xxx';
	//echo $news_staff_query;
	$news_State = '';
	if($news_staff_query){
		if($news_staff_query == 'cancel_query'){
			$news_State = '0'	;
		}elseif($news_staff_query = 'sign_query'){
			$news_State = '1';
		}else{
			$news_State = '';
		}
	}
	$news_source = '';
	if($news_source_query){
		if($news_source_query == 'user_me'){
			$news_source = '0'	;
		}elseif($news_source_query = 'user_query'){
			$news_source = '1';
		}else{
			$news_source = '';
		}
	}
	//echo $news_State.'aaaa';
	//echo '这是标记状态'.$payState;
	//$selectCount=find_order_count($start_time,$end_time,$order_sn,$url,$payState,$site_ids,'');
	//$page = find_order_list($page_size,$page_index,$numeric_count,$start_time,$end_time,$order_sn,$url,$payState,$site_ids);
	$select_register_number = register_get_number($start_time,$end_time);//获取查询总数
	$register_list = register_get_mysql($page_size,$page_index,$numeric_count,$start_time,$end_time,$order_sn,$computer_name,$payState,$site_ids,$news_State,$user_last,$user_first,$news_source);
	//print_r($register_list);
	//include_once('templates/register_list.html');
	echo '公司名称,联系人,电子邮件,座机电话,手机号码'."\r\n";
	function move_export($register_list){
		foreach($register_list->data as $user_news){
			$user_date = $user_news['user_company'].",".$user_news['user_last_name'].$user_news['user_first_name'].",".$user_news['user_email'].",".$user_news['user_tel_area'].$user_news['user_tel'].",".$user_news['user_mobile']."\r\n";
			//fputcsv($fp,split(',',$user_news));//查询出的结果导入到文件
			echo $user_date;
		}
			/*
		fputcsv($fp,split(',',$user_news));
		*/
	}
	esport_csv();
	$x = move_export($register_list);
	if($x){
		 return true;
	}
}
}
?>