<?php

class Object{
    
    public function test(){
        $os = new PInsert();

        $op_res = $this->pObject($os);

        echo $op_res;
    }

    private function pObject($os){

        $os->getName();
    }

}


class PInsert{

    public function getName(){
        return 123;
    }
}