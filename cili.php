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

echo $nodeId = String::getNodeId();die;

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
        //gethostbyname 获取互联网主机名对应的 IPv4 地址列表
        findNode(array(gethostbyname($node[0]),$node[1]));
    }
}

/**
 * 发送查询请求
 */
function findNode($ip,$port)
{

}

