<?php

namespace App;


class String
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
    private static function generateString( $length = 20 )
    {
        $str = '';
        for ($i = 0;$i < $length; $i++)
        {
            $str .= chr(mt_rand(0,255));
        }
        return $str;
    }

}