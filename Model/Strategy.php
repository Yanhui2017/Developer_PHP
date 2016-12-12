<?php

// Behavioral Patterns
// Strategy(策略模式)
// Strategy(策略模式)主要为了让客户类能够更好地使用某些算法而不需要知道其具体的实现。

interface OutputInterface {
    public function load();
}

class SerializedArrayOutput implements OutputInterface {
    public function load() {
        return serialize($arrayOfData);
    }
}

class JsonStringOutput implements OutputInterface {
    public function load() {
        return json_encode($arrayOfData);
    }
}

class ArrayOutput implements OutputInterface {
    public function load() {
        return $arrayOfData;
    }
}