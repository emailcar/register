<?php

/**
 * Ecpss 支付插件(亿商版)
 * ============================================================================
 * 这不是一个自由软件！您只能在不用于商业目的的前提下对程序代码进行修改和
 * 使用；不允许对程序代码以任何形式任何目的的再发布。
 * ============================================================================
 * $Author: hulinying
 * $Id: ecpss.php
 */

if (!defined('YSPAY'))
{
    die('ERROR');
}

class ecpss
{
    function ecpss()
    {}

    function __construct()
    {
        $this->ecpss();
    }

    /**
     * 生成支付代码
     * @param   array   $payment    支付方式信息
	 * @param   array   $order      订单信息
	 * @param   array   $goods_list    产品信息
     */
    function get_code($payment, $order, $goods_list)
    {
		$MerNo = $GLOBALS['ecpss_no'];                        //商户号
        $MD5key = $GLOBALS['ecpss_key'];                         //MD5私钥
        
		$Currency = $GLOBALS['ecpss_currency'][$payment['currency']];       //[必填]交易币种1:代表美金2:欧元4:英镑
		$Language = $GLOBALS['ecpss_Language'][$payment['language']];       //[必填]语言2:代表英文；1：代表中文
		$ReturnURL = $GLOBALS['ecpss_return'];      				//[必填]返回数据给商户的地址(商户自己填写)
		
		$BillNo = $order['order_sn'];						//[必填]订单号(商户自己产生：要求不重复)
        $Amount = $order['order_amount'];                       //[必填]订单金额
        $Remark = $order['ys_order_id']; 						//[选填]备注。
		$products = 'Jersey';											//[选填]物品信息
		
		foreach($goods_list as $goods)
		{
			//$products .= '+' . $goods['goods_name'];
		}
		
        $md5src = $MerNo.$BillNo.$Currency.$Amount.$Language.$ReturnURL.$MD5key; //校验源字符串
        $MD5info = strtoupper(md5($md5src));                                     //MD5检验结果

		$shippingFirstName = $order['first_name'];				//收货人的姓
		$shippingLastName =$order['last_name'];					//收货人的名
		$shippingEmail = $order['email'];						//收货人的Email
		$shippingPhone = $order['tel'];							//收货人的固定电话
		$shippingZipcode = $order['zipcode'];					//收货人的邮编
		$shippingAddress = $order['address'];					//收货人具体地址
		$shippingCity = $order['city'];							//收货人所在城市
		$shippingSstate = $order['state'];						//收货人所在省或者州
		$shippingCountry = $order['country'];					//收货人所在国家

        $button = "<form id='payform' action='https://security.sslepay.com/sslpayment' method='post' target='_top'>".
                    "<input type='hidden' name='MerNo' value='". $MerNo ."'>".
                    "<input type='hidden' name='Currency' value='". $Currency ."'>".
					"<input type='hidden' name='Language' value='". $Language ."'>".
					"<input type='hidden' name='ReturnURL' value='". $ReturnURL ."'>".
					"<input type='hidden' name='MD5info' value='". $MD5info ."'>".
                    "<input type='hidden' name='BillNo' value='". $BillNo ."'>".
                    "<input type='hidden' name='Amount' value='". $Amount ."'>".
					"<input type='hidden' name='products' value='". $products ."'>".
                    "<input type='hidden' name='Remark' value='". $Remark ."'>".
					"<input type='hidden' name='shippingFirstName' value='". $shippingFirstName ."'>".
					"<input type='hidden' name='shippingLastName' value='". $shippingLastName ."'>".
					"<input type='hidden' name='shippingEmail' value='". $shippingEmail ."'>".
					"<input type='hidden' name='shippingPhone' value='". $shippingPhone ."'>".
					"<input type='hidden' name='shippingZipcode' value='". $shippingZipcode ."'>".
					"<input type='hidden' name='shippingAddress' value='". $shippingAddress ."'>".
					"<input type='hidden' name='shippingCity' value='". $shippingCity ."'>".
					"<input type='hidden' name='shippingSstate' value='". $shippingSstate ."'>".
					"<input type='hidden' name='shippingCountry' value='". $shippingCountry ."'>".
                    "<input type='Submit' name='b1' value='Payment'>".
                    "</form>";

        return $button;
    }

    /**
     * 响应操作
     */
    function respond()
    {
 
		$MD5key = $GLOBALS['ecpss_key'];   //MD5私钥
        $BillNo = $_REQUEST["BillNo"];     //订单号
        $Currency = $_REQUEST["Currency"]; //币种
        $Amount = $_REQUEST["Amount"];     //金额
        $Succeed = $_REQUEST["Succeed"];   //支付状态
        $TradeNo = @$_REQUEST["TradeNo"];  //支付平台流水号
        $Result = $_REQUEST["Result"];     //支付结果
        $MD5info = $_REQUEST["MD5info"];   //取得的MD5校验信息
        
        $md5src = $BillNo.$Currency.$Amount.$Succeed.$MD5key; //校验源字符串
        $md5sign = strtoupper(md5($md5src));                  //MD5检验结果
		
		$pay_result = array();
		$pay_result['order_sn'] = $BillNo;
		$pay_result['trade_sn'] = $TradeNo;
		
		if ($MD5info==$md5sign){//MD5验证成功
			if ($Succeed=="88") {
				$pay_result['pay_status'] = 1;
				$pay_result['remark'] = $Result;
			}elseif($Succeed=="1" || $Succeed=="9" || $Succeed=="19"){
				$pay_result['pay_status'] = 3;
				$pay_result['remark'] = $Result;
			}
			else{
				$pay_result['pay_status'] = 2;
				$pay_result['remark'] = $Result;
			}
		}else{
			$pay_result['pay_status'] = 2;
			$pay_result['remark'] = 'Validation failed!';
		}
		
		return $pay_result;
    }
}

?>