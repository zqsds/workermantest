<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/5/11
 * Time: 13:59
 */
use Workerman\Worker;
require_once __DIR__ . '/Workerman/Autoloader.php';

$worker = new Worker('websocket://0.0.0.0:8484');
$worker->onMessage = function($connection, $data)
{
    // if something wrong
    $connection->destroy();
};
// 运行worker
Worker::runAll();