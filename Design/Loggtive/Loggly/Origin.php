<?php

class Origin{
    public function __autoload(){
        
        global $config;

        
        $config =  include dirname(__DIR__).'/Loggly/functions.php';
        require_once dirname(__DIR__).'/config.php';
        require_once __DIR__.'/functions.php';
    }
}