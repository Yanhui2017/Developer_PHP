autoload
-

###方式
* require和include的区别: require出错的话直接出错结束执行，include的话会报警，但是还是会继续执行代码。所以require用来加载各种公共库比较好， inlcude适合加载数据模板，不影响渲染。
* require和require_once区别: require_once会避免重复引入定义，但是消耗性能。require相反。性能和便捷性需要自身平衡。
* set_include_path 可以将库的文件夹加到包含路径里面去，能够节省一部分的代码量。

####如果程序需要引入很多外部库和文件，那么代码就像这样:
```
// load.php
require 'aaa_class.php'; //包含 MyClass类
require 'bbb_class.php';
require 'ccc_class.php';
require 'ddd_class.php';
require 'eee_class.php';
require 'fff_class.php';
.................
```
require的代码越来越多，打开这个页面的时候加载打开速度会很慢，并且这种意大利面条的代码看着很恶心。
下面__autoload方法该出来了。

```
// autoload.php
function __autoload($classname) {
        $filename = "./". $classname .".php";
        include_once($filename);
    // .......
}
// load.php
require('autoload.php');
$c = new MyClass();
```
通过这种方式完成了自动加载，但是这个方法有2个问题，第一函数不能自定义，必须是__autoload, 还有就是函数只能加载一次，不能在运行时进行改变。
下面就有了升级版 spl_autoload_register.

```
spl_autoload_register('lib_loader');
spl_autoload_register('class_loader');
spl_autoload_register('Foo::test');
Class Foo{
    public static test($classname){
            $filename =  $classname .".php";
            include_once($filename);
    }
}
function lib_loader($classname) {
    $filename = "./lib_loader/". $classname .".php";
    include_once($filename);
}
function class_loader($classname) {
    $filename = "./class_loader/". $classname .".php";
    include_once($filename);
}
```

从上面可以看出, spl_autoload_register可以使用自定义的函数来进行自动加载，甚至可以使用类方法。
并且自动加载函数可以从上到下执行。但是还是有一个问题，每次我引入外部库的时候，都需要维护和添加这些代码，很是麻烦。
ok，终极大boss来了， Composer。
将上面的lib_loader和class_loader通过composer来加载。一般是先有这么个composer.json文件。

```
{
"require": {
        "google/apiclient": "1.0.*@beta",
        "guzzlehttp/guzzle": "~4.0"
    },
     "autoload": {
        "classmap": [
            "lib_loader",
            "class_loader"
        ]
    }
}
```
然后执行 Composer install， 在调用2个类的文件开头写 require 'vendor/autoload.php'; 即可在按需加载类。

