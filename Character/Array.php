<?php

class arr_one {
    public static $array = [
        'name' => '123',
        'age' => 18,
        'ageq' => 188
    ];

    public function __construct(){
        //echo 999;
        //reset(self::$array);
        //echo next(self::$array);
    }

    public static function go(){
        //echo json_encode(array_shift($array));

        echo next(self::$array);

        //echo next($array);
        // echo json_encode(array_pop($array));
        // echo json_encode($array[0]);
    }
}


class arr_two extends arr_one{

    public function __construct(){
        //parent::__construct();
        //parent::go();
    }

    public function goo(){
        parent::go();
    }
}

class ArrThree{
    public function goo(){
        return [
            $name = 'lio',  //还可以这默写，哈哈

            'age' => $name.'123',
            'weight' => $name,
        ];
    }
}

// $Two = new arr_two();
// $Two->goo();
// $Two->goo();


$three = new ArrThree();
//echo json_encode($three->goo());

class chunk{
    public function run(){
        $array = [1,2,3,4,5,6,7];
        $ars = array_chunk($array,2);

        return $ars;
    }

    public function runs(){
        $array = [[1],[2],[3],[4],[5]];
        $ars = array_chunk($array,2);

        return $ars;
    }
}

$chunk = new chunk();
//echo json_encode($chunk->runs());

class ArraySearch{

    public function run(){
        $arr = [1,2,3,5,4];

        echo array_search(1,$arr);
    }
}

$search = new ArraySearch();
//$index = $search->run();


//empty 情况
class BoolToArr{

    public static function run(){
        $run_arr = false;
        if($run_arr['res'] == '000000'){
            echo 1;
        }else{
            echo 2;
        }
    }


    public function slice(){
        $arr = [1,2,3,4,5,6,7];

        echo json_encode(array_slice($arr,0,-1));
    }
}

BoolToArr::slice();




class Arrs{

    public static function empty_arr_fun(){
        $a = [];
        if($a['status'] == 0){
            echo 1;
        }else{
            echo 2;
        }
    }

    // 取交集，键值都比较
    public static function intersect(){
        $arr_one = [
            "name" => "lio",
            "age"  => 123
        ];

        $arr_two = [
            "name" => "anna",
            "age"  => 12123,
            "sex"  => "famele"
        ];

        $arr_three = [
            "name","age","sex"
        ];


        var_dump(array_intersect($arr_one,$arr_two));
        var_dump(array_intersect_key($arr_one,$arr_two));
        var_dump(array_intersect_key($arr_one,$arr_three));
    }

    public static function filter(){
        $fiter = [
            'name' => '',
            'age'  => '123'
        ];
        $us = [12,3];
        $filter_arr = array_filter($fiter,function($item) use ($us) {
            //echo json_encode($us);
            return !($item === null || $item === '');
        });

        //echo json_encode((false=='')); // true
        //echo json_encode((false==null)); // true
        
        var_dump($filter_arr);
    }
}




Arrs::empty_arr_fun();
echo "===== intersect ====".PHP_EOL;
Arrs::intersect();
echo "===== filter ====".PHP_EOL;
Arrs::filter();

