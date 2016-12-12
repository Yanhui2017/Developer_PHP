<?php
//构造者模式主要在于创建一些复杂的对象：

class Product {

    private $name;

    public function setName($name) {
        $this->name = $name;
    }

    public function getName() {
        return $this->name;
    }
}

abstract class Builder {

    protected $product;

    final public function getProduct() {
        return $this->product;
    }

    public function buildProduct() {
        $this->product = new Product();
    }
}

class FirstBuilder extends Builder {

    public function buildProduct() {
        parent::buildProduct();
        $this->product->setName('The product of the first builder');
    }
}

class SecondBuilder extends Builder {

    public function buildProduct() {
        parent::buildProduct();
        $this->product->setName('The product of second builder');
    }
}

class Factory {

    private $builder;

    public function __construct(Builder $builder) {
        $this->builder = $builder;
        $this->builder->buildProduct();
    }

    public function getProduct() {
        return $this->builder->getProduct();
    }
}

$firstDirector = new Factory(new FirstBuilder());
$secondDirector = new Factory(new SecondBuilder());

print_r($firstDirector->getProduct()->getName());
// The product of the first builder
print_r($secondDirector->getProduct()->getName());
// The product of second builder