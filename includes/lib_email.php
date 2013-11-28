<?php

/**
 * ECSHOP 邮件模版函数库
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
 * 保存邮件模版信息
 *
 * @param array  邮件模版信息
 *
 * @return string 
 */
function save_email_template($email_template_info)
{
	$sql="insert into ys_email_template(template_name,type_id,content,email_title,send_account,send_name) values('".$email_template_info['template_name']."',".$email_template_info['type_id'].",'".$email_template_info['content']."','".$email_template_info['email_title']."','".$email_template_info['send_account']."','".$email_template_info['send_name']."')";
	return $GLOBALS['db']->query($sql);
}


/**
 * 更改邮件模版
 *
 * @return string 
 */
function update_email_template($t_id,$template_name,$type_id,$content,$send_account,$email_title,$send_name)
{
	$sql = "UPDATE ys_email_template SET template_name = '$template_name' ,type_id=$type_id ,content='$content',send_account='$send_account',email_title='$email_title',send_name='$send_name' WHERE t_id = '$t_id'" ;
	return $GLOBALS['db']->query($sql);
}

/**
 * 查询邮件模版详情
 *
 * @param $ys_temp_id  模版ID
 *
 * @return array 
 */
function find_template_details($ys_temp_id)
{
	$sql = "SELECT temp.t_id,temp.template_name,temp.content,temp.add_time,temp.type_id,temp.send_account,temp.email_title,type.type_name,temp.send_name FROM ys_email_template as temp,ys_email_type as type WHERE temp.type_id = type.type_id and  t_id = '$ys_temp_id'";
	return $GLOBALS['db']->getrow($sql);
}


/**
 * 查询邮件类型
 *
 * @param $order_id  类型ID
 *
 * @return array 
 */
function find_email_type($ys_type_id)
{
	$sql = "SELECT * FROM ys_email_type WHERE type_id = '$ys_type_id'";
	return $GLOBALS['db']->getall($sql);
}

/**
 * 查询邮件类型列表
 *
 * @param $order_id  类型ID
 *
 * @return array 
 */
function find_email_type_list()
{
	$sql = "SELECT * FROM ys_email_type";
	return $GLOBALS['db']->getall($sql);
}

/**
 * 查询邮件模板列表
 *
 * @param $order_id  类型ID
 *
 * @return array 
 */
function find_email_templa_list()
{
	$sql = "SELECT * FROM ys_email_template ORDER BY T_ID";
	return $GLOBALS['db']->getall($sql);
}

/**
 * 查询邮件服务器列表
 *
 * @param $order_id  类型ID
 *
 * @return array 
 */
function find_email_con_list()
{
	$sql = "SELECT * FROM ys_email_config";
	return $GLOBALS['db']->getall($sql);
}

/**
 * 删除邮件模版
 *
 * @param $ys_temp_id  模版ID
 *
 * @return array 
 */
function delete_template($ys_temp_id)
{
	$sql = "DELETE FROM ys_email_template WHERE t_id = '$ys_temp_id'";
	return $GLOBALS['db']->query($sql);
}

/**
 * 分页查询模版信息
 *
 * @param $page_size  每页显示条数
 * @param $page_index  当前页码
 * @param $numeric_count  索引长度
 *
 * @return array 
 */
function find_email_list($page_size,$page_index,$numeric_count)
{
	$sql = "SELECT * FROM ys_email_template WHERE 1=1";

	$pcount = ($page_index - 1) * $page_size;
	$sql .= " ORDER BY t_id LIMIT $pcount,$page_size";
	
	$res = $GLOBALS['db']->getall($sql);
	
	$page = new cls_page();
	$page->set_page($page_size, $page_index, find_template_count(), $res,$numeric_count);
	return $page;
}

/**
 * 查询模版总量
 *
 * @return int 
 */
function find_template_count()
{
	$sql = "SELECT count(*) FROM ys_email_template";
	return $GLOBALS['db']->getone($sql);
}


/**
 * 根据订单号查询已发邮件
 *
 * @param $order_id  类型ID
 *
 * @return array 
 */
