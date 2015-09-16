<?php
namespace mkui\alipay;

use mkui\alipay\Aliconfig;

class AlipayWap
{
	/**************************请求参数**************************/

	//支付类型
	public $payment_type = "1";
	//必填，不能修改
	//服务器异步通知页面路径
	public $notify_url = "http://商户网关地址/alipay.wap.create.direct.pay.by.user-PHP-UTF-8/notify_url.php";
	//需http://格式的完整路径，不能加?id=123这类自定义参数

	//页面跳转同步通知页面路径
	public $return_url = "http://商户网关地址/alipay.wap.create.direct.pay.by.user-PHP-UTF-8/return_url.php";
	//需http://格式的完整路径，不能加?id=123这类自定义参数，不能写成http://localhost/

	//商户订单号
	public $out_trade_no = "";
	//商户网站订单系统中唯一订单号，必填

	//订单名称
	public $subject = "";
	//必填

	//付款金额
	public $total_fee = "";
	//必填

	//商品展示地址
	public $show_url = "";
	//必填，需以http://开头的完整路径，例如：http://www.商户网址.com/myorder.html

	//订单描述
	public $body = "";
	//选填

	//超时时间
	public $it_b_pay = "";
	//选填

	//钱包token
	public $extern_token = "";
	//选填

	public $parameter = [];
	public $alipay_config = [];

	public function __construct($notifyUrl, $returnUrl, $out_trade_no, $subject, $total_fee, $body, $show_url)
	{
		$this->alipay_config=(new AlipayWapconfig)->getAliconfig();
		/************************************************************/

		//构造要请求的参数数组，无需改动
		$this->parameter = array(
			"service" 			=> "alipay.wap.create.direct.pay.by.user",
			"partner" 			=> trim($this->alipay_config['partner']),
			"seller_id" 		=> trim($this->alipay_config['seller_id']),
			"payment_type" 		=> $this->payment_type,
			"notify_url" 		=> $notifyUrl,
			"return_url" 		=> $returnUrl,
			"out_trade_no" 		=> $out_trade_no,
			"subject" 			=> $subject,
			"total_fee" 		=> $total_fee,
			"show_url" 			=> $show_url,
			"body" 				=> $body,
			"it_b_pay" 			=> $this->it_b_pay,
			"extern_token" 		=> $this->extern_token,
			"_input_charset" 	=> trim(strtolower($this->alipay_config['input_charset']))
		);
	}

}