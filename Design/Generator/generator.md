generator
-

##介绍
玩过node和python的同学都知道yield这个关键字，借助yield的上下文运行时的切换，可以做到协程的效果，能够大大减少内存的使用量以及效率。
比如导出和导入大量数据的时候，可以使用生成器避免内存爆出。
具体看鸟哥的介绍在此，这里我们直接上代码了:

```
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
```
使用makerange函数的时候会发现最后打印的内存占用在130M左右，使用makerange_g的时候内存占有率在0.5M左右。
这就是协程的威力。
说句题外话，有的时候一个页面请求达到上百M，充斥着10来个sql，
每个sql的数据量还很大，建议是每个sql得到的结果使用完了之后就unset释放掉，否则内存崩溃，会报php Allowed memory size of bytes exhausted这样的错误。