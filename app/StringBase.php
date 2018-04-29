<?php

namespace App;


class StringBase
{

    /**
     * 生成Node ID
     * @return string
     */
    static public function getNodeId()
    {
        return sha1(self::generateString(),true);
    }

    /**
     * 生成指定长度字符串
     * @param int $length 长度
     * @return string $str
     */
    public static function generateString( $length = 20 )
    {
        $str = '';
        for ($i = 0;$i < $length; $i++)
        {
            $str .= chr(mt_rand(0,255));
        }
        return $str;
    }

    /**
     * 根据指定ID生成NODE ID
     * @param $id
     * @param $nid
     * @return bool|string
     */
    public static function getSubstrNodeId($id,$nid)
    {
        if(empty($id)) return false;
        if(empty($nid)) return false;

        return substr($id,0,10) . substr($nid,10,10);
    }

}