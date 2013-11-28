<?php

/**
 * 登录
 * ============================================================================
 * ----------------------------------------------------------------------------
 * 这不是一个自由软件！您只能在不用于商业目的的前提下对程序代码进行修改和
 * 使用；不允许对程序代码以任何形式任何目的的再发布。
 * ============================================================================
 * $Author: Peter.Hu $
*/

define('YSPAY', true);

require(dirname(__FILE__) . '/includes/init.php');

$messgae = '';
	
if(isset($_SESSION['user_admin']['0']) && $_SESSION['user_admin']['1'])
{
	header('Location: index.php');
	exit();
}
if(isset($_REQUEST['act']) && $_REQUEST['act'] == 'login')
{
	$username = $_POST['username'];
	$password = $_POST['password'];
	$user_admin = check_login($username,$password);
	if($user_admin['id'])
	{
		session_start();
		$_SESSION['user_admin'] = array($user_admin['id'],$user_admin['admin_name'],$user_admin['admin_password'],$user_admin['user_classify']);
		header('Location: index.php');
		exit();
	}else{
		$messgae = '用户名或密码错误!';
	}
}

include_once('templates/login.html');
?>