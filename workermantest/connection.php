<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/5/11
 * Time: 10:16
 */

use Workerman\Worker;
require_once __DIR__."/Workerman/Autoloader.php";

$worker = new Worker('tcp://0.0.0.0:8484');

$worker -> onMessage = function ($connection){
    echo $connection -> id;
    var_dump($connection);
};

Worker::runAll();