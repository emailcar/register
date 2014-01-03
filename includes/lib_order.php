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
 * 保存订单信息
 *
 * @param array  订单信息
 * @param array  收货人信息
 * @param array  商品列表
 *
 * @return string 
 */
function save_order($order_info,$goods_list)
{
	$GLOBALS['db']->autoExecute('ys_orders', $order_info, 'INSERT');

	foreach($goods_list as $goods)
	{	
		$goods['ys_order_id'] = $order_info['ys_order_id'];
		$GLOBALS['db']->autoExecute('ys_orders_goods', $goods, 'INSERT');
	}
}

function isset_order($order)
{
	$sql = "SELECT COUNT(*) FROM ys_orders WHERE site_id = '$order[site_id]' AND order_id = '$order[order_id]' AND order_sn = '$order[order_sn]' ";
	return $GLOBALS['db']->getone($sql);
}
function order_count_add($order)
{
	$sql = "UPDATE ys_orders SET click_count = (click_count + 1) WHERE site_id = '$order[site_id]' AND order_id = '$order[order_id]' AND order_sn = '$order[order_sn]' ";
	$GLOBALS['db']->query($sql);
}

/**
 * 更改订单状态
 *
 * @param array  订单支付结果
 *
 * @return string 
 */
function update_pay_status($ys_order_id,$pay_status)
{
	$sql = "UPDATE ys_orders SET pay_status = $pay_status WHERE ys_order_id = '$ys_order_id'" ;
	
	$GLOBALS['db']->query($sql);
}
/**
*更改登记人员标记状态
*@param array 标记状态
*
*return string
*/
function update_reg_status($register_id, $register_status)
{
	$sql = 'UPDATE user_news SET user_sign = '.$register_status.' WHERE id = '.$register_id.'' ;
	$GLOBALS['db']->query($sql);
}

/**
 * 更改发货状态
 *
 * @param array  订单支付结果
 *
 * @return string 
 */
function update_shipments_status($ys_order_id,$shipments_status)
{
	$sql = "UPDATE ys_orders SET shipments_status = $shipments_status WHERE ys_order_id = '$ys_order_id'" ;
	
	$GLOBALS['db']->query($sql);
}

/**
 * 更改返回状态
 *
 * @param array  返回状态
 *
 * @return string 
 */
function update_returned($ys_order_id,$is_returned,$remark)
{
	$sql = "UPDATE ys_orders SET is_returned = $is_returned, remark = '$remark' WHERE ys_order_id = '$ys_order_id'" ;
	
	$GLOBALS['db']->query($sql);
}

/**
 * 更改屏蔽信息
 *
 * @param array  
 *
 * @return string 
 */
function update_shielded_info($ys_order_id,$shielded_info)
{

	$sql = "UPDATE ys_orders SET shielded_info = '$shielded_info' WHERE ys_order_id = '$ys_order_id'" ;
	
	$GLOBALS['db']->query($sql);
}

/**
 * 查询订单详情
 *
 * @param $ys_order_id  订单ID
 *
 * @return array 
 */
function find_order_details($ys_order_id)
{
	$sql = "SELECT o.*,s.* FROM ys_orders as o LEFT JOIN ys_sites as s ON o.site_id = s.site_id WHERE o.ys_order_id = '$ys_order_id'";
	return $GLOBALS['db']->getrow($sql);
}

/**
*登记人员详细页面查询
**/
function find_rigister_news($user_id){
	$sql = "SELECT * FROM user_news where id = '$user_id'";
	//echo $sql;
	return $GLOBALS['db']->getrow($sql);
}
/**
*修改登记人员页面
*
**/
function find_user_news($manage_new){
	$GLOBALS['db']->autoExecute('user_news', $manage_new, 'UPDATE', "id = $manage_new[id]");
}

/**
 * 查询订单详情
 *
 * @param $ys_order_id  订单ID
 *
 * @return array 
 */
function find_order_info($id)
{
	$sql = "SELECT * FROM ys_orders WHERE ys_order_id = '$id' or order_sn = '$id'";
	return $GLOBALS['db']->getrow($sql);
}

/**
 * 查询订单商品列表
 *
 * @param $order_id  订单ID
 *
 * @return array 
 */
function find_order_products($ys_order_id)
{
	$sql = "SELECT * FROM ys_orders_goods WHERE ys_order_id = '$ys_order_id'";
	return $GLOBALS['db']->getall($sql);
}

