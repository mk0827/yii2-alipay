<?php
namespace mkui\alipay;

use mkui\alipay\Aliconfig;

/* *
 * 功能：纯担保交易接口接入页
 * 版本：3.3
 * 修改日期：2012-07-23
 * 说明：
 * 以下代码只是为了方便商户测试而提供的样例代码，商户可以根据自己网站的需要，按照技术文档编写,并非一定要使用该代码。
 * 该代码仅供学习和研究支付宝接口使用，只是提供一个参考。

 * ************************注意*************************
 * 如果您在接口集成过程中遇到问题，可以按照下面的途径来解决
 * 1、商户服务中心（https://b.alipay.com/support/helperApply.htm?action=consultationApply），提交申请集成协助，我们会有专业的技术工程师主动联系您协助解决
 * 2、商户帮助中心（http://help.alipay.com/support/232511-16307/0-16307.htm?sh=Y&info_type=9）
 * 3、支付宝论坛（http://club.alipay.com/read-htm-tid-8681712.html）
 * 如果不想使用扩展功能请把扩展功能参数赋空值。
 */

//require_once("alipay.config.php");

/* * ************************请求参数************************* */

class Alipay {
    //支付类型
    public $payment_type = "1"; //必填，不能修改
    //服务器异步通知页面路径
    public $notify_url = "http://商户网关地址/create_direct_pay_by_user-PHP-UTF-8/notify_url.php"; //需http://格式的完整路径，不能加?id=123这类自定义参数

    //页面跳转同步通知页面路径
    public $return_url = "http://商户网关地址/create_direct_pay_by_user-PHP-UTF-8/return_url.php"; //需http://格式的完整路径，不能加?id=123这类自定义参数，不能写成http://localhost/

    //商户订单号
    public $out_trade_no = ""; //商户网站订单系统中唯一订单号，必填

    //订单名称
    public $subject = ""; //必填

    //付款金额
    public $total_fee = ""; //必填

    //订单描述
    public $body = "";
    //商品展示地址
    public $show_url = ""; //需以http://开头的完整路径，例如：http://www.商户网址.com/myorder.html

    //防钓鱼时间戳
    public $anti_phishing_key = ""; //若要使用请调用类文件submit中的query_timestamp函数

    //客户端的IP地址
    public $exter_invoke_ip = ""; //非局域网的外网IP地址，如：221.0.0.1

    public $parameter = [];
    public $alipay_config = [];

    public function __construct($notifyUrl, $returnUrl, $out_trade_no, $subject, $total_fee, $body, $show_url) {
        $this->alipay_config=(new Aliconfig)->getAliconfig();

        $this->parameter = array(
            "service"           => "create_direct_pay_by_user",
            "partner"           => trim($this->alipay_config['partner']),
            "seller_email"      => trim($this->alipay_config['seller_email']),
            "payment_type"      => $this->payment_type,
            "notify_url"        => $notifyUrl,
            "return_url"        => $returnUrl,
            "out_trade_no"      => $out_trade_no,
            "subject"           => $subject,
            "total_fee"	        => $total_fee,
            "body"	            => $body,
            "show_url"	        => $show_url,
            "anti_phishing_key"	=> $this->anti_phishing_key,
            "exter_invoke_ip"	=> $this->exter_invoke_ip,
            "_input_charset"    => trim(strtolower($this->alipay_config['input_charset'])),
        );
    }
}

