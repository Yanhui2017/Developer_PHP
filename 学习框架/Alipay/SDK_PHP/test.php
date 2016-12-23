<?php
require_once 'AopSdk.php';
header("Content-type: text/html; charset=utf-8");
date_default_timezone_set('PRC');//设置为中华人民共和国
$c = new AopClient();

$c->gatewayUrl = "https://openapi.alipay.com/gateway.do";
$c->appId = "2016073100129845";
$c->rsaPrivateKey = 'MIICWwIBAAKBgQDQTSwYzMXuO/daWmc6dldoMLiNOJG8/hRq/YpEGFNNp5T/hQkLhcrpmYDBRENNxSd2v+Z9vvIzJC7XZCWgovGCFCUI3urkjGkPvmmJBbHqk8ARGIcN5p4cQs3MmRIbAHHggzHkBt6Sh+yQC7IR8Fc2JcbSgMsLZcXguHBZl2NeoQIDAQABAoGAUOFWOP7x79Ia9ltZ78pZoBwi3LrVY+PoO67czBoB5oomgZy/aVj29ANliiWeWIkwDJzwu2y0EIWBJqM9NQVv7lUrQOjDbtQdhwwNmopIcIFc/Lcy2PsyNfVHxkAqAqyPQ5K5jZJntAPBTxWNuHa5QWChz/NIMVz1BB2II1CnI40CQQD8MjAihscUZvjEsucqAT7rH7RHE6i7tet2B+QBObrXj9j582VHNaMR8nOrciBcTMGpgm3if2ORsF2NVbWqwzUzAkEA03F+JPFIa4UcdmHKDKxOe9qZjzBpvpkGpJ2h7nNAvHcwh/7SVB/cqfbnPWIjSnvpfvD1ZITPi1hzo9z+UQ+02wJAZT6owFOnPHOSTzUbRGu3nKDfuOEVjjYcTwgf6rYIYl2nV8D02b+Yta3F7gAlKajO3oQ0JQfLK0PIauMLyYAQrQJAdb3HLq8lUqom9UzzBCeW9KT/yZp95+KyrkwQ9gU70TbV0YT2fl3XtNWGYsoZOMrTdRqcq0LBh6jTjDXtcBo87QJANoqafksRii5lWQUlIclQFq8vk8HM8Gupw3nEEM8mHpuHQfVtWYnUHuKSPQ61TDoHN9ZeudqCY/jR8UlygGlQ6A==' ;
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