/**
 * 删除订单
 *
 * @param $ys_order_id  订单ID
 *
 * @return array 
 */
function delete_order($ys_order_id)
{
	$sql = "DELETE FROM ys_orders WHERE ys_order_id = '$ys_order_id'";
	$GLOBALS['db']->query($sql);
	$sql = "DELETE FROM ys_orders_goods WHERE ys_order_id = '$ys_order_id'";
	$GLOBALS['db']->query($sql);
}
function delete_register($ys_order_id){
	$sql = "DELETE FROM user_news WHERE id = '$ys_order_id'";
	$GLOBALS['db']->query($sql);
}

/**
 * 修改发票链接点击状态
 *
 * @param $ys_order_id  订单ID
 *
 * @return array 
 */
function update_invoicesclick($ys_order_id,$invoicesclick)
{
	$sql = "update ys_orders set invoicesclick='$invoicesclick' where ys_order_id = '$ys_order_id'";
	$GLOBALS['db']->query($sql);
}

/**
 * 分页查询订单信息
 *
 * @param $page_size  每页显示条数
 * @param $page_index  当前页码
 * @param $numeric_count  索引长度
 * @param $start_time  开始时间
 * @param $end_time  结束时间
 *
 * @return array 
 */
function find_order_list($page_size,$page_index,$numeric_count,$start_time = 0,$end_time = 0,$order_sn,$url,$state,$site_id)
{
	$sql = "SELECT o.*,s.* FROM ys_orders as o LEFT JOIN ys_sites as s ON o.site_id=s.site_id WHERE 1=1";
	if($order_sn)
	{
		$sql.= " and o.order_sn='".$order_sn."'";
	}
	if($url)
	{
		$sql.= " and s.site_url='".$url."'";
	}
	if($site_id)
	{
		$sql.= " and s.site_id in(".$site_id.")";
	}
	if($state != "4")
	{
		$sql.= " and pay_status=".$state;
	}
	if($start_time&&$end_time)
	{
		$sql .= " and o.order_time>= '$start_time' and o.order_time<= '$end_time'";
	}
	$pcount = ($page_index - 1) * $page_size;
	$sql .= " ORDER BY o.order_time DESC LIMIT $pcount,$page_size";
	
	$res = $GLOBALS['db']->getall($sql);
	
	$page = new cls_page();
	$page->set_page($page_size, $page_index, find_order_count($start_time,$end_time,$order_sn,$url,$state,$site_id,''), $res,$numeric_count);
	return $page;
}

/**
 * 查询订单总量
 *
 * @param $start_time  开始时间
 * @param $end_time  结束时间
 *
 * @return int 
 */
function find_order_count($start_time = 0,$end_time = 0,$order_sn,$url,$state,$site_id,$invoicesclick)
{
	$sql = "SELECT count(*) FROM ys_orders as o LEFT JOIN ys_sites as s ON o.site_id=s.site_id WHERE 1=1";
	if($order_sn)
	{
		$sql.= " and o.order_sn='".$order_sn."'";
	}
	if($url)
	{
		$sql.= " and s.site_url='".$url."'";
	}
	if($site_id)
	{
		$sql.= " and s.site_id in(".$site_id.")";
	}
	if($state != "4")
	{
		$sql.= " and o.pay_status=".$state;
	}
	if($invoicesclick)
	{
		$sql.= " and o.invoicesclick=".$invoicesclick;
	}
	if($start_time&&$end_time)
	{
		$sql .= " and o.order_time>= '$start_time' and o.order_time<= '$end_time'";
	}
	return $GLOBALS['db']->getone($sql);
}
/**
 * 登记人数信息
 *
 * @param $page_size  每页显示条数
 * @param $page_index  当前页码
 * @param $numeric_count  索引长度
 * @param $start_time  开始时间
 * @param $end_time  结束时间
 *
 * @return array 
 */
