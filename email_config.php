<?php

define('YSPAY', true);

require(dirname(__FILE__) . '/includes/init.php');

	$user_id = $_SESSION['user_admin']['0'];
    $user_name = $_SESSION['user_admin']['1'];
    $user_classify = $_SESSION['user_admin']['3'];
    if($user_id&&$user_name){
    }else{
        header('location:login.php');
        exit();
    }

if(isset($_REQUEST['act']) && $_REQUEST['act'] == 'view')
{

	$page_title = "所有邮件服务器配置信息";
	$page_size = 15;//每页显示条数
	$page_index = 1;//页码
	$numeric_count = 5;//索引长度

	$page_index = isset($_REQUEST['page_index']) ? $_REQUEST['page_index'] : 1;

	$selectCount=find_template_count();
	$page = find_email_config_list($page_size,$page_index,$numeric_count);
	
	
	$email_config=get_smtp();
	include_once('templates/email_config_list.html');
}
//增加
if(isset($_REQUEST['act']) && $_REQUEST['act'] == 'add')
{
	$act='add';
	//添加
	if(isset($_REQUEST['flag']) && $_REQUEST['flag'] == 'add')
	{
		$smtp=array();
		$config_id = isset($_REQUEST['id']) ? $_REQUEST['id'] : 0;
		$is_default = isset($_REQUEST['is_default']) ? $_REQUEST['is_default'] : 0;
		$is_smtp = isset($_REQUEST['is_smtp']) ? $_REQUEST['is_smtp'] : 0;
		$is_ssl = isset($_REQUEST['is_ssl']) ? $_REQUEST['is_ssl'] : 0;
		$host = isset($_REQUEST['host']) ? $_REQUEST['host'] : '';
		$port = isset($_REQUEST['port']) ? $_REQUEST['port'] : 0;
		$password = isset($_REQUEST['password']) ? $_REQUEST['password'] : '';
		$username = isset($_REQUEST['username']) ? $_REQUEST['username'] : '';
		$smtp['config_id'] = $config_id;
		$smtp['is_default'] = $is_default;
		$smtp['is_smtp'] = $is_smtp;
		$smtp['is_ssl'] = $is_ssl;
		$smtp['host'] = $host;
		$smtp['port'] = $port;
		$smtp['password'] = $password;
		$smtp['username'] = $username;
		if(save_email_config($smtp))
		{
			echo "<meta http-equiv='refresh' content='1;url=email_config.php?act=view'>";
			$tips = "添加成功！";
		}else
		{
			$tips = "添加失败！";
		}
		
	}else//初始化
	{
		$flag="add";
	}
	include_once('templates/email_config.html');
}

//修改
if(isset($_REQUEST['act']) && $_REQUEST['act'] == 'edit')
{
	$act='edit';
	$temp_id = isset($_REQUEST['id']) ? $_REQUEST['id'] : 0;
	if(isset($_REQUEST['flag']) && $_REQUEST['flag'] == 'edit')
	{
		$smtp['config_id'] = $temp_id;
		$smtp['is_default'] = isset($_REQUEST['is_default']) ? $_REQUEST['is_default'] : 0;
		$smtp['is_smtp'] = isset($_REQUEST['is_smtp']) ? $_REQUEST['is_smtp'] : 0;
		$smtp['is_ssl'] = isset($_REQUEST['is_ssl']) ? $_REQUEST['is_ssl'] : 0;
		$smtp['host'] = isset($_REQUEST['host']) ? $_REQUEST['host'] : '';
		$smtp['port'] = isset($_REQUEST['port']) ? $_REQUEST['port'] : 0;
		$smtp['password'] = isset($_REQUEST['password']) ? $_REQUEST['password'] : '';
		$smtp['username'] = isset($_REQUEST['username']) ? $_REQUEST['username'] : '';
		
		if(update_smtp($smtp))
		{
			$tips = "修改成功！";
		}else
		{
			$tips = "修改失败！";
		}
	}
	else{
		$smtp=find_email_config_details($temp_id);
	}
	$flag="edit";
	//header('Location: email_config.php?act=view&tips='.$tips);
	include_once('templates/email_config.html');
}

//发送测试邮件
if(isset($_REQUEST['act']) && $_REQUEST['act'] == 'test_email')
{
	$email = isset($_REQUEST['email']) ? $_REQUEST['email'] : '';
	$emails['send_account'] = '278955734@qq.com';
	$emails['send_name'] = '杨理鹏';
	$emails['to'] = $email;
	$emails['name'] = '亿商客服';
	$emails['subject'] = 'This is a test subject---亿商';
	$emails['email_content'] = '测试邮件，smtp可以使用！';
	
	$smtp = get_smtp();
	print_r($smtp);
	
	
	if($smtp['is_smtp'] == '2')
	{
		echo smtp_send_mail($smtp,$emails);
	}else
	{
 		echo send_mail($email,$emails['subject'],$emails['email_content'],$emails['send_name']);
	}
	
}
if(isset($_REQUEST['act']) && $_REQUEST['act'] == 'del')
{
	$t_ids = isset($_REQUEST['id']) ? $_REQUEST['id'] : 0;
	$t_idarr = explode("-", $t_ids);

	foreach ($t_idarr as $t_id){
		if($t_id != ''){
			delete_email_config($t_id);
		}
	}
	header('Location: email_config.php?act=view');	
}
?>