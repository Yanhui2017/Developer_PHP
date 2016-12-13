<?php
ini_set("memory_limit","200M");
//生成器
function makerange($length){
    $ret = [];
    for($i =1;$i<$length;$i++){
        $ret[] = $i;
    }
    return $ret;
}

function makerange_g($length){
    for($i =1;$i<$length;$i++){
        yield $i;
    }
}

$myfile = fopen("testfile.txt", "w");
//$re = makerange(1000000);
$re = makerange_g(1000000);
foreach($re as $item){
    fwrite($myfile, $item . PHP_EOL);
}
echo memory_get_usage() / 1024 / 1024; //打印到此处内存的占用量