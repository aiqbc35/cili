<?php
ini_set('display_errors','on');
require './vendor/autoload.php';
use App\Run;

define('BASEPATH', dirname(__FILE__));


$server = new swoole_server('0.0.0.0',6882,SWOOLE_BASE,SWOOLE_SOCK_UDP);

$server->set([
    'worker_num' => 4,    //设置启动的worker进程数
    'daemonize' => true,  //是否后台守护进程
    'max_request' => 100,   //允许最大连接数, 不可大于系统ulimit -n的值,防止 PHP 内存溢出, 一个工作进程处理 X 次任务后自动重启 (注: 0,不自动重启)
    'dispatch_mode' => 2,//保证同一个连接发来的数据只会被同一个worker处理
    'log_file' => BASEPATH . '/logs/error.log',
    'max_conn'=>65535,//最大连接数
    'heartbeat_check_interval' => 5, //启用心跳检测，此选项表示每隔多久轮循一次，单位为秒
    'heartbeat_idle_time' => 10, //与heartbeat_check_interval配合使用。表示连接最大允许空闲的时间
]);

$server->start();


$dht = new Run();

$dht->joinDht();


