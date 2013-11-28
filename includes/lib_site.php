<?php

/**
 * ECSHOP 订单函数库
 * ============================================================================
 * ----------------------------------------------------------------------------
 * 这不是一个自由软件！您只能在不用于商业目的的前提下对程序代码进行修改和
 * 使用；不允许对程序代码以任何形式任何目的的再发布。
 * ============================================================================
*/

if (!defined('YSPAY'))
{
    die('Hacking attempt');
}

/**
 * 分页显示分组信息
 *
 * @param $page_size  每页显示条数
 * @param $page_index  当前页码
 * @param $numeric_count  索引长度
 *
 * @return array 
 */
function find_group_list($page_size,$page_index,$numeric_count)
{
	$sql = "SELECT * FROM ys_groups";
	$pcount = ($page_index - 1) * $page_size;
	$sql .= " ORDER BY group_id DESC LIMIT $pcount,$page_size";
	$res = $GLOBALS['db']->getall($sql);
	
	$page = new cls_page();
	$page->set_page($page_size, $page_index, find_group_count(), $res,$numeric_count);
	return $page;
}
/**
*
*查询人员列表
*
**/
function find_manage_products($page_size,$page_index,$numeric_count)
{
	$sql = "SELECT * FROM ys_admin";
	$pcount = ($page_index - 1) * $page_size;
	$sql .= " ORDER BY id DESC LIMIT $pcount,$page_size";
	$res = $GLOBALS['db']->getall($sql);
	$page = new cls_page();
	$page->set_page($page_size, $page_index, find_group_count(), $res,$numeric_count);
	return $page;
}


/**
 * 查询分组信息总量
 *
 * @return int 
 */
function find_group_count()
{
	$sql = "SELECT count(*) FROM ys_groups";
	return $GLOBALS['db']->getone($sql);
}

/**
 * 查询分组信息详情
 *
 * @param $id  分组ID
 *
 * @return array 
 */
function find_group_info($id)
{
	$sql = "SELECT * FROM ys_groups WHERE group_id = '$id'";
	return $GLOBALS['db']->getrow($sql);
}

/**
 * 修改分组信息
 *
 * @param $id  分组ID
 *
 * @return array 
 */
function edit_group_info($group)
{
	$GLOBALS['db']->autoExecute('ys_groups', $group, 'UPDATE', "group_id = $group[group_id]");
}
/**
*修改职员信息
*@param array $msnsgr_new 新信息 array $manage_old 老信息
**/
function edit_manage_user($manage_new){
		$GLOBALS['db']->autoExecute('ys_admin', $manage_new, 'UPDATE', "id = $manage_new[id]");
}
/**
 * 增加分组信息
 *
 * @param $id  分组ID
 *
 * @return array 
 */
function add_group_info($group)
{
	$count = $GLOBALS['db']->getone("SELECT count(*) FROM ys_groups WHERE group_name = '$group[group_name]'");
	if(!$count)
	{
		$GLOBALS['db']->autoExecute('ys_groups', $group, 'INSERT');
		return 1;
	}
	else{
		return 0;
	}
}
/**
*添加处理登记人员的职员
**/
function add_manage_admin($manage_add_name,$manage_add_number,$manage_add_classify,$manage_add_remark){
	$count = $GLOBALS['db']->getone("SELECT * FROM ys_admin WHERE admin_number = '$manage_add_number'");
	$sql = "INSERT INTO ys_admin (id,admin_name,admin_password,user_classify,admin_number,admin_remark) VALUES (NULL,'$manage_add_name',md5('123456'),'$manage_add_classify','$manage_add_number','$manage_add_remark')";
	if(!$count){
		$GLOBALS['db']->query($sql);
		return 1;
	}else{
		return 0;
	}
}
/**
 * 删除分组信息
 *
 * @param $id  分组ID
 *
 * @return array 
 */
function delete_group($id)
{
	$sql = "DELETE FROM ys_groups WHERE group_id = '$id'";
	$GLOBALS['db']->query($sql);
}
/**
*删除处理登记人员的职员
*/
function delete_manage_admin($manage_id){
	$sql = "DELETE FROM ys_admin WHERE id = '$manage_id'";
	$GLOBALS['db']->query($sql);
}


