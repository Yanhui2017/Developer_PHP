<?php
function __autoload($classname) {
    $filename = "./". $classname .".php";
    include_once($filename);
    // .......
}

