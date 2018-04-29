<?php

namespace App;

use App\StringBase;

class Run
{

    /**
     * 加入DHT网络
     * @return void
     */
    public function joinDht($bootstrapNodes)
    {

        foreach ($bootstrapNodes as $noode)
        {
            //gethostbyname 获取互联网主机名对应的 IPv4 地址列表
            return $this->findNode(array(gethostbyname($noode[0]),$noode[1]));
        }
    }


    private function findNode($nodeInfo,$id = null)
    {
        $nid = StringBase::getNodeId();

        if (is_null($id)){
            $nodeid = $nid;
        }else{
            $nodeid = StringBase::getSubstrNodeId($id,$nid);
        }
        if(empty($nodeid)) return false;

        $msg = [
            't' => StringBase::generateString(2),
            'y' => 'q',
            'q' => 'findNode',
            'a' => [
                'id' => $nid,
                'target' => $nodeid
            ],
        ];

        $result = $this->sendResponse($nodeInfo,$msg);
        var_dump($result);
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
        var_dump(Bencode::encode($msg) . 'yes or no');exit();
        return $server->sendto($address[0],$address[1],Bencode::encode($msg));
    }

}