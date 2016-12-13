<?php
//闭包
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