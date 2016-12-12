<?php
/**
 * 常常用于允许在运行时为某个特定的类创建一个可访问的实例
 * Singleton class
 */
final class Product
{
    /**
     * @var self
     * 要把实例化出来的对象付给这个属性
     */
    private static $instance;

    /**
     * @var mixed
     */
    public $mix;
    
    //不能被实例化
    private function __construct() {}

    //__clone()方法对一个对象实例进行的浅复制,对象内的基本数值类型进行的是传值复制，
    //而对象内的对象型成员变量,如果不重写__clone方法,显式的clone这个对象成员变量的话,
    //这个成员变量就是传引用复制,而不是生成一个新的对象
    private function __clone() {}

    /**
     * Return self instance
     *
     * @return self
     */
    public static function getInstance() {
        //检测instance是否属于 这个类，如果不属于就重新实例化一个
        if (!(self::$instance instanceof self)) {
            self::$instance = new self();
        }
        return self::$instance;
    }
}

$firstProduct = Product::getInstance();
$secondProduct = Product::getInstance();

$firstProduct->mix = 'test'."\n";
$secondProduct->mix = 'example';

echo $firstProduct->mix."\n";
// example
echo $secondProduct->mix;
// example