function register_get_mysql($page_size,$page_index,$numeric_count,$start_time,$end_time,$news_name,$computer_name,$state,$site_id,$news_State,$user_last,$user_first,$news_source){
	$pcount = ($page_index - 1) * $page_size;
	//print '页数：'.$pcount;
	//echo '开始时间'.$start_time;
	$sql = 'SELECT * FROM user_news WHERE 1=1';
	if($news_name){
		$sql.= ' AND id = '.$news_name.'';
	}
	if($user_last){
		$sql.= " AND user_last_name = '$user_last'";
	}
	if($user_first){
		$sql.= " AND user_first_name = '$user_first'";
	}
	if($computer_name){
		$sql.=" AND user_company = '$computer_name'";
	}
	if($news_State){
			$sql.= ' AND user_sign != 0';
	}elseif($news_State=='0'){
			$sql.= ' AND user_sign = '.$news_State.'';
	}
	if($news_source){
		$sql.= ' AND user_source !=0';
	}elseif($news_source=='0'){
		$sql.= ' AND user_source = 0';
	}

	if($start_time){
		$sql.= ' AND date>\''.$start_time.'\' and date<\''.$end_time.'\' ORDER BY  `date` DESC LIMIT '.$pcount.','.$page_size.'';
	}else{
		$sql.= ' AND date<\''.$end_time.'\' ORDER BY  `date` DESC LIMIT '.$pcount.','.$page_size.'';
		}
	
	//echo $sql;
	$res = $GLOBALS['db']->getall($sql);
	$page = new cls_page();
	$page->set_page($page_size, $page_index, fint_numeric_count($start_time,$end_time,$news_name,$computer_name,$state,$site_id,'',$news_State,$user_last,$user_first,$news_source), $res,$numeric_count);
	return $page;

}
//获取登记人员总数
function fint_numeric_count($start_time,$end_time,$news_name,$computer_name,$state,$site_id,$invoicesclick,$news_State,$user_last,$user_first,$news_source){
	$sql = 'SELECT * FROM user_news WHERE 1=1';
	if($news_name){
		$sql.= ' AND id = '.$news_name.'';
	}
	if($user_last){
		$sql.= " AND user_last_name = '$user_last'";
	}
	if($user_first){
		$sql.= " AND user_first_name = '$user_first'";
	}
	if($computer_name){
		$sql.=" AND user_company = '$computer_name'";
	}
	if($news_State){
			$sql.= ' AND user_sign != 0';
	}elseif($news_State=='0'){
			$sql.= ' AND user_sign = '.$news_State.'';
	}
	if($news_source){
		$sql.= ' AND user_source !=0';
	}elseif($news_source=='0'){
		$sql.= ' AND user_source = 0';
	}
	
	if($start_time){
		$sql.= ' AND date>\''.$start_time.'\' AND date<\''.$end_time.'\' ';
	}else{
		$sql.= ' AND date<\''.$end_time.'\' ';
	}
	
	return $GLOBALS['db']->get_register_one($sql);//条件查询总人数
}
/**
*查询登记人数总量
*
*/
function register_get_number($start_time,$end_time){
	//echo '开始时间'.$start_time;
	if($start_time){
		$sql = 'SELECT * FROM user_news  WHERE date>\''.$start_time.'\' and date<\''.$end_time.'\' ';
	}else{
		$sql = 'SELECT * FROM user_news WHERE date<\''.$end_time.'\' ';
	}
	//echo $sql;
	$res = $GLOBALS['db']->get_register_one($sql);
	return $res;
}
/**
 * 查询订单总金额
 *
 * @param $start_time  开始时间
 * @param $end_time  结束时间
 *
 * @return int 
 */
function find_order_amount($start_time = 0,$end_time = 0,$order_sn,$url,$state,$site_id)
{
	$sql = "SELECT sum(order_amount) FROM ys_orders as o LEFT JOIN ys_sites as s ON o.site_id=s.site_id WHERE 1=1";
	if($order_sn)
	{
		$sql.= " and o.order_sn='".$order_sn."'";
	}
	if($url)
	{
		$sql.= " and s.site_url='".$url."'";
	}
	if($site_id)
	{
		$sql.= " and s.site_id in(".$site_id.")";
	}
	if($state != "4")
	{
		$sql.= " and o.pay_status=".$state;
	}
	if($start_time&&$end_time)
	{
		$sql .= " and o.order_time>= '$start_time' and o.order_time<= '$end_time'";
	}
	return $GLOBALS['db']->getone($sql);
}

/**
 * 更改来源状态
 *
 * @param array 
 *
 * @return string 
 */
function update_from($ys_order_id,$from)
{
	$sql = "UPDATE ys_orders SET order_from = '$from' WHERE ys_order_id = '$ys_order_id'" ;
	$GLOBALS['db']->query($sql);
}

?>