function find_email($order_id)
{
	$sql = "SELECT * FROM ys_email where ys_order_id='$order_id'";
	return $GLOBALS['db']->getall($sql);
}

/**
 * 根据id查询邮件
 *
 * @param $id  邮件ID
 *
 * @return array 
 */
function get_email_content($id)
{
	$sql = "SELECT email_content FROM ys_email where id='$id'";
	return $GLOBALS['db']->getone($sql);
}


/**
 * 根据邮件id更改邮件的打开状态
 *
 * @param $id  邮件ID
 *
 * @return array 
 */
function update_email_open($id,$open)
{
	$sql = "update `ys_email` set open='$open' where id='$id'";
	return $GLOBALS['db']->getone($sql);
}

/**
 * 查询当前邮件的最大ID
 *
 * @param $id  邮件ID
 *
 * @return array 
 */
function find_max_emailid()
{
	$sql = "SELECT max(id) FROM `ys_email` WHERE 1";
	return $GLOBALS['db']->getone($sql);
}
/**
 * 根据类型查询模版信息
 *
 * @return array 
 */
function find_email_name_list($type_id)
{
	$sql = "SELECT t_id,template_name FROM ys_email_template WHERE type_id=$type_id";
	return $GLOBALS['db']->getall($sql);
}

/**
 * 根据id查询模版信息
 *
 * @return array 
 */
function find_temp_email($t_id)
{
	$sql = "SELECT content,email_title,send_account,send_name FROM ys_email_template WHERE t_id=$t_id";
	return $GLOBALS['db']->getRow($sql);
}
/*
*组合邮件内容
* return array
*/

function get_email($userInfo,$email_id,$orderInfo,$email_type,$email_temp,$temp=null)
{
	$order_products = find_order_products($email_id);   //产品信息
	if($temp == null){
		$temp = find_temp_email($email_temp); //模版邮件内容
	}
	$temp_content = $temp['content'];
	$temp_title = $temp['email_title'];
	$send_name = $temp['send_name'];
	
	$sql="select ys_order_id from ys_orders where order_sn=".$orderInfo['order_sn'];
	$ys_order_id = $GLOBALS['db']->getOne($sql);
	$temp_content = str_replace('{$ys_order_id}',$ys_order_id,$temp_content);
	$temp_content = str_replace('{$order_sn}',$orderInfo['order_sn'],$temp_content);
	$temp_content = str_replace('{$order_time}',$orderInfo['order_time'],$temp_content);
	$temp_content = str_replace('{$first_name}',$userInfo['first_name'],$temp_content);
	$temp_content = str_replace('{$last_name}',$userInfo['last_name'],$temp_content);
	$temp_content = str_replace('{$address}',$userInfo['address'],$temp_content);
	$temp_content = str_replace('{$zipcode}',$userInfo['zipcode'],$temp_content);
	$temp_content = str_replace('{$tel}',$userInfo['tel'],$temp_content);
	$temp_content = str_replace('{$mail_id}',(find_max_emailid()+1),$temp_content);
	$goodsInfo = '<table style="width:700px;padding: 0;margin: 0; border-collapse:collapse;font-size:12px;" cellspacing="0">';
	foreach($order_products as $key => $products)
	{
		$key_num=$key+1;
		$goodsInfo .= '<tr height="25">';
		$goodsInfo .= '<td style="border: 1px solid #C1DAD7;background: #fff;font-size:11px;padding: 6px 6px 6px 12px;color: #4f6b72;">'.$key_num.'</td>';
		$goodsInfo .= '<td style="border: 1px solid #C1DAD7;background: #fff;font-size:11px;padding: 6px 6px 6px 12px;color: #4f6b72;"><a href="http://'.$orderInfo['from_site'].'/goods.php?id='.$products['goods_id'].'" target="_blank">'.$products['goods_name'].'</a></td>';
		$goodsInfo .= '<td style="border: 1px solid #C1DAD7;background: #fff;font-size:11px;padding: 6px 6px 6px 12px;color: #4f6b72;">'.$products['goods_attr'].'</td>';
		$goodsInfo .= '<td style="border: 1px solid #C1DAD7;background: #fff;font-size:11px;padding: 6px 6px 6px 12px;color: #4f6b72;">'.$products['goods_number'].'</td>';
		$goodsInfo .= '<td style="border: 1px solid #C1DAD7;background: #fff;font-size:11px;padding: 6px 6px 6px 12px;color: #4f6b72;">'.$products['goods_price'].'</td>';
		$goodsInfo .= '</tr>';
	}
	$goodsInfo .= '</table>';
	
	$temp_content = str_replace('{$goods_info}',$goodsInfo,$temp_content);
	$temp_content = str_replace('{$send_date}',date('Y-m-d'),$temp_content);
	$temp_content = str_replace('{$shop_url}',$orderInfo['from_site'],$temp_content);
	
	$temp_title = str_replace('{$shop_url}',$orderInfo['from_site'],$temp_title);
	$temp_title = str_replace('{$order_sn}',$orderInfo['order_sn'],$temp_title);
	
	$send_name = str_replace('{$shop_url}',$orderInfo['from_site'],$send_name);
	$temp['send_name']=$send_name;
	$temp['content'] = $temp_content;
	$temp['email_title'] = $temp_title;
	
	return $temp;
}

