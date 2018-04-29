<?php

require './vendor/autoload.php';
use App\Run;

define('BASEPATH', dirname(__FILE__));
define('DEBIG',true);


$bootstrapNodes = array(
    array('router.bittorrent.com', 6881),
    array('dht.transmissionbt.com', 6881),
    array('router.utorrent.com', 6881)
);
$table = array();

if (DEBIG) {
    $whoops = new \Whoops\Run;
    $optionTitle = "框架出错了";
    $option = new \Whoops\Handler\PrettyPageHandler();
    $option->setPageTitle($optionTitle);
    $whoops->pushHandler($option);
    $whoops->register();
    ini_set('display_errors','on');
}


$server = new swoole_server('0.0.0.0',6882,SWOOLE_PROCESS,SWOOLE_SOCK_UDP);

$server->set([
    'worker_num' => 1,    //设置启动的worker进程数
    'daemonize' => false,  //是否后台守护进程
    'max_request' => 1,   //允许最大连接数, 不可大于系统ulimit -n的值,防止 PHP 内存溢出, 一个工作进程处理 X 次任务后自动重启 (注: 0,不自动重启)
//    'dispatch_mode' => 2,//保证同一个连接发来的数据只会被同一个worker处理
//    'log_file' => BASEPATH . '/logs/error.log',
//    'max_conn'=>1,//最大连接数
//    'heartbeat_check_interval' => 5, //启用心跳检测，此选项表示每隔多久轮循一次，单位为秒
//    'heartbeat_idle_time' => 10, //与heartbeat_check_interval配合使用。表示连接最大允许空闲的时间
]);




$server->on('WorkerStart', function($server, $worker_id){
    global $table,$bootstrapNodes;

    $run = new Run();
    //$run->joinDht($bootstrapNodes);
    echo "test \n";

    swoole_timer_tick(AUTO_FIND_TIME, function ($timer_id) {
        global $table,$bootstrapNodes;
        echo "jincheng \n";
    });

    swoole_process::signal(SIGCHLD, function($sig) {
        //必须为false，非阻塞模式
        while($ret =  swoole_process::wait(false)) {
              echo "PID={$ret['pid']}\n";
        }
    });
});

$server->on('Packet', function($server, $data, $fdinfo){
    if(strlen($data) == 0){
        return false;
    }

    var_dump($data);
});

$server->start();
