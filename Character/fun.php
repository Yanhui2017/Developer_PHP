<?php


date_default_timezone_set('PRC');
// empty($tr)
$tr = true;
//echo json_encode(empty($tr));


// http_build_query($request)
// http_build_query($request);
// $data = array('foo'=>'bar', 
//               'baz'=>'boom', 
//               'cow'=>'milk', 
//               'php'=>'hypertext processor'); 
// echo http_build_query($data); 
/* 输出： 
       foo=bar&baz=boom&cow=milk&php=hypertext+processor 
*/

// substr_replace($mobile, "****", 3, 4) 手机号脱敏
//substr_replace($mobile, "****", 3, 4);


//ucfirst 将字符串第一个字符改大写。
//语法: string ucfirst(string str); 返回值: 字符串 函数返回字符串 str 第一个字的字首字母改成大写。
//参考strtoupper()  strtolower()  

echo '-------- date -------';

//echo date('H',time());

echo intval('15.0000000000001');
echo intval('14.9999999999999');


/**
 * 对提供的数据进行urlsafe的base64编码。
 *
 * @param string $data 待编码的数据，一般为字符串
 *
 * @return string 编码后的字符串
 * @link http://developer.qiniu.com/docs/v6/api/overview/appendix.html#urlsafe-base64
 */
function base64_urlSafeEncode($data)
{
    $find = array('+', '/');
    $replace = array('-', '_');
    return str_replace($find, $replace, base64_encode($data));
}

/**
 * 对提供的urlsafe的base64编码的数据进行解码
 *
 * @param string $str 待解码的数据，一般为字符串
 *
 * @return string 解码后的字符串
 */
function base64_urlSafeDecode($str)
{
    $find = array('-', '_');
    $replace = array('+', '/');
    return base64_decode(str_replace($find, $replace, $str));
}


/**递归把多维数组的值转换成一维
 * @param $res
 * @param $data
 * @return array
 */
function recurs_to_one_dimen_array(&$res,$data){
    if(is_array($data)){
        foreach ($data as $item) {
            recurs_to_one_dimen_array($res,$item);
        }
    }else{
        if(!empty($data)){
            $res[] = $data;
        }
    }
}


echo "---? :---\n";
echo true ? : 2;

$bank_code = "中国银联支付标记
(00010030)";

preg_match_all("/[0-9]+/", $bank_code, $links);
$bank_code = $links[0][0];


echo json_encode($bank_code);



// 二维数组查找
$index = array_search($loan_id,array_column($res['data']['overdue_info'],'loanId'));