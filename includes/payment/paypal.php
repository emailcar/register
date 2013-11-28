<?php

/**
 * paypal 支付插件(亿商版)
 * ============================================================================
 * 这不是一个自由软件！您只能在不用于商业目的的前提下对程序代码进行修改和
 * 使用；不允许对程序代码以任何形式任何目的的再发布。
 * ============================================================================
 * $Author: hulinying
 * $Id: paypal.php
 */

if (!defined('YSPAY'))
{
    die('ERROR');
}

class paypal
{
    function paypal()
    {}

    function __construct()
    {
        $this->paypal();
    }

    /**
     * 生成支付代码
     * @param   array   $order  订单信息
     * @param   array   $payment    支付方式信息
	 * @param   array   $payment    收货人信息
     */
    function get_code($payment, $order, $goods_list)
    {
		if(!$GLOBALS['paypal_status'])
		{
			$def_url  = '<form id="payform" action="" method="post" target="_top">' .
            '<input type="hidden" name="codekey" value="'.$payment['codekey'].'">' .
			'<input type="hidden" name="order_sn" value="'. $order['order_sn'].'">' .
			'<input type="hidden" name="succeed" value="2">' .
			'<input type="hidden" name="message" value="paypal is closing temporarily, choose another channels to pay!">' .
			'<input type="submit" value="">' .
            '</form>';
		}else{
		
			$order_sn 			= $order['order_sn'];
			$data_order_id      = $order['ys_order_id'];
			$data_amount        = $order['order_amount'];
			
			$currency_code      = $payment['currency'];
			
			$data_pay_account   = $GLOBALS['paypal_account'];
			//$data_return_url    = $GLOBALS['paypal_return'];
			//$cancel_return		= $GLOBALS['paypal_cancel_return'] .'&str='.base64_encode($payment['cancel_return']);
			
			$def_url  = '<form id="payform" action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">' .   // 不能省略
				'<input type="hidden" name="cmd" value="_xclick">' .                            // 不能省略
				'<input type="hidden" name="business" value="'.$data_pay_account.'">' .         // 贝宝帐号
				'<input type="hidden" name="item_name" value="'.$order_sn.'">' .          		// payment for
				'<input type="hidden" name="amount" value="'.$data_amount.'">' .                // 订单金额
				'<input type="hidden" name="currency_code" value="'.$currency_code.'">' .       // 货币
				//'<input type="hidden" name="return" value="'.$data_return_url.'">' .            // 付款后页面
				'<input type="hidden" name="invoice" value="'.$data_order_id.'">' .             // 订单号
				'<input type="hidden" name="charset" value="utf-8">' .                          // 字符集
				'<input type="hidden" name="no_shipping" value="1">' .                          // 不要求客户提供收货地址
				'<input type="hidden" name="no_note" value="'.$order_sn.'">' .                  // 付款说明
				//'<input type="hidden" name="notify_url" value="'.$data_return_url.'">' .
				'<input type="hidden" name="rm" value="2">' .
				//'<input type="hidden" name="cancel_return" value="'.$cancel_return.'">' .
				'<input type="submit" value="">' .
				'</form>';
		}

        return $def_url;
    }

	
	function respond()
    {
        $merchant_id    = $GLOBALS['paypal_account'];               ///获取商户编号

        // read the post from PayPal system and add 'cmd'
        $req = 'cmd=_notify-validate';
        foreach ($_POST as $key => $value)
        {
            $value = urlencode(stripslashes($value));
            $req .= "&$key=$value";
        }

        // post back to PayPal system to validate
        $header = "POST /cgi-bin/webscr HTTP/1.0\r\n";
        $header .= "Content-Type: application/x-www-form-urlencoded\r\n";
        $header .= "Content-Length: " . strlen($req) ."\r\n\r\n";
        $fp = fsockopen ('www.paypal.com', 80, $errno, $errstr, 30);

        // assign posted variables to local variables
        $item_name = $_POST['item_name'];
        $item_number = $_POST['item_number'];
        $payment_status = $_POST['payment_status'];
        $payment_amount = $_POST['mc_gross'];
        $payment_currency = $_POST['mc_currency'];
        $txn_id = $_POST['txn_id'];
        $receiver_email = $_POST['receiver_email'];
        $payer_email = $_POST['payer_email'];
        $order_sn = $_POST['invoice'];
        $memo = !empty($_POST['memo']) ? $_POST['memo'] : '';
        $action_note = $txn_id . '(Paypal ID)' . $memo;

		$pay_result = array();
		$pay_result['order_sn'] = $item_name;
		$pay_result['trade_sn'] = $action_note;
		$pay_result['ys_order_id'] = $order_sn;
		
        if (!$fp)
        {
            fclose($fp);
			$pay_result['pay_status'] = 2;
        }
        else
        {
            fputs($fp, $header . $req);
            while (!feof($fp))
            {
                $res = fgets($fp, 1024);
                if (strcmp($res, 'VERIFIED') == 0)
                {
                    if ($payment_status != 'Completed' && $payment_status != 'Pending')
                    {
                        fclose($fp);
                        $pay_result['pay_status'] = 2;
						$pay_result['remark'] = 'check the payment_status is Completed';
                    }

                    if ($receiver_email != $merchant_id)
                    {
                        fclose($fp);
                        $pay_result['pay_status'] = 2;
						$pay_result['remark'] = 'check that receiver_email is your Primary PayPal email';
                    }

                    fclose($fp);
                    $pay_result['pay_status'] = 1;
					$pay_result['remark'] = 'process payment';
                }
                elseif (strcmp($res, 'INVALID') == 0)
                {
                    fclose($fp);
					$pay_result['pay_status'] = 2;
					$pay_result['remark'] = 'log for manual investigation';
                }
            }
        }
    }

}

?>