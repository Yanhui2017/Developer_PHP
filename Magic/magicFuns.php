<?php
/**
* 魔术方法
* __construct()，类的构造函数
* __destruct()，类的析构函数
* __call()，在对象中调用一个不可访问方法时调用
* __callStatic()，用静态方式中调用一个不可访问方法时调用
* __get()，获得一个类的成员变量时调用
* __set()，设置一个类的成员变量时调用
* __isset()，当对不可访问属性调用isset()或empty()时调用
* __unset()，当对不可访问属性调用unset()时被调用。
* __sleep()，执行serialize()时，先会调用这个函数
* __wakeup()，执行unserialize()时，先会调用这个函数
* __toString()，类被当成字符串时的回应方法
* __invoke()，调用函数的方式调用一个对象时的回应方法
* __set_state()，调用var_export()导出类时，此静态方法会被调用。
* __clone()，当对象复制完成时调用
*/

class Magic{
    private $name,$age;
    public function __construct(){
        $this->name = 'Lio';
        echo 'I`m __construst'."\n";
    }
    // 在对象中调用一个不可访问方法时会调用这两个方法，后者为静态方法。
    // 这两个方法我们在可变方法（Variable functions）调用中可能会用到。
    public function __call($name, $arguments){
        echo "您调用的对象方法不存在，就会找到我了."."\n";
    }
    public static function __callStatic($name, $arguments){
        echo "您调用的静态方法不存在，就会找到我了."."\n";
    }

    // 当get/set一个类的成员变量时调用这两个函数。
    // 例如我们将对象变量保存在另外一个数组中，而不是对象本身的成员变量
    public function __get($name){
        if(isset($this->$name)) return $this->$name;
        return NULL;
    }
    public function __set($name,$value){
        $this->name = $value;
    }
    public function __isset($name){
        return isset($this->$name);
    }
    public function __unset($name){
        unset($this->$name);
    }

    // 对象当成字符串时的回应方法。例如使用echo $obj;来输出一个对象
    public function __toString() {
    return 'this is a object'."\n";
    }
    public function __destruct(){
        echo "Im __descruct"."\n";
    }

    // __invoke() 调用函数的方式调用一个对象时的回应方法
    public function __invoke(){
        echo 'this is a invoke';
    }


    // 当对象复制完成时调用。例如在设计模式详解及PHP实现：
    // 单例模式一文中提到的单例模式实现方式，利用这个函数来防止对象被克隆。
    public function __clone(){
        echo '我复制了一份了'."\n";
    }
}

class MagicException extends Exception{
    
}


$magic = new Magic();
//__call
$magic->name();
//__callStatic
Magic::age();

$magic->name = 'lio change';
echo $magic->name."\n";

//__toString
echo $magic;

// __clone,是重新复制了一份 $magic_two = $magic; 是对象的引用
$magic_two = clone $magic;
$magic_two->name = 'anna';
echo $magic_two->name."\n";
echo $magic->name."\n";



// __invoke
// is_callable 检测参数是否为合法的可调用结构
var_dump(is_callable($magic)); 







