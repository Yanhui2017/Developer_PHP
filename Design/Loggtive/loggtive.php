<?php

namespace Loggtive;

class Start{
    public static function init(){
        require __DIR__.'/Loggly/BaseLog.php';
        require_once __DIR__.'/Loggly/functions.php';
        $GLOBALS['config'] = include dirname(__FILE__).'/config.php';
    }
        
}
Start::init();


use Loggtive\Loggly\BaseLog;

class XLog extends BaseLog{
    
    public function test(){
        $destination = "/tmp/mylogs/my-errors.log";
        $dir = dirname($destination);
        if (!is_dir($dir)) {
            $res = mkdir($dir, 0755, true);
        }
        // 调用 error_log() 的另一种方式:
        error_log("You messed up!", 3, $destination);
    }
	

}

$log = new XLog();
$log->test();