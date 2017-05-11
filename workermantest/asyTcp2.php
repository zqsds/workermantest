<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/5/11
 * Time: 14:51
 */
use Workerman\Worker;
use Workerman\Connection\AsyncTcpConnection;
require_once __DIR__ . '/Workerman/Autoloader.php';

$worker = new Worker();

$worker->onWorkerStart = function($worker){
    // 设置访问对方主机的本地ip及端口(每个socket连接都会占用一个本地端口)
    $context_option = array(
        'socket' => array(
            // ip必须是本机网卡ip，并且能访问对方主机，否则无效
            'bindto' => '172.16.10.183:2333',
        ),
    );

    $con = new AsyncTcpConnection('ws://echo.websocket.org:80', $context_option);

    $con->onConnect = function($con) {
        $con->send('hello');
    };

    $con->onMessage = function($con, $data) {
        $con -> send("$data");
    };

    $con->connect();
};

Worker::runAll();