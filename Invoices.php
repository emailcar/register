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

if(isset($_REQUEST['id']))
{
	$_SESSION['id']=$_REQUEST['id'];
	$_SESSION['payname']=$_REQUEST['payname'];
	header('Location: Invoices.php');	
	exit;
}


if(!isset($_SESSION['id']))
{
	header('Location: login.php');	
	exit;
}


if(isset($_SESSION['id']))
{
	$order_id = isset($_SESSION['id']) ? $_SESSION['id'] : 0;
	$order_details = find_order_details($order_id);
	$order_products = find_order_products($order_id);
	$email_list = find_email($order_id);
	$email_type_list = find_email_type_list();
	
	
	if(isset($_REQUEST['view']) && $_REQUEST['view'] == 'true')
	{
	include_once('templates/order_details.html');
	}else
	{

	update_invoicesclick($_SESSION['id'],1);//修改发票链接点击状态

    $pay_type = $order_details['pay_name'];//支付类型
	//$codekey = $_POST['codekey'];  //密匙
	$codekey = "fjkdslikl"; 
	$gateway = $order_details['pay_name']; //支付通道
	if(isset($_SESSION['payname']))
	{
		$gateway=$_SESSION['payname'];
	}


	
	$payment = array();
	$payment['cancel_return'] = '';
	$payment['codekey'] = $codekey;
	$payment['currency'] = 'USD'; //货币
	$payment['language'] = 'EN'; //语种

	
	//$order_info = passprot_decode(passport_decrypt($_POST['order_info'],$codekey)); //订单信息
	//$goods_list = $_POST['goods_list'];	//商品信息
	$goods_list = find_order_products($order_id); //商品信息
	

	include_once('includes/payment/' . $gateway . '.php');
	
	$pay_obj    = new $gateway;
	
	$pay_info = $pay_obj->get_code($payment,$order_details,$goods_list);
	
	if($order_details['pay_status']==1){
	$pay_info = '<a type="font-size:18px;">Warning:Payment have finished!</a>';
	}
	
   }
	
}

?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Payment</title>
<script type="text/javascript" src="https://www.billingcheckout.com/risk/index.js"></script>
</head>

<body style="text-align:center;">
<?php echo $pay_info;?>
<script type="text/javascript">
document.getElementById("payform").submit();
</script>
</body>
</html>