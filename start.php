<?php
/**
 * Created by xiao_feng@hunliji.com
 * Date: 2017/11/1
 * Time: 10:49
 *   ┏┓　　　┏┓
 * ┏┛┻━━━┛┻┓
 * ┃　　　　　　　┃
 * ┃　　　━　　　┃
 * ┃　┳┛　┗┳　┃
 * ┃　　　　　　　┃
 * ┃　　　┻　　　┃
 * ┃　　　　　　　┃
 * ┗━┓　　　┏━┛
 *    ┃　　　┃
 *    ┃　　　┃
 *    ┃　　　┗━━━┓
 *    ┃　　　　　　　┣┓
 *    ┃　　　　　　　┏┛
 *    ┗┓┓┏━┳┓┏┛
 *      ┃┫┫　┃┫┫
 *      ┗┻┛　┗┻┛
 *        神兽保佑
 *        代码无BUG!
 */
use Workerman\Worker;
require_once 'Workerman/Autoloader.php';

$global_uid = 0;

// 当客户端连上来时分配uid，并保存连接，并通知所有客户端
function handle_connection($connection) {
    global $text_worker, $global_uid;
    // 为这个链接分配一个uid
    $connection->uid = ++$global_uid;
    foreach ($text_worker->connections as $conn) {
        $conn->send("user[{$connection->uid}] online");
    }
}

// 当客户端发送消息过来时，转发给所有人
function handle_message($connection, $data) {
    global $text_worker;
    foreach ($text_worker->connections as $conn) {
        $conn->send("user[{$connection->uid}] said: $data");
    }
}

// 当客户端断开时，广播给所有客户端
function handle_close($connection) {
    global $text_worker;
    foreach ($text_worker->connections as $conn) {
        $conn->send("user[{$connection->uid}] logout");
    }
}

$text_worker = new Worker("websocket://104.224.182.173:2347");

$text_worker->count = 1;

$text_worker->onConnect = 'handle_connection';
$text_worker->onMessage = 'handle_message';
$text_worker->onClose = 'handle_close';

Worker::runAll();