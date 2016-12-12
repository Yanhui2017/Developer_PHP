<?php
//getError和通过传引用参数的方式其实是一样的。

class SelfClass{
    public $value;

    public function __construct(){
        echo '我要验证，通过类方法的形式来实例化对象也是可以的。'."\n";
    }

    public static function tryit(){
        $object = new self();
        $object->setValue('lio');
        echo $object->getValue();
    }

    public static function trytwo(){
        $this->setValue('anna');
    }

    public function setValue($val){
        $this->value = $val;
    }

    public function getValue(){
        return $this->value;
    }

    /**
     * 微信支付回调流程
     * @param $error
     * @return array|bool
     */
    public function parse_callback(&$error)
    {
        //获取传过来的xml
        $xml = $GLOBALS['HTTP_RAW_POST_DATA'];
        return $this->result_check($xml,$error);
    }
}

SelfClass::tryit();

//SelfClass::trytwo();


// $name = new SelfClass();
// $name->trytwo();
// echo $name->getValue();
?>