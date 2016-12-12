<?php

// namespace和use  是在建立文件的时候就指明文件的命名空间，就是给文件加一个标示。
// 建立之后要用到该文件的时候要通过命名空间然后加上类名，但是在这之前要先导入include
// __autoload 是在实例化对象的时候没有找到类名就会autoload
namespace Design\Reflection;
use Design\Reflection\reflection_use\reflection_use;

require_once '../Common/functions.php';
// 需要先引入
require_once './reflection_use/reflection_use.php';

defined('CONF_PATH') or define('CONF_PATH','./');
// 反射类和实例化类效率哪个高? 
// 实例化类用的更高，反射类在一些模式中用的较多

class Reflection{

    public function __construct(){
        if (!file_exists(CONF_PATH."staticinit.php")) return;
        $static_init = include CONF_PATH."staticinit.php";
        foreach ($static_init as $class => $init) {
            echo $class.'.php'."\n";
        }
        $this->default_init();
    }
    /**
     * 默认加载类
     * @access protected
     * @return string
     */
    protected function default_init() {
        if (!file_exists(CONF_PATH."staticinit.php")) return;
        $static_init = include CONF_PATH."staticinit.php";
        foreach ($static_init as $class => $init) {
            $config = null;

            // 如果传入的配置参数是字符串，那么从配置里读取
            if (is_string($init)) $config = C($init);

            // 读取配置项
            if (empty($config)) $config = $static_init[$class];

            //初始化类并且传入所需的参数
            $class::init($config);
        }
    }
}

//$name = new Design\Reflection\reflection_use::init();
$reflection = new Reflection();