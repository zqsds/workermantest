<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/5/11
 * Time: 11:01
 */
use Workerman\Worker;
use Workerman\Connection\TcpConnection;
require_once __DIR__ . '/Workerman/Autoloader.php';

$worker = new Worker('websocket://0.0.0.0:8484');
$worker->onConnect = function($connection)
{
    // 设置当前连接的应用层发送缓冲区大小为102400字节
    $connection->maxSendBufferSize = 102400;
};
// 运行worker
Worker::runAll();