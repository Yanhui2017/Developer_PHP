<?php

namespace Design\Reflection\reflection_use;

class reflection_use{
    static protected $storage   =   null;

    public static function init($config = array()){
        // $type   =   isset($config['type']) ? $config['type'] : 'File';
        // $class  =   strpos($type,'\\')? $type: 'Think\\Log\\Driver\\'. ucwords(strtolower($type));
        // unset($config['type']);
        // self::$storage = new $class($config);
        echo '反射机制已经生效';
    }
}