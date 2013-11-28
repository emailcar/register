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
	
	$group_id = isset($_REQUEST['group_id']) ? $_REQUEST['group_id'] : 0;
	
	$page = find_site_list($page_size,$page_index,$numeric_count,$group_id);
	include_once('templates/site_list.html');
}

if(isset($_REQUEST['act']) && $_REQUEST['act'] == 'auto')
{
	$order_list = $db->getall("SELECT ys_order_id, from_site, return_url, codekey FROM ys_orders GROUP BY from_site");
	
	foreach($order_list as $order)
	{
		$site_count = $db->getone("SELECT count(*) FROM ys_sites WHERE site_url = '$order[from_site]'");
		
		$site_id = 0;
		
		if(!$site_count)
		{
			$site = array();
			$site['group_id'] = 1;
			$site['site_url'] = $order['from_site'];
			$site['return_url'] = $order['return_url'];
			$site['codekey'] = $order['codekey'];
			$site['site_operator'] = '';
			$site['remark'] = '';
			$GLOBALS['db']->autoExecute('ys_sites', $site, 'INSERT');
			
			$site_id = $db->insert_id();
		}else
		{
			$site_id = $db->getone("SELECT site_id FROM ys_sites WHERE site_url = '$order[from_site]'");
		}
		
		$up_order = array();
		$up_order['site_id'] = $site_id;
		
		$GLOBALS['db']->autoExecute('ys_orders', $up_order, 'UPDATE', "from_site = '$order[from_site]'");
	}
	
	echo '<script type="text/javascript">alert("处理完成!");window.location.href="sites.php?act=list";</script>';
}

if(isset($_REQUEST['act']) && $_REQUEST['act'] == 'add')
{
	$groups = $db->getall("SELECT group_id, group_name FROM ys_groups");
	include_once('templates/site_add.html');
}

if(isset($_REQUEST['act']) && $_REQUEST['act'] == 'do_add')
{
	$site = array();
	$site['site_url'] = $_REQUEST['site_url'] ?  $_REQUEST['site_url'] : '';
	$site['group_id'] = $_REQUEST['group_id'] ?  $_REQUEST['group_id'] : 0;
	$site['return_url'] = $_REQUEST['return_url'] ?  $_REQUEST['return_url'] : '';
	$site['codekey'] = $_REQUEST['codekey'] ?  $_REQUEST['codekey'] : '';
	$site['site_operator'] = $_REQUEST['site_operator'] ?  $_REQUEST['site_operator'] : '';
	$site['remark'] = $_REQUEST['remark'] ?  $_REQUEST['remark'] : '';
	if(!add_site_info($site))
	{
		echo '<script type="text/javascript">alert("该网址已经存在");window.location.href="sites.php?act=list";</script>';
	}
	else{
		echo '<script type="text/javascript">alert("添加成功!");window.location.href="sites.php?act=list";</script>';
	}
}

if(isset($_REQUEST['act']) && $_REQUEST['act'] == 'edit')
{
	$groups = $db->getall("SELECT group_id, group_name FROM ys_groups");
	$site_id = isset($_REQUEST['id']) ? $_REQUEST['id'] : 0;
	$site = find_site_info($site_id);
	include_once('templates/site_edit.html');
}

if(isset($_REQUEST['act']) && $_REQUEST['act'] == 'do_edit')
{
	$site_id = isset($_REQUEST['id']) ? $_REQUEST['id'] : 0;
	
	$site = array();
	$site['site_id'] = $site_id;
	$site['site_url'] = $_REQUEST['site_url'] ?  $_REQUEST['site_url'] : '';
	$site['group_id'] = $_REQUEST['group_id'] ?  $_REQUEST['group_id'] : 0;
	$site['return_url'] = $_REQUEST['return_url'] ?  $_REQUEST['return_url'] : '';
	$site['codekey'] = $_REQUEST['codekey'] ?  $_REQUEST['codekey'] : '';
	$site['site_operator'] = $_REQUEST['site_operator'] ?  $_REQUEST['site_operator'] : '';
	$site['remark'] = $_REQUEST['remark'] ?  $_REQUEST['remark'] : '';
	edit_site_info($site);
	echo '<script type="text/javascript">alert("修改成功!");window.location.href="sites.php?act=list";</script>';
}

if(isset($_REQUEST['act']) && $_REQUEST['act'] == 'del')
{
	$site_ids = isset($_REQUEST['id']) ? $_REQUEST['id'] : 0;
	$site_idsarr = explode("-", $site_ids);

	foreach ($site_idsarr as $site_id){
		if($site_id != ''){
			delete_site($site_id);
		}
	}
	header('Location: sites.php?act=list');
}

?>