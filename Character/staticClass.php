<?php

class Container
{

    /**
     * 创建一个对象池
     *
     * @var array
     */
    protected static $_service = [];

    //中间件中传递的同一个参数
    public static $param = [];

    /**
     * 获取类的参数
     *
     * @return array
     */
    public static function get_params(){
        return self::$param;
    }

    //protected static $service_key = [];
    /**
     * 类似于反射机制来初始化配置好的中间件,也可以放到外边操作对象的初始化.
     */
    public static function import()
    {
        $middle_wares = C('MiddleWare');
        foreach ($middle_wares as $middle_name => $middle_class) {
            //array_push(self::$service_key,$service_key);
            //echo json_encode($middle_class);
            $middle_object = new $middle_class();
            self::set($middle_name, $middle_object);
        }
    }

    /**
     * 支持进程中动态的添加中间件
     *
     * @param $name
     * @param $definition
     */
    public static function set($name, $definition)
    {
        //array_push(self::$service_key,$name);
        self::$_service[$name] = $definition;
    }

    /**
     *
     * @param $name
     * @return mixed|\stdClass
     */
    public static function get($name)
    {
        $definition = '';
        if (isset(self::$_service[$name])) {
            $definition = self::$_service[$name];
        } else {
            // 报异常
        }

        $instance = new \stdClass();
        if (is_object($definition)) {
            $instance = call_user_func($definition);
        }
        return $instance;
    }

    /**
     * 获取对象并删除对象
     *
     * @param $name
     * @return mixed|\stdClass
     */
    public function getDel($name){
        $definition = '';
        if (self::$_service[$name]) {
            $definition = self::$_service[$name];
        } else {
            // 报异常
        }

        $instance = new \stdClass();
        if (is_object($definition)) {
            $instance = call_user_func($definition);
        }
        self::del($name);
        return $instance;
    }

    /**
     * 如果继承,next放到子类中执行,就不需要初始化current()然后又next().建议拆出去.
     * @param string $params
     */
    public static function next($params = ''){
        //$key = key(self::$_service);
        //$class_object = array_shift(self::$_service);

        // current()
        $class_object = current(self::$_service);
        if($class_object !== false){
            $class_object::run(self::$param);
        }

        // next(),放到子类中去next()
        $class_object = next(self::$_service);
        if($class_object !== false){
            $class_object::run(self::$param);
        }
        //删除该键.
    }

    public static function del($name){
        if(array_key_exists($name,self::$_service)){
            //unset(self::$service_key[$name]);
            unset(self::$_service[$name]);
        }
    }

    public static function lists()
    {
        return self::$_service;
    }

    public static function has(){}


    // 执行一次就会顺序执行所有中间件
    public static function run(){
//        $class_object = current(self::$_service);
//        if($class_object !== false){
//            $class_object::run(self::$param);
//        }

        // next(),放到子类中去next()
        $class_object = next(self::$_service);
        if($class_object !== false){
            $class_object::run(self::$param);
        }
    }

    public static function start(){
        $class_object = current(self::$_service);
        if($class_object !== false){
            $class_object::run(self::$param);
        }
    }


    public static function __call($name, $arguments){
        self::exec();
    }

}




class RouteMiddle extends Container{

    public static function exec(){
        echo '我才是执行者';
    }
}


RouteMiddle::