/*
*   Mail()发送邮件
*$to 接收邮箱
*$subject 邮件标题
*$email_content 邮件内容
*$send_account  发送帐号
*
*/
function send_mail($to,$subject,$email_content,$send_account)
{
	// 当发送 HTML 电子邮件时，请始终设置 content-type
	$headers = "MIME-Version: 1.0" . "\r\n";
	$headers .= "Content-type:text/html;charset=utf-8" . "\r\n";

	// 更多报头
	$headers .= 'From: <'.$send_account.'>' . "\r\n";
	if(@mail($to,$subject,$email_content,$headers) == 1)
	{
		return true;
	}else
	{
		return false;
	}
}

/*
* smtp发送邮件
*
* $smtp参数
* $email 邮件内容
*/

function smtp_send_mail($smtp,$email){

	//error_reporting(E_ALL);
	error_reporting(E_STRICT);
	date_default_timezone_set("US/Alaska");//设定时区
	//require_once('class.phpmailer.php');
	//include("class.smtp.php"); 
	$mail             = new PHPMailer(); //new一个PHPMailer对象出来
	$body             = eregi_replace("[\]",'',$email['email_content']); //对邮件内容进行必要的过滤
	$mail->CharSet ="UTF-8";//设定邮件编码，默认ISO-8859-1，如果发中文此项必须设置，否则乱码
	$mail->IsSMTP(); // 设定使用SMTP服务
	$mail->SMTPDebug  = 1;                     // 启用SMTP调试功能 1 = errors and messages 2 = messages only
	
	$mail->SMTPAuth   = true;                  // 启用 SMTP 验证功能
	
	if($smtp['is_ssl'] == '2')
	{
		$mail->SMTPSecure = "ssl";             // 安全协议
	}
	$mail->Host       = $smtp['host'];         // SMTP 服务器
	$mail->Port       = $smtp['port'];         // SMTP服务器的端口号
	$mail->Username   = $smtp['username'];     // SMTP服务器用户名
	$mail->Password   = $smtp['password'];            // SMTP服务器密码
	$mail->SetFrom($email['send_account'], $email['send_name']);
	$mail->AddReplyTo($email['send_account'],$email['send_name']);   //设置邮件回复地址
	
	
	$mail->Subject    = $email['subject'];
	//$mail->AltBody    = "To view the message, please use an HTML compatible email viewer! "; // optional, comment out and test
	$mail->MsgHTML($body);
	$address = $email['to'];
	$mail->AddAddress($address, $email['name']);
	
	//发送附件，发送单个或多个附件
	//$mail->AddAttachment("images/phpmailer.gif");      // attachment 
	//$mail->AddAttachment("images/phpmailer_mini.gif"); // attachment
	
	if(!$mail->Send()) {
		return "Mailer Error: " . $mail->ErrorInfo;
	} else {
		return "1";
	}
}



