<?php

class A{
    private $name = 16;
}

class B extends A{
    private $name = 17;


    public function getName(){
        echo $this->name;
    }

    public function __toString(){
        $desc = $this->name;
        print_r (get_declared_classes());
        // echo gettype($desc);
        return (string)$desc;
    }
}


$b = new B();
print $b;

// $b->getName();

