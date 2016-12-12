<?php
//适应于在开发中开发者能够快速的构建自己的单例对象，减少内存开销。
//在很多情况下，需要为系统中的多个类创建单例的构造方式，这样，可以建立一个通用的抽象父工厂方法：

//首先构建一个单例对象工厂抽象类
abstract class FactoryAbstract {
    //这里存储单例对象的属性成为了一个数组的形式。
    protected static $instances = array();

    public static function getInstance() {
        //获取当前类的类名
        $className = static::getClassName();
        //如果单例数组里的单例对象属于当前类，那么返回该对象，否则新建对象返回。
        if (!(self::$instances[$className] instanceof $className)) {
            self::$instances[$className] = new $className();
        }
        return self::$instances[$className];
    }

    //对单例对象数组里的单例对象进行删除处理，类似于注册模式。
    public static function removeInstance() {
        $className = static::getClassName();
        if (array_key_exists($className, self::$instances)) {
            unset(self::$instances[$className]);
        }
    }

    final protected static function getClassName() {
        return get_called_class();
    }

    protected function __construct() { }

    final protected function __clone() { }
}

// 这个是构建单例的抽象工厂类，上边是单例对象的存储。
abstract class Factory extends FactoryAbstract {

    final public static function getInstance() {
        return parent::getInstance();
    }

    final public static function removeInstance() {
        parent::removeInstance();
    }
}
// using:

class FirstProduct extends Factory {
    public $a = [];
}
class SecondProduct extends FirstProduct {
}

FirstProduct::getInstance()->a[]  = 1;
SecondProduct::getInstance()->a[] = 2;
FirstProduct::getInstance()->a[]  = 3;
SecondProduct::getInstance()->a[] = 4;

print_r(FirstProduct::getInstance()->a);
// array(1, 3)
print_r(SecondProduct::getInstance()->a);
// array(2, 4)