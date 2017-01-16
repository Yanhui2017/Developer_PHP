$obj = function($name){
    echo $name;
};

//两种调用方式是一样的
echo $obj->__invoke('lio');
<?php

echo $obj("Josh");


$arr = array_map(function($number){
    return $number + 1;
},[1,2,3,4]);

var_dump($arr);

function enclosePerson($name) {
    return function ($doCommand) use ($name) {
        return sprintf('%s, %s', $name, $doCommand);
    };
}
// 将字符串"Clay"封装进闭包
$clay = enclosePerson('Clay');
 
// 调用闭包
// echo $clay('get me sweet tea!');


//bindTo
class Foo{
    private $name;
    function __construct($name){
        $this->name = $name;
    }
}
$obj = new Foo('Sam');
$cl = function() {
    return "Hello " . $this->name;
};
$cl = $cl->bindTo($obj, 'Foo');// 'Foo'也可以直接写成$obj
echo($cl());