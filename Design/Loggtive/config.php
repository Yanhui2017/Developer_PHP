<?php
return array(

    'interval' => 1 ,//1. ’2016-12-12‘，2. ‘2016-12-12-13’，3.’自定义‘
    'prefix'   => '',//前缀
    'interval' => '',//


    'level'    => 'EMERG,ALERT,ERR,DEBUG,INFO,RECORD,SQL,INVITE',

    'params'  => [
        'host' => gethostname(),
        'client_ip'=> get_client_ip(),
        'url' => $url_this = (isset($_SERVER['SERVER_NAME']) ? 'http://' . $_SERVER['SERVER_NAME'] . $_SERVER["REQUEST_URI"] : ''),
    ]
);