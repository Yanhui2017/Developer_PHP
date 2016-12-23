<?php

// empty($tr)
$tr = true;
echo json_encode(empty($tr));


// http_build_query($request)
http_build_query($request);
$data = array('foo'=>'bar', 
              'baz'=>'boom', 
              'cow'=>'milk', 
              'php'=>'hypertext processor'); 
echo http_build_query($data); 
/* 输出： 
       foo=bar&baz=boom&cow=milk&php=hypertext+processor 
*/

// substr_replace($mobile, "****", 3, 4) 手机号脱敏
substr_replace($mobile, "****", 3, 4);


//ucfirst 将字符串第一个字符改大写。
//语法: string ucfirst(string str); 返回值: 字符串 函数返回字符串 str 第一个字的字首字母改成大写。
//参考strtoupper()  strtolower()  

