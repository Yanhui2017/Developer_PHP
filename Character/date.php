<?php
date_default_timezone_set('PRC');

//echo date('Y-m-d',strtotime('+1 day',strtotime('+1 month')));


$config = [1,2,3,4];

function C(){
    static $config = array();


    echo json_encode($config);
}

//C();

// 星期几

function xingqi($time){
    if(in_array(date('N'),[1,2,3,4,5]) && 1){
        echo in_array(date('N'),[1,2,3,4,5]);
    };
    echo date('N');
}
xingqi('2017-04-11');





class Date{
    public static function strtotime(){
        $date = '2017-10-10 12:12:12';

        echo strtotime($date);
    }
}


Date::strtotime();
