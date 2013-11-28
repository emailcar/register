<?php

/**
 * 亿商网络 支付接口
 * ============================================================================
 * ----------------------------------------------------------------------------
 * 这不是一个自由软件！您只能在不用于商业目的的前提下对程序代码进行修改和
 * 使用；不允许对程序代码以任何形式任何目的的再发布。
 * ============================================================================
 * $Author: hulinying $
 */
define('YSPAY', true);

require(dirname(__FILE__) . '/includes/init.php');

if(!isset($_SERVER["HTTP_REFERER"]))
{
	die('error');
}else{
	$url = gethost($_SERVER["HTTP_REFERER"]);
}

//发送邮件
function SendInoMail($order_info)
{
	$email_id = $order_info['ys_order_id'];
	$email_account = isset($order_info['email']) ? $order_info['email'] : ''; //接收邮箱
	if($email_id && $email_account)
	{
		$email_type = 1; //邮件类型
		
	//	$arry = array('17','15','16');
	//	$temp_id = rand(0,2);
	//  $email_temp = $arry[$temp_id];
		
		   //$sql="select t_id from ys_email_template where is_real=1";		
			//$email_temp=$GLOBALS['db']->getone($sql);
			
			//$sql_email_id="update ys_orders set template_id=".$email_temp." where ys_order_id=".$order_info['ys_order_id'];	
			//$GLOBALS['db']->query($sql_email_id);
			$sql_email_id="update ys_email_template set is_real=0 where is_real=1";	
			$GLOBALS['db']->query($sql_email_id);
			
			
			//$now_id=$email_temp+1;
			//if($now_id == 8)
			//{	
			$now_id=1;
			//}
			$sql_up_email_id="update ys_email_template set is_real=1 where t_id=".$now_id;	
			$GLOBALS['db']->query($sql_up_email_id);
		
		$email_temp = 1; //模版编号
		$userInfo=array();
		$orderInfo=array();
		$orderInfo['ys_order_id']=$order_info['ys_order_id'];
		$userInfo['email_account'] = $email_account;
		$userInfo['first_name'] = isset($order_info['first_name']) ? $order_info['first_name'] : '';
		$userInfo['last_name'] = isset($order_info['last_name']) ? $order_info['last_name'] : ''; 
		
		$userInfo['address'] =$order_info['address'].','.$order_info['city'].','.$order_info['state'].','.$order_info['country']; //地址
		$userInfo['zipcode'] = isset($order_info['zipcode']) ? $order_info['zipcode'] : '';       //邮编
		$userInfo['tel'] = isset($order_info['tel']) ? $order_info['tel'] : '';    //电话
		
		$orderInfo['from_site'] = $order_info['site_url']; //来源站点
		$orderInfo['order_sn'] = isset($order_info['order_sn']) ? $order_info['order_sn'] : ''; //订单号
		$orderInfo['order_time'] = isset($order_info['order_time']) ? $order_info['order_time'] : ''; //下单时间
		$temp = get_email($userInfo,$email_id,$orderInfo,$email_type,$email_temp);
		$email_title = $temp['email_title'];
		$state=0;
		
		
		$email=array();
		$email['t_id'] = $email_type;
		$email['temp_id'] = $email_temp;
		$email['email_content'] = str_replace("'","''",$temp['content']);
		$email['ys_order_id'] = $email_id;
		$email['to_mail'] = $email_account;
		$email['email_title'] = $email_title;
		
		
		
		$smtp = get_smtp_by_id($email_temp);
		
		if($smtp['is_smtp'] == '2')
		{
			$emails['email_content'] = $temp['content'];
			$emails['send_account'] = $temp['send_account'];
			$emails['send_name'] = $temp['send_name'];
			$emails['subject'] = $email_title;
			$emails['to'] = $email_account;
			$emails['name'] = $userInfo['first_name'].' '.$userInfo['last_name'];

			if(smtp_send_mail($smtp,$emails) == '1') //成功
			{
				$state=1;
				echo '<font color="red">发送成功</font>';
				update_confirm_email($email_id,1);
			}else //失败
			{
				echo '<font color="green">发送失败</font>';
				update_confirm_email($email_id,2);
			}
		}else
		{
			if(send_mail($email_account,$email_title,$temp['content'],$temp['send_account']))
			{
				$state=1;
				echo '<font color="green">发送成功</font>';
				update_confirm_email($email_id,1);
			}else
			{
				echo '<font color="red">发送失败</font>';
				update_confirm_email($email_id,2);
			}
		}
				
		$email['state'] = $state;
		add_email($email,$smtp['username']);
		
		
	}else
	{
		echo 'error';
	}
}




