<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/5/11
 * Time: 15:49
 */
use \Workerman\Worker;
use \Workerman\Connection\AsyncTcpConnection;
require_once __DIR__ . '/Workerman/Autoloader.php';

$worker = new Worker('tcp://0.0.0.0:8484');

$worker->onWorkerStart = function($worker)
{
    $con = new AsyncTcpConnection('ws://echo.websocket.org:80');
    $con->onConnect = function($con) {
        $con->send('hello');
    };
    $con->onMessage = function($con, $msg) {
        echo "recv $msg\n";
    };
    $worker->onClose = function($connection) {
        global $worker;
        foreach ($worker->connection as $conn){
            $conn->send("断线重连");
        }
        // 如果连接断开，则在1秒后重连
        $connection->reConnect(1);
    };
    $con->connect();
};

Worker::runAll();