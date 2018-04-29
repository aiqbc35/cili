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

    private $stringBase;

    /**
     * Run constructor.
     * @param $stringBase
     */
    public function __construct(StringBase $stringBase)
    {
        $this->stringBase = $stringBase;
    }


    /**
     * 加入DHT网络
     * @return void
     */
    public function joinDht()
    {
        $noodes = self::$bootstrapNodes;

        foreach ($noodes as $noode)
        {
            //gethostbyname 获取互联网主机名对应的 IPv4 地址列表
            return $this->findNode(array(gethostbyname($noode[0]),$noode[1]));
        }
    }


    private function findNode($nodeInfo,$id = null)
    {
        $nid = $this->stringBase::getNodeId();

        if (is_null($id)){
            $nodeid = $nid;
        }else{
            $nodeid = $this->stringBase::getSubstrNodeId($id,$nid);
        }
        if(empty($nodeid)) return false;

        $msg = [
            't' => $this->stringBase::generateString(2),
            'y' => 'q',
            'q' => 'findNode',
            'a' => [
                'id' => $nid,
                'target' => $nodeid
            ],
        ];

        $result = $this->sendResponse($nodeInfo,$msg);
        dump($result);
    }

    /**
     * 发对端送数据
     * @param $msg  发送发的数据
     * @param $address 对方链接信息
     * @return void
     */
    private function sendResponse($msg,$address)
    {
        global $server;
        return $server->sendto($address[0],$address[1],Bencode::encode($msg));
    }

}