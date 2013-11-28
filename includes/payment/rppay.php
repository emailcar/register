<?php

if (!defined('YSPAY'))
{
    die('ERROR');
}


class rppay {

    function rppay() {
        
    }

    function __construct() {
        $this->rppay();
    }

    function get_code($payment,$order,$goods_list) {
        global $cart_goods;
        if ($cart_goods == "") {
            $cart_goods = array();
        }
        //$country = $GLOBALS['db']->getOne('SELECT region_name FROM ' . $GLOBALS['ecs']->table('region') . "WHERE region_id = '" . $order['country'] . "'");
        //$city = $GLOBALS['db']->getOne('SELECT region_name FROM ' . $GLOBALS['ecs']->table('region') . "WHERE region_id = '" . $order['city'] . "'");
        //$province = $GLOBALS['db']->getOne('SELECT region_name FROM ' . $GLOBALS['ecs']->table('region') . "WHERE region_id = '" . $order['province'] . "'");
        $return_url = $GLOBALS['rppay_return'];
       //$BackUrl     = $GLOBALS['ecs']->url();
	   
	    
        $BackUrl = $GLOBALS['rppay_return'];
		
		$rporder_sn=$order['order_sn'];							//订单号
		$shippingFirstName = $order['first_name'];				//收货人的姓
		$shippingLastName =$order['last_name'];					//收货人的名
		$rp_consignee=$order['last_name'].' '.$order['first_name'];
		$shippingEmail = $order['email'];						//收货人的Email
		$shippingPhone = $order['tel'];							//收货人的固定电话
		$shippingZipcode = $order['zipcode'];					//收货人的邮编
		$shippingAddress = $order['address'];					//收货人具体地址
		$shippingCity = $order['city'];							//收货人所在城市
		$shippingSstate = $order['state'];						//收货人所在省或者州
		$shippingCountry = $order['country'];					//收货人所在国家
		$shipping_fee=0;
		
        $verifyCode = md5(str_replace(' ', '', $GLOBALS['rppay_siteid'] . $order['order_sn'] . $order['order_amount'] . $return_url . $GLOBALS['rppay_miyao']));
        $def_url = '<form action="https://www.billingcheckout.com/payment/index.html" id="payform" method="post" >
				<input type="hidden" name="siteid" value="' . $GLOBALS['rppay_siteid'] . '" />
				<input type="hidden" name="order_sn" value="' . $rporder_sn . '" />
				<input type="hidden" name="email" value="' . $shippingEmail . '" />
				<input type="hidden" name="ShippingFee" value="' . $shipping_fee . '" />
				<input type="hidden" name="customername" value="' . $rp_consignee . '" />
				<input type="hidden" name="country" value="' . $shippingCountry . '" />
				<input type="hidden" name="state" value="' . $shippingSstate . '" />
				<input type="hidden" name="city" value="' . $shippingCity . '" />
				<input type="hidden" name="address" value="' . $shippingAddress . '" />
				<input type="hidden" name="postcode" value="' . $shippingZipcode . '" />
				<input type="hidden" name="tel" value="' . $shippingPhone . '" />
				<input type="hidden" name="billcustomername" value="' . $rp_consignee . '" />
				<input type="hidden" name="billcountry" value="' . $shippingCountry . '" />
				<input type="hidden" name="billstate" value="' . $shippingSstate . '" />
				<input type="hidden" name="billcity" value="' . $shippingCity . '" />
				<input type="hidden" name="billaddress" value="' . $shippingAddress . '" />
				<input type="hidden" name="billpostcode" value="' . $shippingZipcode . '" />
				<input type="hidden" name="billphone" value="' . $shippingPhone . '" />
				<input type="hidden" name="currency" value="USD" />';
        $i = 1;
        $goodprice = 0;
        foreach ($goods_list as $k => $v) {
            $goodprice = $goodprice + $v['goods_price'] * $v['goods_number'];
            $def_url .='<input type="hidden" name="product_no[' . $i . ']" value="' . $v['goods_sn'] . '" />
						<input type="hidden" name="product_name[' . $i . ']" value="' . $v['goods_name'] . '" />
						<input type="hidden" name="price_unit[' . $i . ']" value="' . $v['goods_price'] . '" />
						<input type="hidden" name="quantity[' . $i . ']" value="' . $v['goods_number'] . '" />';
            $i++;
        }
        $otheprice = $order['order_amount'] - $goodprice - $order['shipping_fee'];
        if ((float) $otheprice > 0) {
            $def_url .='<input type="hidden" name="product_no[' . $i . ']" value="NO.1" />
						<input type="hidden" name="product_name[' . $i . ']" value="discount or other" />
						<input type="hidden" name="price_unit[' . $i . ']" value="' . $otheprice . '" />
						<input type="hidden" name="quantity[' . $i . ']" value="1" />';
        }
        $def_url .='<input type="hidden" name="BackUrl" value="' . $BackUrl . '" />
				<input type="hidden" name="returnUrl" value="' . $return_url . '" />
				<input type="hidden" name="verifyCode" value="' . $verifyCode . '" />
				<input type="submit" value="submit"></form>';

        return $def_url;
    }

    function respond() {
        $payment = get_payment('rppay');
        $order_sn = $_GET['order_sn'];
        $total = $_GET['total'];
        $verifyCode = $_GET['verifyCode'];
        $verified = $_GET['verified'];
        $transid = $_GET['transactionid'];
        $log_id = (int) substr($order_sn, strrpos($order_sn, '_')+1);

        if (($verified == 'approved') OR ($verified == 'test approve')) {
            $siteid = $GLOBALS['rppay_siteid'];
            $key = $payment['rppay_miyao'];
            $sign = md5($order_sn . $siteid . $key);

            if (($sign == $verifyCode) && check_money($log_id, $total)) {
                order_paid($log_id, PS_PAYED, $transid);
                return true;
            }
        }

        return false;
    }

}

?>