<?php

/**
* 注册台模式并不是很常见，它也不是一个典型的创建模式，只是为了利用静态方法更方便的存取数据。
* Registry class
*/

class Package {

    protected static $data = array();

    public static function set($key, $value) {
        self::$data[$key] = $value;
    }

    public static function get($key) {
        return isset(self::$data[$key]) ? self::$data[$key] : null;
    }

    final public static function removeObject($key) {
        if (array_key_exists($key, self::$data)) {
            unset(self::$data[$key]);
        }
    }
}


Package::set('name', 'Package name');

print_r(Package::get('name'));
// Package name