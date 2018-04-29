<?php

namespace App;

use App\StringBase;

class Run
{
    //长期在线NODE
    private static $bootstrapNodes = array(
        array('router.bittorrent.com', 6881),
        array('dht.transmissionbt.com', 6881),
        array('router.utorrent.com', 6881)
    );

    //初始化路由器
    private $table = array();

    //自身node id
    private $nodeId = null;

    public function __construct()
    {
        echo $this->nodeId = StringBase::getNodeId();
    }


}