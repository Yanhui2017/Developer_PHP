<?php

class FE{

    public function goo(){
        $arrs = [1,2,3,4];

        foreach($arrs as $arr){
            echo $arr;
            return $arr;
        }
    }
}

$fe = new FE();

$times = [2,3];
foreach($times as $time){
    $fe->goo();

    sleep(2);
}