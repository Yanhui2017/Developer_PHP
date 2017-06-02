<?php

class Xml{
    public static function run(){
        $data = '';
        echo json_encode(self::xml2data($data));
    }

    //xml to data
    public static function xml2data($xml_string){
        return json_decode(json_encode(simplexml_load_string($xml_string)), true);
    }
}


Xml::run();
