<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/5/10
 * Time: 15:06
 */
require_once __DIR__."Workerman/Autoloader.php";
use Workerman\Worker;

$text_worker = new Worker("MyTextProtocol://0.0.0.0:5678");

$text_worker -> onMessage = function ($connection,$data){
    var_dump($data);
    $connection -> send("hello world");
};

Worker::runAll();