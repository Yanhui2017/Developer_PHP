<?php

function C($name,$value=null){
    $config = include '../Conf/reflection.php';
    if(empty($name) || !key_exists($name,$config)) return;
    if(is_null($value)) return $config[$name];
    $config[$name] = $value;
}