//记录发送邮件信息
function add_email($email,$send_email)
{
	$sql="insert into ys_email(t_id,temp_id,email_content,ys_order_id,state,to_mail,email_title,send_email) values('".$email['t_id']."',".$email['temp_id'].",'".$email['email_content']."','".$email['ys_order_id']."','".$email['state']."','".$email['to_mail']."','".$email['email_title']."','".$send_email."')";
	return $GLOBALS['db']->query($sql);
}



//得到所有未发送邮件的订单信息
function get_no_send_mail()
{
	$sql="select ys_order_id,order_sn,from_site,order_time,first_name,last_name,email,tel,zipcode,address,city,state,country from ys_orders where pay_status = 1 and confirm_email != 1";
	
	return $GLOBALS['db']->getall($sql);
}

/*修改发送邮件状态
*
* 1成功，2失败
*/
function update_confirm_email($ys_order_id,$confirm_email)
{
	$sql='update ys_orders set confirm_email = "'.$confirm_email.'" where ys_order_id = "'.$ys_order_id.'"';
	$GLOBALS['db']->query($sql);
}

//查询是否使用smtp发送邮件
function get_is_smtp()
{
	return $GLOBALS['db']->getone('select is_smtp from ys_email_config');
}

//得到smtp设置
function get_smtp()
{
	return $GLOBALS['db']->getRow('select * from ys_email_config where is_default=2');
}

//得到指定smtp设置
function get_smtp_by_id($temp_id)
{
	return $GLOBALS['db']->getRow('select * from ys_email_config where config_id='.$temp_id);
}

//修改smtp配置
function update_smtp($smtp)
{
	return $GLOBALS['db']->query('update ys_email_config set is_smtp ='.$smtp['is_smtp'].',host ="'.$smtp['host'].'",username ="'.$smtp['username'].'",password ="'.$smtp['password'].'",is_ssl ="'.$smtp['is_ssl'].'",port='.$smtp['port'].',is_default='.$smtp['is_default'].' where config_id='.$smtp['config_id']);
}


/**
 * 分页查询模版信息
 *
 * @param $page_size  每页显示条数
 * @param $page_index  当前页码
 * @param $numeric_count  索引长度
 *
 * @return array 
 */
function find_email_config_list($page_size,$page_index,$numeric_count_a)
{
	$sql = "SELECT * FROM ys_email_config WHERE 1=1";

	$pcount = ($page_index - 1) * $page_size;
	$sql .= " ORDER BY config_id ";
	
	$res = $GLOBALS['db']->getall($sql);
	$page = new cls_page();
	$page->set_page($page_size, $page_index, find_email_config_count(), $res,$numeric_count_a);
	return $page;
}

/**
 * 查询模版总量
 *
 * @return int 
 */
function find_email_config_count()
{
	$sql = "SELECT count(*) FROM ys_email_config";
	return $GLOBALS['db']->getone($sql);
}


/**
 * 查询邮件模版详情
 *
 * @param $ys_temp_id  模版ID
 *
 * @return array 
 */
function find_email_config_details($ys_temp_id)
{
	
	$sql = "SELECT smtp.config_id,smtp.is_smtp,smtp.host,smtp.port,smtp.username,smtp.password,smtp.is_ssl,smtp.is_default FROM ys_email_config as smtp where smtp.config_id=".$ys_temp_id;
	return $GLOBALS['db']->getrow($sql);
}

/**
 * 删除邮件配置服务器
 *
 * @param $ys_temp_id  模版ID
 *
 * @return array 
 */
function delete_email_config($ys_temp_id)
{
	$sql = "DELETE FROM ys_email_config WHERE config_id = '$ys_temp_id'";
	return $GLOBALS['db']->query($sql);
}

/**
 * 保存邮件配置服务器
 *
 * @param array  邮件模版信息
 *
 * @return string 
 */
function save_email_config($email_template_info)
{
	$sql="insert into ys_email_config(is_smtp,host,port,username,password,is_ssl,is_default) values(".$email_template_info['is_smtp'].",'".$email_template_info['host']."',".$email_template_info['port'].",'".$email_template_info['username']."','".$email_template_info['password']."',".$email_template_info['is_ssl'].",".$email_template_info['is_default'].")";
	return $GLOBALS['db']->query($sql);
}
?>