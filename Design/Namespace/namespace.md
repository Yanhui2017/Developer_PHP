命名空间 namespace
-
####举个栗子:

```
//foo1.php
function test(){
    echo 'hello world';
}
//foo2.php
require('foo1.php');
//blabla 一堆代码
function test(){
    echo 'hello world';
}
```
在开发过程中会遇到引入别人写的库的情况，比如上面的foo2.php，如果在foo2.php中存在一个和foo1.php中的相同的函数 test, 那么代码执行的时候回报致命错误: Fatal error: Cannot redeclare test.....， 命名空间就是为了解决这样的冲突存在的。直接上代码:

```
//foo1.php
namespace No13bus;
function test(){
    echo 'hello world';
}
//foo2.php
require('foo1.php');
use function No13bus/test as tt; 
//blabla 一堆代码
function test(){
    echo 'heihei';
}
echo tt();  //返回: hello world
echo test(); //返回: heihei
```
上面的代码有几点说明:

将foo1.php中的函数归并于自己的命名空间并且设置别名(as)可以避免函数命名冲突。
use不仅仅使用别的命名空间的类，还可以用其方法和常量，不过要加上 function和constant关键字才可以。
foo2.php中的函数以及其余类，常量的命名空间没有声明，默认是全局空间, 一般用 \ 表示， 而不是 No13bus。 全局空间的方法和类只要require了，即可调用，无需use. 比如常见的Exception类:

```
try{
    $a = 2/0;
} catch(\Exception $e){
    echo $e->getMessage();
}
```
use function No13bus/test as tt; 如果修改为 use function No13bus/test; 还是会报错: Fatal error: Cannot declare function xxxxxx because the name is already in use....
use的位置要放到所在文件的全局作用域(namespace的下方, 类代码的上方)，这样会减少运行时解析，全部在编译期间解析，这样做的好处还有一个就是避免use的类定义和下面的代码有重复定义和声明问题。
trait性状这个php特性也是可以用use的，不过这个时候的use可以放到类里面，因为use trait的话，相当于把trait里面的代码复制了一份到类里面，是类的水平扩展，这个和命名空间其实是有区别的。

