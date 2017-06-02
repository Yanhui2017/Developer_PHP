<?php

class parents{
    
    public function go(){
        echo $this->path;
    }
}


class sons extends parents{

    public $path = '123';

    public function goo(){
        echo $this->go();
    }

}

$ss = new sons();
$ss->goo();