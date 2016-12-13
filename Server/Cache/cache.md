cache
-

####opcache缓存技术

* zend opcache 利用字节码缓存，它会缓存预先编译好的字节码, 提高解释型语言的运行时效率。
opcache的设置问题

* opcache.enable=1        #是否开启opcache缓存
* opcache.revalidate_freq=60      #检查脚本时间戳是否有更新的周期，以秒为单位。 设置为 0 会导致针对每个请求， OPcache 都会检查脚本更新，这个配置在下文中会提到
* opcache.validate_timestamps=1 # zend opcache是否需要检测php脚本的变化
validate_timestamps参数调试环境设置为1。 生产环境设置建议设置为0，zend opcache察觉不到php脚本的变化，必要时可以手动清空。
使用opcache_reset函数即可。
opcache.revalidate_freq=0的话就是 设置为 0 会导致针对每个请求， OPcache 都会检查脚本更新，调试模式的时候设置为0即可。


####内置服务器
php内置了一服务器，可以不借助apache自己跑起来。

php -S localhost:8080 -c /path/php.ini //端口 配置文件可以指定来开启服务器
刚转到php的时候非常不习惯，因为没有交互命令行，什么结果都得要刷浏览器才能看见，php后来的版本里面提供了一个稍微可用的交互命令行。 
执行 php -a 即可打开，这点php较之python, node 差了好些。后来偶然发现了一个超级强大的命令行Psysh，喜欢的可以玩玩。
Laravel自带的shell就是它实现的。