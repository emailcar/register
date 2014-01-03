<?php

/**
 * 默认页
 * ============================================================================
 * ----------------------------------------------------------------------------
 * 这不是一个自由软件！您只能在不用于商业目的的前提下对程序代码进行修改和
 * 使用；不允许对程序代码以任何形式任何目的的再发布。
 * ============================================================================
 * $Author: Peter.Hu $
*/

define('YSPAY', true);

require(dirname(__FILE__) . '/includes/init.php');
/*
set_time_limit(0);
	$user_id = $_SESSION['user_admin']['0'];
    $user_name = $_SESSION['user_admin']['1'];
    $user_classify = $_SESSION['user_admin']['3'];
    if($user_id&&$user_name){
    }else{
        header('location:login.php');
        exit();
    }
*/
if(isset($_REQUEST['act']) && $_REQUEST['act'] == 'list')
{
	$order_sn=isset($_REQUEST['order_sn'])?trim($_REQUEST['order_sn']):'';
	$url= isset($_REQUEST['url'])?trim($_REQUEST['url']):'';
	$group_id = isset($_REQUEST['group_id'])? trim($_REQUEST['group_id']):0;
	$site_id = isset($_REQUEST['site_id'])? trim($_REQUEST['site_id']):0;
	if($group_id)
	{
		$site_ids = implode(",",find_site_ids($group_id));
	}else{
		$site_ids = $site_id;
	}
	$state=isset($_REQUEST['state'])?trim($_REQUEST['state']):'';
	$page_title = "所有订单信息";
	$page_size = 15;//每页显示条数
	$page_index = 1;//页码
	$numeric_count = 5;//索引长度
	
	$type = isset($_REQUEST['view']) ? $_REQUEST['view'] : 'today';
	$page_index = isset($_REQUEST['page_index']) ? $_REQUEST['page_index'] : 1;
	
	$start_time = 0;
	$end_time = 0;
	
	if($type == 'today')
	{
		$page_title = "今日订单信息";
		$date = date("y-m-d");
		$start_time = $date.' 0:0:0';
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
	$selectCount=find_order_count($start_time,$end_time,$order_sn,$url,$payState,$site_ids,'');
	$page = find_order_list($page_size,$page_index,$numeric_count,$start_time,$end_time,$order_sn,$url,$payState,$site_ids);
	include_once('templates/order_list.html');
}
/****************************登记惹人员*******************************************/
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
	$page_size = 15;//每页显示条数
	$page_index = 1;//页码
	$numeric_count = 5;//索引长度
	
	$type = isset($_REQUEST['view']) ? $_REQUEST['view'] : 'register_toady';
	$page_index = isset($_REQUEST['page_index']) ? $_REQUEST['page_index'] : 1;//页码数
	$timezone = "Asia/Shanghai"; 
	if(function_exists('date_default_timezone_set')) date_default_timezone_set($timezone);
	$start_time = 0;
	$end_time = date("Y-m-d H:i:s");
	
	if($type == 'register_toady')
	{
		$page_title = "今日预登记";
		$timezone = "Asia/Shanghai"; 
		if(function_exists('date_default_timezone_set')) date_default_timezone_set($timezone);
		$date = date("Y-m-d");
		$start_date = strtotime("-1 days");
		$start_time = date("Y-m-d",$start_date).' 23:59:59';
		$end_time = date("Y-m-d H:i:s");//new $date.' 23:59:59';
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
	include_once('templates/register_list.html');
}
/*******************************************************************************************************************/
if(isset($_REQUEST['act']) && $_REQUEST['act'] == 'details')
{
	$order_id = isset($_REQUEST['id']) ? $_REQUEST['id'] : 0;
	$order_details = find_order_details($order_id);
	$order_products = find_order_products($order_id);
	$email_list = find_email($order_id);
	$email_type_list = find_email_type_list();
	$email_template_list = find_email_templa_list();
	$email_config_list = find_email_con_list();
	include_once('templates/order_details.html');
}
/*****
*登记人员详细页数据处理
*
***/
if(isset($_REQUEST['act']) && $_REQUEST['act'] == 'register_news')
{
	/*$order_id = isset($_REQUEST['id']) ? $_REQUEST['id'] : 0;
	$order_details = find_order_details($order_id);//返回的查询结果
	$order_products = find_order_products($order_id);
	$email_list = find_email($order_id);
	$email_type_list = find_email_type_list();
	$email_template_list = find_email_templa_list();
	$email_config_list = find_email_con_list();
	*/
	$user_id = isset($_REQUEST['id']) ? $_REQUEST['id'] : 0;
	$user_news = find_rigister_news($user_id);
	include_once('templates/register_news.html');
}
/**
*删除某一个ID
*/
if(isset($_REQUEST['act']) && $_REQUEST['act'] == 'del')
{
	$order_ids = isset($_REQUEST['id']) ? $_REQUEST['id'] : 0;
	$view = $_REQUEST['view'];
	echo '视图：'.$view;
	switch ($view){
		case 'all':
			$act = 'list';
			break;
		case 'today':
		$act = 'list';
		break;
		case 'register':
		$act = 'list';
		break;
		case 'register_all';
		$act = 'register';
		case 'register_toady';
		$act = 'register';
	}
	$order_idarr = explode("-", $order_ids);
	if($act=='list'){
		foreach ($order_idarr as $order_id){
			if($order_id != ''){
				delete_order($order_id);
			}
		}
	}else{
		foreach ($order_idarr as $order_id){
			if($order_id != ''){
				delete_register($order_id);
			}
		}
	}

	header('Location: order.php?act='.$act.'&view='.$view);	
}
//更改付款状态
if(isset($_REQUEST['act']) && $_REQUEST['act'] == 'pay_status')
{
	
	$ys_order_id = isset($_REQUEST['id']) ? $_REQUEST['id'] : 0;
	$pay_status = $_POST['pay_status'];
	update_pay_status($ys_order_id, $pay_status);
	header('Location: order.php?act=details&id='.$ys_order_id);
}
//更改人员登记状态
if(isset($_REQUEST['act']) && $_REQUEST['act'] == 'register_status')
{
	
	$register_id = isset($_REQUEST['id']) ? $_REQUEST['id'] : 0;
	$register_status = $_POST['register_status'];
	update_reg_status($register_id, $register_status);
	header('Location: order.php?act=register_news&id='.$register_id);
}
//批量更改标记状态
if(isset($_REQUEST['act']) && $_REQUEST['act'] == 'staff_set'){
	$register_id = isset($_REQUEST['id']) ? $_REQUEST['id'] : 0;
	$staff_set = $_REQUEST['news_staff_set'];
	update_reg_status($register_id, $register_status);
	echo $register_id;
}


if(isset($_REQUEST['act']) && $_REQUEST['act'] == 'shipments_status')
{
	
	$ys_order_id = isset($_REQUEST['id']) ? $_REQUEST['id'] : 0;
	$shipments_status = $_POST['shipments_status'];
	update_shipments_status($ys_order_id, $shipments_status);
	header('Location: order.php?act=details&id='.$ys_order_id);
}

if(isset($_REQUEST['act']) && $_REQUEST['act'] == 'returned')
{
	
	$ys_order_id = isset($_REQUEST['id']) ? $_REQUEST['id'] : 0;
	$is_returned = $_POST['is_returned'];
	$remark = 'YiShang Orders System';
	update_returned($ys_order_id, $is_returned, $remark);
	header('Location: order.php?act=details&id='.$ys_order_id);
}

if(isset($_REQUEST['act']) && $_REQUEST['act'] == 'laiyuan')
{
	
	$ys_order_id = isset($_REQUEST['id']) ? $_REQUEST['id'] : 0;
	$from = $_POST['from'];
	update_from($ys_order_id, $from);
	$tips="修改成功!";
	header('Location: order.php?act=details&id='.$ys_order_id.'&tips='.$tips);
}
//查看邮件内容
if(isset($_REQUEST['act']) && $_REQUEST['act'] == 'email_content')
{
	
	$email_id = isset($_REQUEST['id']) ? $_REQUEST['id'] : 0;
	echo get_email_content($email_id);
}
//预览邮件
if(isset($_REQUEST['act']) && $_REQUEST['act'] == 'view_mail')
{
	$email_id = isset($_REQUEST['ys_order_id']) ? $_REQUEST['ys_order_id'] : 0;
	$email_account = isset($_REQUEST['email_account']) ? $_REQUEST['email_account'] : ''; //接收邮箱
	if($email_id && $email_account)
	{
		$email_type = isset($_REQUEST['email_type']) ? $_REQUEST['email_type'] : 0; //邮件类型
		$email_temp = isset($_REQUEST['email_temp']) ? $_REQUEST['email_temp'] : 0; //模版编号
		$userInfo=array();
		$orderInfo=array();
		$userInfo['email_account'] = $email_account;
		$userInfo['first_name'] = isset($_REQUEST['first_name']) ? $_REQUEST['first_name'] : '';
		$userInfo['last_name'] = isset($_REQUEST['last_name']) ? $_REQUEST['last_name'] : ''; 
		$userInfo['address'] = isset($_REQUEST['address']) ? $_REQUEST['address'] : '';    //地址
		$userInfo['zipcode'] = isset($_REQUEST['zipcode']) ? $_REQUEST['zipcode'] : '';       //邮编
		$userInfo['tel'] = isset($_REQUEST['tel']) ? $_REQUEST['tel'] : '';    //电话
		
		$orderInfo['from_site'] = isset($_REQUEST['from_site']) ? $_REQUEST['from_site'] : ''; //来源站点
		$orderInfo['order_sn'] = isset($_REQUEST['order_sn']) ? $_REQUEST['order_sn'] : ''; //订单号
		$orderInfo['order_time'] = isset($_REQUEST['order_time']) ? $_REQUEST['order_time'] : ''; //下单时间
		$temp = get_email($userInfo,$email_id,$orderInfo,$email_type,$email_temp);
		echo $temp['content'];
	}else
	{
		echo 'error';
	}
}
//发送邮件
if(isset($_REQUEST['act']) && $_REQUEST['act'] == 'send_mail_again')
{
	$email_id = isset($_REQUEST['ys_order_id']) ? $_REQUEST['ys_order_id'] : 0;
	$email_account = isset($_REQUEST['email_account']) ? $_REQUEST['email_account'] : ''; //接收邮箱
	if($email_id && $email_account)
	{
		$email_type = isset($_REQUEST['email_type']) ? $_REQUEST['email_type'] : 0; //邮件类型
		$email_temp = isset($_REQUEST['email_temp']) ? $_REQUEST['email_temp'] : 0; //模版编号
		$email_config = isset($_REQUEST['email_config']) ? $_REQUEST['email_config'] : 0; //模版编号
		$userInfo=array();
		$orderInfo=array();
		$userInfo['email_account'] = $email_account;
		$userInfo['first_name'] = isset($_REQUEST['first_name']) ? $_REQUEST['first_name'] : '';
		$userInfo['last_name'] = isset($_REQUEST['last_name']) ? $_REQUEST['last_name'] : ''; 
		$userInfo['address'] = isset($_REQUEST['address']) ? $_REQUEST['address'] : '';    //地址
		$userInfo['zipcode'] = isset($_REQUEST['zipcode']) ? $_REQUEST['zipcode'] : '';       //邮编
		$userInfo['tel'] = isset($_REQUEST['tel']) ? $_REQUEST['tel'] : '';    //电话
		
		$orderInfo['from_site'] = isset($_REQUEST['from_site']) ? $_REQUEST['from_site'] : ''; //来源站点
		$orderInfo['order_sn'] = isset($_REQUEST['order_sn']) ? $_REQUEST['order_sn'] : ''; //订单号
		$orderInfo['order_time'] = isset($_REQUEST['order_time']) ? $_REQUEST['order_time'] : ''; //下单时间
		$temp = get_email($userInfo,$email_id,$orderInfo,$email_type,$email_temp);
		$email_title = $temp['email_title'];
		$state=0;
		
		
		$email=array();
		$email['t_id'] = $email_type;
		$email['temp_id'] = $email_temp;
		$email['email_content'] = str_replace("'","''",$temp['content']);
		$email['ys_order_id'] = $email_id;
		$email['to_mail'] = $email_account;
		$email['email_title'] = $email_title;
		$smtp = get_smtp_by_id($email_config);
		
		if($smtp['is_smtp'] == '2')
		{
			$emails['email_content'] = $temp['content'];
			$emails['send_account'] = $temp['send_account'];
			$emails['send_name'] = $temp['send_name'];
			$emails['subject'] = $email_title;
			$emails['to'] = $email_account;
			$emails['name'] = $userInfo['first_name'].' '.$userInfo['last_name'];

			if(smtp_send_mail($smtp,$emails) == '1') //成功
			{
				$state=1;
				echo '<font color="red">发送成功</font>'.$email_config;
				update_confirm_email($email_id,1);
			}else //失败
			{
				echo '<font color="green">发送失败</font>';
				update_confirm_email($email_id,2);
			}
		}else
		{
			if(send_mail($email_account,$email_title,$temp['content'],$temp['send_account']))
			{
				$state=1;
				echo '<font color="green">发送成功</font>'.$email_config;
				update_confirm_email($email_id,1);
			}else
			{
				echo '<font color="red">发送失败</font>';
				update_confirm_email($email_id,2);
			}
		}
				
		$email['state'] = $state;
		add_email($email,$smtp['username']);
		
		
	}else
	{
		echo 'error';
	}
}
//发送邮件
if(isset($_REQUEST['act']) && $_REQUEST['act'] == 'send_mail')
{
	$email_id = isset($_REQUEST['ys_order_id']) ? $_REQUEST['ys_order_id'] : 0;
	$email_account = isset($_REQUEST['email_account']) ? $_REQUEST['email_account'] : ''; //接收邮箱
	if($email_id && $email_account)
	{
		$email_type = isset($_REQUEST['email_type']) ? $_REQUEST['email_type'] : 0; //邮件类型
		$email_temp = isset($_REQUEST['email_temp']) ? $_REQUEST['email_temp'] : 0; //模版编号
		$userInfo=array();
		$orderInfo=array();
		$userInfo['email_account'] = $email_account;
		$userInfo['first_name'] = isset($_REQUEST['first_name']) ? $_REQUEST['first_name'] : '';
		$userInfo['last_name'] = isset($_REQUEST['last_name']) ? $_REQUEST['last_name'] : ''; 
		$userInfo['address'] = isset($_REQUEST['address']) ? $_REQUEST['address'] : '';    //地址
		$userInfo['zipcode'] = isset($_REQUEST['zipcode']) ? $_REQUEST['zipcode'] : '';       //邮编
		$userInfo['tel'] = isset($_REQUEST['tel']) ? $_REQUEST['tel'] : '';    //电话
		
		$orderInfo['from_site'] = isset($_REQUEST['from_site']) ? $_REQUEST['from_site'] : ''; //来源站点
		$orderInfo['order_sn'] = isset($_REQUEST['order_sn']) ? $_REQUEST['order_sn'] : ''; //订单号
		$orderInfo['order_time'] = isset($_REQUEST['order_time']) ? $_REQUEST['order_time'] : ''; //下单时间
		$temp = get_email($userInfo,$email_id,$orderInfo,$email_type,$email_temp);
		$email_title = $temp['email_title'];
		$state=0;
		
		
		$email=array();
		$email['t_id'] = $email_type;
		$email['temp_id'] = $email_temp;
		$email['email_content'] = str_replace("'","''",$temp['content']);
		$email['ys_order_id'] = $email_id;
		$email['to_mail'] = $email_account;
		$email['email_title'] = $email_title;
		$smtp = get_smtp();
		
		if($smtp['is_smtp'] == '2')
		{
			$emails['email_content'] = $temp['content'];
			$emails['send_account'] = $temp['send_account'];
			$emails['send_name'] = $temp['send_name'];
			$emails['subject'] = $email_title;
			$emails['to'] = $email_account;
			$emails['name'] = $userInfo['first_name'].' '.$userInfo['last_name'];

			if(smtp_send_mail($smtp,$emails) == '1') //成功
			{
				$state=1;
				echo '<font color="red">发送成功</font>';
				update_confirm_email($email_id,1);
			}else //失败
			{
				echo '<font color="green">发送失败</font>';
				update_confirm_email($email_id,2);
			}
		}else
		{
			if(send_mail($email_account,$email_title,$temp['content'],$temp['send_account']))
			{
				$state=1;
				echo '<font color="green">发送成功</font>';
				update_confirm_email($email_id,1);
			}else
			{
				echo '<font color="red">发送失败</font>';
				update_confirm_email($email_id,2);
			}
		}
				
		$email['state'] = $state;
		add_email($email,$smtp['username']);
		
		
	}else
	{
		echo 'error';
	}
}
//根据类型返回模版
if(isset($_REQUEST['act']) && $_REQUEST['act'] == 'view_temp')
{
	$type_id = isset($_REQUEST['type_id']) ? $_REQUEST['type_id'] : 0;
	if($type_id)
	{
		$temp_list = find_email_name_list($type_id);
		if($temp_list)
		{
			$result='[';
			foreach($temp_list as $temp)
			{
				$result .='{"id":'.$temp["t_id"].',"name":"'.$temp["template_name"].'"},';
			}
			rtrim($result,',');
			$result .=']';
			echo $result;
		}else
		{
			echo "empty";
		}
	}else
	{
		echo 'error';
	}
}

//发送所有
if(isset($_REQUEST['act']) && $_REQUEST['act'] == 'all_email')
{
	$email_list = get_no_send_mail();
	$success = 1;
	$faild = 0;
	$email_type = 2; //邮件类型
	$email_temp = 14; //模版编号
	
	if($email_list)
	{
		$temps = find_temp_email($email_temp);
		
		foreach($email_list as $key => $email)
		{
			$userInfo=array();
			$orderInfo=array();
			$email_id = $email_list[$key]['ys_order_id'];

			$userInfo['email_account'] = $email_list[$key]['email']; //接收邮箱
			$userInfo['first_name'] = $email_list[$key]['first_name'];
			$userInfo['last_name'] = $email_list[$key]['last_name']; 
			$userInfo['address'] = $email_list[$key]['address'].','.$email_list[$key]['city'].','.$email_list[$key]['state'].','.$email_list[$key]['country'];  //地址
			$userInfo['zipcode'] = $email_list[$key]['zipcode'];       //邮编
			$userInfo['tel'] = $email_list[$key]['tel'];    //电话
			$orderInfo['ys_order_id'] = $email_list[$key]['ys_order_id'];
			$orderInfo['from_site'] = $email_list[$key]['from_site']; //来源站点
			$orderInfo['order_sn'] = $email_list[$key]['order_sn']; //订单号
			$orderInfo['order_time'] = $email_list[$key]['order_time']; //下单时间
			$temp = get_email($userInfo,$email_id,$orderInfo,$email_type,$email_temp,$temps);
			$email_title = $temp['email_title'].$orderInfo['order_sn'];
			$state=0;
			
			
			$email=array();
			$email['t_id'] = $email_type;
			$email['temp_id'] = $email_temp;
			$email['email_content'] = str_replace("'","''",$temp['content']);
			$email['ys_order_id'] = $email_id;
			$email['to_mail'] = $userInfo['email_account'];
			$email['email_title'] = $email_title;
			
			if(send_mail($userInfo['email_account'],$email_title,$temp['content'],$temp['send_account']))
			{
				$state = 1;
				$success++;
				update_confirm_email($email_id,1);
			}else
			{
				$faild++;
				update_confirm_email($email_id,2);
			}
			
			$email['state'] = $state;

			add_email($email,'shenjing');
			
			sleep(1);
		}
		echo '发送完成！发送成功：'.$success.'条.发送失败：'.$faild.'条';
	}else
	{
		echo '未有';
	}
}

?>