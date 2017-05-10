<?php
/**
 * Created by PhpStorm.
 * User: ZQ's
 * Date: 2017/5/10
 * Time: 14:56
 */
namespace Protocols;
class MyTextProtocol{
    //分包功能
    public static function input($recv_buffer){
        //查找换行符
        $pos = strpos($recv_buffer,"\n");
        if ($pos === false){
            return 0;
        }
        // 查找到换行符，返回当前包的长度，包括换行符
        return $pos+1;
    }

    // 收到一个完整的包后通过decode自动解码，这里只是把换行符trim掉
    public static function decode($recv_buffer)
    {
        return trim($recv_buffer);
    }

    // 给客户端send数据前会自动通过encode编码，然后再发送给客户端，这里加了换行
    public static function encode($data)
    {
        return $data."\n";
    }

}