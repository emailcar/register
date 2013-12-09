<?php

//系统路径
$system_url = '';

//ECPSS
$ecpss_no = '5359';
$ecpss_key = ')XMfuWAa';
$ecpss_currency = array('USD'=>1,'EUR'=>2,'GBP'=>4);
$ecpss_Language = array('EN'=>2,'ZH-CN'=>1);
$ecpss_return = 'http://www.marry-inc.com/paypal/respond.php?code=ecpss';


//RealyPay
$rppay_siteid='670313913';
$rppay_miyao='IAS7ZWBY5O6E';
$rppay_return = 'http://www.marry-inc.com/paypal/respond.php?code=rppay';


//paypal接口
$paypal_status = 1;//是否开启paypal支付 1/0
$paypal_account = 'lonelygold11@gmail.com';//paypal账户
$paypal_return = 'http://www.marry-inc.com/paypal/respond.php?code=paypal';
$paypal_cancel_return = 'http://www.marry-inc.com/paypal/respond.php?code=return';

//默认支付方式
$default_pay = 'ecpss';

//数据库
$db_host = "localhost";// database host
$db_name = "marryys";// database name
$db_user = "root";// database username
$db_pass = 'ningmysql';// database password
$mysql_list = 'marryys';
?>