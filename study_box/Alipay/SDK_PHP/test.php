<?php
require_once 'AopSdk.php';
header("Content-type: text/html; charset=utf-8");
date_default_timezone_set('PRC');//设置为中华人民共和国
$c = new AopClient();

$c->gatewayUrl = "https://openapi.alipay.com/gateway.do";
$c->appId = "2016080100140233";
$c->rsaPrivateKey = 'MIICXAIBAAKBgQDaw3lS3rQF3gJo6q3NqAyv3dUZIsmuPigv4Azq26vbgcZ9et6MaHxzQed3QHAofFNZnD2E/r9OTS+1UeVBGKUnrYX41Higt9A5aIDFs9/XY2bQGiId0a/i+dEzPs1km9Yn/+xLMjvDNHih/2oSDWtumSZm/Wsq92pBnblYLqsWtQIDAQABAoGAS6f4qHE+nxzVhoVK0GoC4Tt9vDCswSbb7Rq2PO71s3dhNvosRzDHgXDUZQiTAV1l0gLXv8v+S00kZ7fH6khkrP2AY1e49U+bpJjwRkUrqHH1fFJQP4z7D/7UHjHGFlgZhu8o0EZHqlAIielw+BiGk+in5wGqsRUr1faximKx780CQQDwPevCeTc764+YeJBya6yIBSJgV1Por+Wca/RV94O7HUjUehG2ShVn3ayjc+apWwDcwGncssdEuVzIHyTvECULAkEA6RzlEtpL5WZcY/akW+ss4hGmlvDXyf/sFbSGVCVE8Aogki01H41T8KYvrN5gUyAcyEtKlQcbVTQg3G4ak9+LPwJAFZG5pRA1AVA46DuK3HsGVn//gh7VDcMdHloi6cT7MsWCUHFVPcSQ/25LnbE+OF5PSYKM/p+efHEX/2+sZTpR2QJACbFW4QrMnxQ7gTiPKvdDXX8IYzxObKrEgT6JW1RVYnm5UvqoO9CfjeELGHACp1ItgDKJPlsWStupBiFZ344q9wJBAN6rom6YcHttNJoDcFEKTzJWkAuxzN4zLG9GAGGHTJlN5qlMr1utIbszBl/Vhe4ERL/tCqUitDAKePjG7Wzmy10=' ;
$c->format = "json";
$c->charset= "utf-8";
$c->alipayrsaPublicKey = 'MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQDIgHnOn7LLILlKETd6BFRJ0GqgS2Y3mn1wMQmyh9zEyWlz5p1zrahRahbXAfCfSqshSNfqOmAQzSHRVjCqjsAw1jyqrXaPdKBmr90DIpIxmIyKXv4GGAkPyJ/6FTFY99uhpiq0qadD/uSzQsefWo0aTvP/65zi3eof7TcZ32oWpwIDAQAB';

//实例化具体API对应的request类,类名称和接口名称对应,当前调用接口名称：alipay.open.public.template.message.industry.modify
$request = new AlipayTradeAppPayRequest();
//SDK已经封装掉了公共参数，这里只需要传入业务参数
//此次只是参数展示，未进行字符串转义，实际情况下请转义

$params_array = array();
$params_array['body']               = '阳光钱包';                  //not must 具体描述信息
$params_array['subject']            = 'YGQB';               //must     交易标题
$params_array['out_trade_no']       = 'HKdjajkwdhkjwdjkwa';            //must     商户网站唯一订单号
$params_array['timeout_express']    = '90m';       //not must 最晚付款时间 ex:90m
$params_array['total_amount']       = strval(round(2/100,2));               //must     订单金额(单位:元)
$params_array['product_code']       = 'QUICK_MSECURITY_PAY';          //must     销售产品码 default:QUICK_MSECURITY_PAY
//$params_array['goods_type']         = $this->goods_type;            //not must 商品主类型,虚拟类商品不支持使用花呗渠道 default:0
$params_array['notify_url'] = 'http://pay.ibicid.com/Pay/Callback/AlipayAppCallback';
$params_array['enable_pay_channels']= 'balance';   //not must 可用渠道

$request->setBizContent(json_encode($params_array));
echo $response= $c->sdkExecute($request);

echo "\n\n\n";


$c->gatewayUrl = 'https://openapi.alipaydev.com/gateway.do';
$c->appId = '2016080100140233';
$c->rsaPrivateKey = 'MIICXAIBAAKBgQDaw3lS3rQF3gJo6q3NqAyv3dUZIsmuPigv4Azq26vbgcZ9et6MaHxzQed3QHAofFNZnD2E/r9OTS+1UeVBGKUnrYX41Higt9A5aIDFs9/XY2bQGiId0a/i+dEzPs1km9Yn/+xLMjvDNHih/2oSDWtumSZm/Wsq92pBnblYLqsWtQIDAQABAoGAS6f4qHE+nxzVhoVK0GoC4Tt9vDCswSbb7Rq2PO71s3dhNvosRzDHgXDUZQiTAV1l0gLXv8v+S00kZ7fH6khkrP2AY1e49U+bpJjwRkUrqHH1fFJQP4z7D/7UHjHGFlgZhu8o0EZHqlAIielw+BiGk+in5wGqsRUr1faximKx780CQQDwPevCeTc764+YeJBya6yIBSJgV1Por+Wca/RV94O7HUjUehG2ShVn3ayjc+apWwDcwGncssdEuVzIHyTvECULAkEA6RzlEtpL5WZcY/akW+ss4hGmlvDXyf/sFbSGVCVE8Aogki01H41T8KYvrN5gUyAcyEtKlQcbVTQg3G4ak9+LPwJAFZG5pRA1AVA46DuK3HsGVn//gh7VDcMdHloi6cT7MsWCUHFVPcSQ/25LnbE+OF5PSYKM/p+efHEX/2+sZTpR2QJACbFW4QrMnxQ7gTiPKvdDXX8IYzxObKrEgT6JW1RVYnm5UvqoO9CfjeELGHACp1ItgDKJPlsWStupBiFZ344q9wJBAN6rom6YcHttNJoDcFEKTzJWkAuxzN4zLG9GAGGHTJlN5qlMr1utIbszBl/Vhe4ERL/tCqUitDAKePjG7Wzmy10=' ;
$c->format = "json";
$c->charset= "utf-8";
$c->alipayrsaPublicKey = 'MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQDIgHnOn7LLILlKETd6BFRJ0GqgS2Y3mn1wMQmyh9zEyWlz5p1zrahRahbXAfCfSqshSNfqOmAQzSHRVjCqjsAw1jyqrXaPdKBmr90DIpIxmIyKXv4GGAkPyJ/6FTFY99uhpiq0qadD/uSzQsefWo0aTvP/65zi3eof7TcZ32oWpwIDAQAB';
$params_array['out_trade_no'] = 'HK20161226682450';
$requests = new AlipayTradeQueryRequest ();
$requests->setBizContent(json_encode($params_array));

$results = $c->execute($requests);
echo json_encode($results);



