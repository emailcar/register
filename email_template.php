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

if(isset($_REQUEST['act']) && $_REQUEST['act'] == 'list')
{
	$page_title = "所有模版信息";
	$page_size = 15;//每页显示条数
	$page_index = 1;//页码
	$numeric_count = 5;//索引长度

	$page_index = isset($_REQUEST['page_index']) ? $_REQUEST['page_index'] : 1;

	$selectCount=find_template_count();
	$page = find_email_list($page_size,$page_index,$numeric_count);
	include_once('templates/email_template_list.html');
}

if(isset($_REQUEST['act']) && $_REQUEST['act'] == 'add')
{
	$act='add';
	//添加
	if(isset($_REQUEST['flag']) && $_REQUEST['flag'] == 'add')
	{
		$temp=array();
		$temp_id = isset($_REQUEST['id']) ? $_REQUEST['id'] : 0;
		$temp_name = isset($_REQUEST['temp_name']) ? $_REQUEST['temp_name'] : '';
		$email_type = isset($_REQUEST['email_type']) ? $_REQUEST['email_type'] : '';
		$temp_content = isset($_REQUEST['temp_content']) ? $_REQUEST['temp_content'] : '';
		$send_account = isset($_REQUEST['send_account']) ? $_REQUEST['send_account'] : '';
		$email_title = isset($_REQUEST['email_title']) ? $_REQUEST['email_title'] : '';
		$send_name = isset($_REQUEST['send_name']) ? $_REQUEST['send_name'] : '';
		$temp['temp_id'] = $temp_id;
		$temp['template_name'] = $temp_name;
		$temp['type_id'] = $email_type;
		$temp['content'] = $temp_content;
		$temp['send_account'] = $send_account;
		$temp['email_title'] = $email_title;
		$temp['send_name'] = $send_name;
		if(save_email_template($temp))
		{
			echo "<meta http-equiv='refresh' content='1;url=email_template.php?act=list'>";
			$tips="添加成功！";
		}else
		{
			$tips="添加失败！";
		}
		$flag='edit';
	}else//初始化
	{
		$flag="add";
	}
	$email_type_list = find_email_type_list();
	include_once('templates/email_template.html');
}

if(isset($_REQUEST['act']) && $_REQUEST['act'] == 'edit')
{
	$act='edit';
	$temp_id = isset($_REQUEST['id']) ? $_REQUEST['id'] : 0;
	
	//修改
	if(isset($_REQUEST['flag']) && $_REQUEST['flag'] == 'edit')
	{
		$temp_id = isset($_REQUEST['id']) ? $_REQUEST['id'] : 0;
		$temp_name=isset($_REQUEST['temp_name']) ? $_REQUEST['temp_name'] : '';
		$email_type=isset($_REQUEST['email_type']) ? $_REQUEST['email_type'] : '';
		$temp_content=isset($_REQUEST['temp_content']) ? $_REQUEST['temp_content'] : '';

		$send_account = isset($_REQUEST['send_account']) ? $_REQUEST['send_account'] : '';
		$email_title = isset($_REQUEST['email_title']) ? $_REQUEST['email_title'] : '';
		$send_name = isset($_REQUEST['send_name']) ? $_REQUEST['send_name'] : '';
		if(update_email_template($temp_id,$temp_name,$email_type,$temp_content,$send_account,$email_title,$send_name))
		{
			echo "<meta http-equiv='refresh' content='0;url=email_template.php?act=list'>";
			$tips="修改成功！";
		}else
		{
			$tips="修改失败！";
		}
		
	}else//查看
	{
		$temp=find_template_details($temp_id);
	}
	$flag="edit";
	$email_type_list = find_email_type_list();
	include_once('templates/email_template.html');
}
if(isset($_REQUEST['act']) && $_REQUEST['act'] == 'del')
{
	$t_ids = isset($_REQUEST['id']) ? $_REQUEST['id'] : 0;
	$t_idarr = explode("-", $t_ids);

	foreach ($t_idarr as $t_id){
		if($t_id != ''){
			delete_template($t_id);
		}
	}
	header('Location: email_template.php?act=list');	
}

?>