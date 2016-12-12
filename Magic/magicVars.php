<?php

namespace Developer\Magic;
/**
 * 魔术常量(Magic constants)
 * __LINE__，文件中的当前行号
 * __FILE__，文件的完整路径和文件名
 * __DIR__，文件所在的目录
 * __FUNCTION__，函数名称
 * __CLASS__，类的名称
 * __TRAIT__，Trait的名字
 * __METHOD__，类的方法名
 * __NAMESPACE__，当前命名空间的名称
 */


class MagicVar{
    public function show(){
        echo "\n";
        echo '文件所在目录:'.__DIR__."\n";;

        echo '函数名是:'.__FUNCTION__."\n";

        echo '类名是:'.__CLASS__."\n";

        echo '类的方法名:'.__METHOD__."\n";

        echo '当前命名空间的名称:'.__NAMESPACE__."\n";
        echo "\n";
    }
}

$magic = new MagicVar();
echo '执行代码在文件的第'.__LINE__.'行'."\n";;
echo '执行文件在'.__FILE__."\n";
echo $magic->show();

// 从基类继承的成员被 trait 插入的成员所覆盖。
// 优先顺序是来自当前类的成员覆盖了 trait 的方法，而 trait 则覆盖了被继承的方法。
class Base {
    public function sayHello() {
        echo 'Hello ';
    }
}
trait SayWorld {
    public function sayHello() {
        parent::sayHello();
        echo 'World!';
    }
}
class MyHelloWorld extends Base {
    use SayWorld;
}
$o = new MyHelloWorld();
$o->sayHello();