<?php
include 'SystemCall.php';
include 'Scheduler.php';
include 'Task.php';
use schedule\Scheduler;
use schedule\SystemCall;
use schedule\Task;
/**
 * Created by hyw.
 * Info:
 * Date: 2016/10/28
 * Time: 13:36
 */

function getTaskId(){
    return new SystemCall(function (Task $task,Scheduler $scheduler){
        $task->setSendValue($task->getTaskId());
        $scheduler->schedule($task);
    });
}

function task($max){
    $tid=(yield getTaskId());
    for ($i=0;$i<$max;$i++){
        echo "this is task  $tid iteration $i </br>";
        yield;
    }
}


$scheduler=new Scheduler();
$scheduler->newTask(task(10));
$scheduler->newTask(task(5));

function testYield(){
    yield getTaskId();
}

//var_dump(testYield()->current());
$scheduler->run();