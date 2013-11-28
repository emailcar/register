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
set_time_limit(0);
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
	$page_size = 15;//每页显示条数
	$page_index = 1;//页码
	$numeric_count = 5;//索引长度
	$page_index = isset($_REQUEST['page_index']) ? $_REQUEST['page_index'] : 1;
	
	$page = find_group_list($page_size,$page_index,$numeric_count);
	include_once('templates/group_list.html');
}

if(isset($_REQUEST['act']) && $_REQUEST['act'] == 'add')
{
	
	include_once('templates/group_add.html');
}

if(isset($_REQUEST['act']) && $_REQUEST['act'] == 'do_add')
{
	$group = array();
	$group['group_name'] = $_REQUEST['group_name'] ?  $_REQUEST['group_name'] : '';
	$group['remark'] = $_REQUEST['remark'] ?  $_REQUEST['remark'] : '';

	if(!add_group_info($group))
	{
		echo '<script type="text/javascript">alert("该分组已经存在");window.location.href="groups.php?act=list";</script>';
	}
	else{
		echo '<script type="text/javascript">alert("添加成功!");window.location.href="groups.php?act=list";</script>';
	}
}

if(isset($_REQUEST['act']) && $_REQUEST['act'] == 'edit')
{
	$group_id = isset($_REQUEST['id']) ? $_REQUEST['id'] : 0;
	$group = find_group_info($group_id);
	include_once('templates/group_edit.html');
}

if(isset($_REQUEST['act']) && $_REQUEST['act'] == 'do_edit')
{
	$group_id = isset($_REQUEST['id']) ? $_REQUEST['id'] : 0;
	$group = array();
	$group['group_id'] = $group_id;
	$group['group_name'] = $_REQUEST['group_name'] ?  $_REQUEST['group_name'] : '';
	$group['remark'] = $_REQUEST['remark'] ?  $_REQUEST['remark'] : '';
	edit_group_info($group);
	echo '<script type="text/javascript">alert("修改成功!");window.location.href="groups.php?act=list";</script>';
}

if(isset($_REQUEST['act']) && $_REQUEST['act'] == 'del')
{
	$group_ids = isset($_REQUEST['id']) ? $_REQUEST['id'] : 0;
	$group_idsarr = explode("-", $group_ids);

	foreach ($group_idsarr as $group_id){
		if($group_id != ''){
			delete_group($group_id);
		}
	}
	header('Location: groups.php?act=list');	
}

?>