if($_POST['act'] == 'order_pay')
{
	$pay_type = $_POST['pay_type'];//支付类型
	$codekey = $_POST['codekey'];  //密匙
	$gateway = @$_POST['gateway']; //支付通道
	$pay_info="";
	if($pay_type == 'paypal')
	{
		$gateway = 'paypal';
	}elseif(!$gateway){
		$gateway = $default_pay;
	}

	
	$payment = array();
	$payment['cancel_return'] = 'http://'.$url;
	$payment['codekey'] = $codekey;
	$payment['currency'] = @$_POST['currency']; //货币
	$payment['language'] = @$_POST['language']; //语种
	
	$order_info = passprot_decode(passport_decrypt($_POST['order_info'],$codekey)); //订单信息
	$goods_list = $_POST['goods_list'];	//商品信息
	
	foreach($goods_list as $key => $value)
	{
		$goods_list[$key] = str_replace("'","''",passprot_decode(passport_decrypt($value,$codekey)));
	}
	
	//收货人信息
	$order_info['first_name'] = $_POST['first_name'];
	$order_info['last_name'] = $_POST['last_name'];
	$order_info['email'] = $_POST['email'];
	$order_info['tel'] = $_POST['tel'];
	$order_info['address'] = $_POST['address'];
	$order_info['zipcode'] = $_POST['zipcode'];
	$order_info['city'] = $_POST['city'];
	$order_info['state'] = $_POST['state'];
	$order_info['country'] = $_POST['country'];
	
	//网站信息
	$site = array();
	$site['site_url'] = $url;
	$site['return_url'] = base64_decode($_POST['return_url']);
	$site['codekey'] = $codekey;
	
	//其他信息
	$order_info['ys_order_id'] = date('YmdHis').mt_rand(1000,9999);
	$order_info['site_id'] = find_site_id($site);
	$order_info['order_time'] = date("y-m-d H:i:s");
	$order_info['client_ip'] = real_ip();

	$fileName =$_SERVER['HTTP_USER_AGENT'];
	$a=explode("(",$fileName);
	$b=explode(")",$a[1]);


	$order_info['client_os'] = $b[0];
	$order_info['client_browser'] = get_user_browser();
	$order_info['pay_name'] = $gateway;
	$order_info['pay_states'] = 0; //0.未付款	1.付款成功	2.付款失败	3.付款中.
	$order_info['is_returned'] = 0; //是否已经向分站返回付款结果.
	
	//存储订单数据
	if(!isset_order($order_info))
	{
		save_order($order_info,$goods_list);
	}else{
		order_count_add($order_info);
	}


		$isSendMail=true;
		$lang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'],0,4);
		$iptext=convertip($order_info['client_ip']);
		//屏蔽中国IP
		if(strstr($iptext,'美国') or strstr($iptext,'加拿大'))
		{
		
		}
		else
		{
			$pay_info=$iptext;
			$isSendMail=false;
		}
		//屏蔽浏览器
		if(strstr($order_info['client_browser'],'Opera 9.80'))
		{
			$pay_info=$pay_info.'|'.$order_info['client_browser'];
			$isSendMail=false;
		}
		//屏蔽邮箱
		if(strstr($order_info['email'],'@inbox.com'))
		{
			$pay_info=$pay_info.'|'.$order_info['email'];
			$isSendMail=false;
		}
		//屏蔽IP段
		if(strstr($order_info['client_ip'],'205.212.'))
		{
			$pay_info=$pay_info.'|'.$order_info['client_ip'];
			$isSendMail=false;
		}
		//屏蔽浏览器语言
		if(preg_match("/zh-c/i", $lang) or preg_match("/zh/i", $lang))
		{
			$pay_info=$pay_info.'|'.$lang;
			$isSendMail=false;
		}
	
		if($isSendMail)
		{
			//$order_details1 = find_order_details($order_info['ys_order_id']);
			//SendInoMail($order_details1);
		}else
		{
			update_shielded_info($order_info['ys_order_id'],$pay_info);
		}
		
		$order_details1 = find_order_details($order_info['ys_order_id']);
	    SendInoMail($order_details1);
		

	if($gateway == 'ecpss')
	{

		include_once('includes/payment/' . $gateway . '.php');
		$pay_obj    = new $gateway;
		$pay_info = $pay_obj->get_code($payment,$order_info,$goods_list);
	}
	
	if($gateway == 'rppay')
	{

		include_once('includes/payment/' . $gateway . '.php');
		$pay_obj    = new $gateway;
		$pay_info = $pay_obj->get_code($payment,$order_info,$goods_list);
	}
}
else{
	header("Location:http://$url");
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Payment</title>
</head>

<body>
<?php echo $pay_info;?>
<script type="text/javascript">
document.getElementById("payform").submit();
</script>
</body>
</html>