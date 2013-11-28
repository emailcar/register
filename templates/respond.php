<?php

/**
 * 亿商网络 支付响应页面
 * ============================================================================
 * ----------------------------------------------------------------------------
 * 这不是一个自由软件！您只能在不用于商业目的的前提下对程序代码进行修改和
 * 使用；不允许对程序代码以任何形式任何目的的再发布。
 * ============================================================================
 * $Author: hulinying $
 */
define('YSPAY', true);
 
 /* 支付方式代码 */
$pay_code = isset($_REQUEST['code']) ? trim($_REQUEST['code']) : '';

$msg = '';
$pay_info = '';
/* 参数是否为空 */
if (empty($pay_code))
{
    $msg = 'Payment is nonexistent!';
}
elseif($pay_code == 'return')
{
	$url = @base64_decode($_REQUEST['str']);
	header('Location: '.$url);
	exit();
}
else{
	require(dirname(__FILE__) . '/includes/init.php');
	$plugin_file = dirname(__FILE__) .'/includes/payment/' . $pay_code . '.php';
		
	if (file_exists($plugin_file))
	{
		require_once($plugin_file);
		$payment = new $pay_code();
		$pay_result = $payment->respond();
		$order_info = find_order_info($pay_result['order_sn']);
		$site = find_site_info($order_info['site_id']);
		update_pay_status($order_info['ys_order_id'],$pay_result['pay_status']);
		update_returned($order_info['ys_order_id'],1,$pay_result['remark']);
		
		if($pay_result['pay_status'] == 1) //付款成功，发确认订单邮件
		{
			$email_type = 2; //邮件类型
			$email_temp = 14; //模版编号
			$temps = find_temp_email($email_temp);
			
			$userInfo=array();
			$orderInfo=array();
			$email_id = $order_info['ys_order_id'];

			$userInfo['email_account'] = $order_info['email']; //接收邮箱
			$userInfo['first_name'] = $order_info['first_name'];
			$userInfo['last_name'] = $order_info['last_name']; 
			$userInfo['address'] = $order_info['address'].','.$order_info['city'].','.$order_info['state'].','.$order_info['country'];  //地址
			$userInfo['zipcode'] = $order_info['zipcode'];       //邮编
			$userInfo['tel'] = $order_info['tel'];    //电话
			
			$orderInfo['from_site'] = $site['site_url']; //来源站点
			$orderInfo['order_sn'] = $order_info['order_sn']; //订单号
			$orderInfo['order_time'] = $order_info['order_time']; //下单时间
			$temp = get_email($userInfo,$email_id,$orderInfo,$email_type,$email_temp,$temps);
			$email_title = $temp['email_title'];
			$state=0;
			
			$smtp = get_smtp();
			
			$email=array();
			$email['t_id'] = $email_type;
			$email['temp_id'] = $email_temp;
			$email['email_content'] = str_replace("'","''",$temp['content']);
			$email['ys_order_id'] = $email_id;
			$email['to_mail'] = $userInfo['email_account'];
			$email['email_title'] = $email_title;

			if($smtp['is_smtp'] == '2')
			{
				$emails['email_content'] = $temp['content'];
				$emails['send_account'] = $temp['send_account'];
				$emails['send_name'] = $temp['send_name'];
				$emails['subject'] = $email_title;
				$emails['to'] = $email['to_mail'];
				$emails['name'] = $userInfo['first_name'].' '.$userInfo['last_name'];

				if(smtp_send_mail($smtp,$emails) == '1') //成功
				{
					update_confirm_email($email_id,2);
				}else //失败
				{
					$state=1;
					update_confirm_email($email_id,1);
				}
			}else
			{
				if(send_mail($email_account,$email_title,$temp['content'],$temp['send_account']))
				{
					$state=1;
					update_confirm_email($email_id,1);
				}else
				{
					update_confirm_email($email_id,2);
				}
			}
			
			$email['state'] = $state;
			add_email($email);
		}
		
		
		$pay_info  = '<form id="payform" action="'.$site['return_url'].'" method="post" target="_top">'.
			'<input type="hidden" name="codekey" value="'.$site['codekey'].'" />'.
			'<input type="hidden" name="order_sn" value="'.$order_info['order_sn'].'" />'.
			'<input type="hidden" name="succeed" value="1" />'.
			'<input type="hidden" name="message" value="'.$pay_result['remark'].'" />'.
			'</form>';
	}else{
		$msg = 'Payment is nonexistent!';
	}
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Payment</title>
</head>

<body>
<?php if($msg){?>
<h1><?php echo $msg ?></h1>
<?php }
else{ 
echo $pay_info; ?>
<script type="text/javascript">
document.getElementById("payform").submit();
</script>
<?php } ?>
</body>
</html>