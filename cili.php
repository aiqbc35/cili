<?php
require './vendor/autoload.php';

// 长期在线node
$bootstrap_nodes = array(
    array('router.bittorrent.com', 6881),
    array('dht.transmissionbt.com', 6881),
    array('router.utorrent.com', 6881)
);

// 初始化路由器
$table = array();

/**
 * 自动加入DHT网络，在DHT网络中搜寻节点信息
 */
function autoFindNode()
{
    global $table;

    if (count($table) == 0) {
        return ;
    }

}

joinDht();

/**
 * 加入DHT网络
 */
function joinDht()
{
    global $table,$bootstrap_nodes;

    foreach ($bootstrap_nodes as $node){
        $host = gethostbyname($node[0]);
        echo 'URL:' . $node[0] . '---IP:' .$host . "< br />";
    }
}

/**
 * 发送查询请求
 */
function findNode()
{

}

