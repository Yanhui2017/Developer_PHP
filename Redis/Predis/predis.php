<?php
require '../../vendor/predis/predis/autoload.php';

$client = new Predis\Client([
    'scheme' => 'tcp',
    'host'   => '127.0.0.1',
    'port'   => 6379,
]);

//$response = $client->executeRaw(['SET', 'foo', 'bar']);
$client->subscribe('Lio', 'Lio');

//发布代码
// $redis = new Redis();
// $redis->connect('127.0.0.1',6379);
// $channel = $argv[1];  // channel
// $msg = $argv[2]; // msg
$client->publish('Lio', 123);


//订阅代码
// $redis = new Redis();
// $redis->connect('192.168.2.1',6379);
// $channel = $argv[1];  // channel
// $redis->subscribe(array('channel'.$channel), 'callback');
// function callback($instance, $channelName, $message) {
//   echo $channelName, "==>", $message,PHP_EOL;
// }