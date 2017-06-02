<?php

class Sort{

    public static $sort_arr = [2,1,4,5,75,3,2,5,6];
    public static $index    = 0;

    public static function bobo(){
        $sort_arr = self::$sort_arr;
        $j = $k = 0;
        $count = count($sort_arr);
        for($j; $j<$count; $j++){
            for(;$k<$count-1;$k++){
                if($sort_arr[$k] > $sort_arr[$k+1]){
                    $tmp = $sort_arr[$k];
                    $sort_arr[$k]   = $sort_arr[$k+1];
                    $sort_arr[$k+1] = $tmp;
                }
            }
            $k = $j;
        }
        echo json_encode($sort_arr);
    }


    public function bobo2(){
        $index = self::$index;
        if(self::$index > 20){
            echo count(self::$sort_arr);
        }
        if($index < count(self::$sort_arr)-1){
            if(self::$sort_arr[$index] > self::$sort_arr[$index+1]){
                $tmp = self::$sort_arr[$index];
                self::$sort_arr[$index]   = self::$sort_arr[$index+1];
                self::$sort_arr[$index+1] = $tmp;
            }
            self::$index++;
            self::bobo2();
        }else{
            echo json_encode(self::$sort_arr);
        }
    }
}

Sort::bobo();

// 递归实现
//Sort::bobo2();