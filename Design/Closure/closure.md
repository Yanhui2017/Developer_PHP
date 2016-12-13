##闭包

####介绍
* 闭包一般会用在 array_map 这样的函数里面作为一个匿名函数参量来使用。
* 闭包的use关键字可以给闭包带来新的状态变量
* 闭包的bindTo方法的使用场景可以用来访问绑定闭包的对象中受保护和私有的成本变量。

举一个路由分发的例子。

```
class App{
        protected $routes = [];
        protected $responseStatus = '200 OK';
        protected $responseContent = 'text/html';
        protected $responseBody = 'hello world';

        public function addRoute($routePath, $routeCallback)
        {
            $this->routes[$routePath] = $routeCallback->bindTo($this, __CLASS__);
        }

        public function dispatch($currentPath){
            foreach ($this->routes as $routepath=>$callback) {
                if($routepath == $currentPath){
                    $callback();
                }
            }

            header('HTTP/1.1 ' . $this->responseStatus);
            header('Content-type: ' . $this->responseContent);
            header('Content-length: ' . mb_strlen($this->responseBody));
            echo $this->responseBody;
        }
}

$app = new App();
$app->addRoute('/user/no13bus', function(){
    //闭包调用内部收保护的变量 使用use是不能做到的。
    $this->responseContent = 'application/json;charset=utf8';
    $this->responseBody = '{"name":"no13bus"}';
});

$app->dispatch('/user/no13bus');
// 返回 '{"name":"no13bus"}
```