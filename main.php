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

	$user_id = $_SESSION['user_admin']['0'];
    $user_name = $_SESSION['user_admin']['1'];
    $user_classify = $_SESSION['user_admin']['3'];
    if($user_id&&$user_name){
    }else{
        header('location:login.php');
        exit();
    }


$that_month = date("y-m");
$that_month_start = date("y-m").'-1 0:0:0';
$that_month_end = date("y-m-d").' 23:59:59';

$last_month = date("y-").(date("m")-1);
$last_month_start = date("y-").(date("m")-1).'-1 0:0:0';
$last_month_end = date("y-").(date("m")-1).'-31 23:59:59';


$sql = "SELECT * FROM ys_orders ";

$order_stats = array();
$order_stats[$that_month]['all_orders'] = $db->getone("SELECT count(*) FROM ys_orders WHERE order_time>= '$that_month_start' AND order_time<= '$that_month_end'");
$order_stats[$that_month]['pay_click_count'] = $db->getone("SELECT count(*) FROM ys_orders WHERE order_time>= '$that_month_start' AND order_time<= '$that_month_end' AND invoicesclick = 1");
$order_stats[$that_month]['not_pay'] = $db->getone("SELECT count(*) FROM ys_orders WHERE order_time>= '$that_month_start' AND order_time<= '$that_month_end' AND pay_status = 0");
$order_stats[$that_month]['ok_pay'] = $db->getone("SELECT count(*) FROM ys_orders WHERE order_time>= '$that_month_start' AND order_time<= '$that_month_end' AND pay_status = 1");
$order_stats[$that_month]['no_pay'] = $db->getone("SELECT count(*) FROM ys_orders WHERE order_time>= '$that_month_start' AND order_time<= '$that_month_end' AND pay_status = 2");
$order_stats[$that_month]['confirm'] = $db->getone("SELECT count(*) FROM ys_orders WHERE order_time>= '$that_month_start' AND order_time<= '$that_month_end' AND pay_status = 3");
$order_stats[$that_month]['paypal'] = $db->getone("SELECT count(*) FROM ys_orders WHERE order_time>= '$that_month_start' AND order_time<= '$that_month_end' AND pay_name = 'Paypal'");
$order_stats[$that_month]['yspay'] = $db->getone("SELECT count(*) FROM ys_orders WHERE order_time>= '$that_month_start' AND order_time<= '$that_month_end' AND pay_name = 'yspay'");


if($db->getone("SELECT count(*) FROM ys_orders WHERE order_time>= '$last_month_start' AND order_time<= '$last_month_end'")>0)
{
$order_stats[$last_month]['all_orders'] = $db->getone("SELECT count(*) FROM ys_orders WHERE order_time>= '$last_month_start' AND order_time<= '$last_month_end'");
$order_stats[$last_month]['pay_click_count'] = $db->getone("SELECT count(*) FROM ys_orders WHERE order_time>= '$last_month_start' AND order_time<= '$last_month_end' AND invoicesclick = 1");
$order_stats[$last_month]['not_pay'] = $db->getone("SELECT count(*) FROM ys_orders WHERE order_time>= '$last_month_start' AND order_time<= '$last_month_end' AND pay_status = 0");
$order_stats[$last_month]['ok_pay'] = $db->getone("SELECT count(*) FROM ys_orders WHERE order_time>= '$last_month_start' AND order_time<= '$last_month_end' AND pay_status = 1");
$order_stats[$last_month]['no_pay'] = $db->getone("SELECT count(*) FROM ys_orders WHERE order_time>= '$last_month_start' AND order_time<= '$last_month_end' AND pay_status = 2");
$order_stats[$last_month]['confirm'] = $db->getone("SELECT count(*) FROM ys_orders WHERE order_time>= '$last_month_start' AND order_time<= '$last_month_end' AND pay_status = 3");
$order_stats[$last_month]['paypal'] = $db->getone("SELECT count(*) FROM ys_orders WHERE order_time>= '$last_month_start' AND order_time<= '$last_month_end' AND pay_name = 'Paypal'");
$order_stats[$last_month]['yspay'] = $db->getone("SELECT count(*) FROM ys_orders WHERE order_time>= '$last_month_start' AND order_time<= '$last_month_end' AND pay_name = 'yspay'");
}
	
//include_once('templates/main.html');/*原先订单模板*/
include_once('templates/main_flotr.html');
?>