/**
 * 分组显示网站信息
 *
 * @param $page_size  每页显示条数
 * @param $page_index  当前页码
 * @param $numeric_count  索引长度
 *
 * @return array 
 */
function find_site_list($page_size,$page_index,$numeric_count,$group_id)
{
	$sql = "SELECT s.*, (SELECT group_name FROM ys_groups WHERE group_id = s.group_id) as group_name FROM ys_sites as s WHERE 1=1";
	if($group_id)
	{
		$sql.= " and s.group_id=".$group_id."";
	}
	$pcount = ($page_index - 1) * $page_size;
	$sql .= " ORDER BY site_id DESC LIMIT $pcount,$page_size";
	$res = $GLOBALS['db']->getall($sql);
	
	$page = new cls_page();
	$page->set_page($page_size, $page_index, find_site_count($group_id), $res,$numeric_count);
	return $page;
}

/**
 * 查询网站信息总量
 *
 * @return int 
 */
function find_site_count($group_id)
{
	$sql = "SELECT count(*) FROM ys_sites WHERE 1=1";
	if($group_id)
	{
		$sql.= " and group_id=".$group_id."";
	}
	return $GLOBALS['db']->getone($sql);
}

/**
 * 根据分组查询网站ID 
 *
 * @param $id  分组ID
 *
 * @return array 
 */
function find_site_ids($group_id)
{
	$sites = $GLOBALS['db']->getall("SELECT site_id FROM ys_sites WHERE group_id = '$group_id'");
	$site_ids = array();
	foreach($sites as $site)
	{
		$site_ids[] = $site['site_id'];
	}
	return $site_ids;
}

/**
 * 查询网站信息详情
 *
 * @param $id  分组ID
 *
 * @return array 
 */
function find_site_info($id)
{
	$sql = "SELECT * FROM ys_sites WHERE site_id = '$id'";
	return $GLOBALS['db']->getrow($sql);
}
/**
*查询单个职员详细信息
*
**/
function find_manage_user($manage_id){
	$sql = "SELECT * FROM ys_admin WHERE id = '$manage_id'";
	return $GLOBALS['db']->getrow($sql);
}
/**
*查询单个用户信息
*/
function find_edit_user($user_id){
	$sql = "SELECT * FROM user_news WHERE id = '$user_id'";
	return $GLOBALS['db']->getrow($sql);
}
/**
 * 修改网站信息
 *
 * @param $id  分组ID
 *
 * @return array 
 */

function edit_site_info($site)
{
	$GLOBALS['db']->autoExecute('ys_sites', $site, 'UPDATE', "site_id = $site[site_id]");
}

/**
 * 增加网站信息
 *
 * @param $id  分组ID
 *
 * @return array 
 */
function add_site_info($site)
{
	$count = $GLOBALS['db']->getone("SELECT count(*) FROM ys_sites WHERE site_url = '$site[site_url]'");
	if(!$count&&$site['site_url'])
	{
		$GLOBALS['db']->autoExecute('ys_sites', $site, 'INSERT');
		return 1;
	}
	else{
		return 0;
	}
	
}

/**
 * 查询网站ID  如果没有则添加
 *
 * @param $id  分组ID
 *
 * @return array 
 */
function find_site_id($site)
{
	$site_id = $GLOBALS['db']->getone("SELECT site_id FROM ys_sites WHERE site_url = '$site[site_url]'");
	
	if(!$site_id)
	{
		$site['group_id'] = 1;
		$site['site_operator'] = '';
		$site['remark'] = '';
		$GLOBALS['db']->autoExecute('ys_sites', $site, 'INSERT');
		$site_id = $GLOBALS['db']->insert_id();
	}
	return $site_id;
}

/**
 * 删除网站信息
 *
 * @param $id  分组ID
 *
 * @return array 
 */
function delete_site($id)
{
	$sql = "DELETE FROM ys_sites WHERE site_id = '$id'";
	$GLOBALS['db']->query($sql);
}


?>