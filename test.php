<?php
/**
 * Created by xiao_feng@hunliji.com
 * Date: 2017/10/26
 * Time: 13:58
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
require_once __DIR__.'/Workerman/Autoloader.php';

$http_worker = new Worker("http://0.0.0.0:2345");

$http_worker -> count = 4;

$http_worker->onMessage = function ($connection,$data){
  $connection->send("hello world");
};

Worker::runAll();