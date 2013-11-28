<?php

define('YSPAY', true);

require(dirname(__FILE__) . '/includes/init.php');

if(!isset($_SESSION['user'])|| $_SESSION['user'] != 'yishang')
{
	header('Location: login.php');	
	exit;
}

if(isset($_REQUEST['act']) && $_REQUEST['act'] == 'view')
{
	$page_title = "邮件服务器配置";

	$email_config=get_smtp();
	include_once('templates/email_config.html');
}
//修改
if(isset($_REQUEST['act']) && $_REQUEST['act'] == 'edit')
{

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
	header('Location: email_config.php?act=view&tips='.$tips);
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

	
	
	if($smtp['is_smtp'] == '2')
	{
		echo smtp_send_mail($smtp,$emails);
	}else
	{
 		echo send_mail($email,$emails['subject'],$emails['email_content'],$emails['send_name']);
	}
	
}
?>