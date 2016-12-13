<?php

/**
 * 可以类比python的mixin编程模式，因为php不支持多重继承父类，
 * 通过trait可以继承多个性状达到水平扩展php类功能的作用。
 * Laravel里面Auth认证服务可以看到很多trait设计思路的影子。
 */

 
// 优先级
// 从基类继承的成员会被 trait 插入的成员所覆盖。
// 优先顺序是来自当前类的成员覆盖了 trait 的方法，而 trait 则覆盖了被继承的方法

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

trait Hello {
    public function sayHello() {
        echo 'Hello ';
    }
}

trait World {
    public function sayWorld() {
        echo 'World';
    }
}

trait HelloWorld {
    public function sayHello() {
        echo 'Hello World!';
    }
}
// 修改 sayHello 的访问控制
class MyClass1 {
    use HelloWorld { sayHello as protected; }
}
// 给方法一个改变了访问控制的别名
// 原版 sayHello 的访问控制则没有发生变化
class MyClass2 {
    use HelloWorld { sayHello as private myPrivateHello; }
}


class MyHelloWorld {
    use Hello, World;
    public function sayExclamationMark() {
        echo '!';
    }
}

$o = new MyHelloWorld();
$o->sayHello();
$o->sayWorld();
$o->sayExclamationMark();
?>