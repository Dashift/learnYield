<?php
/**
 * Created by hyw.
 * Info:
 * Date: 2016/10/28
 * Time: 9:52
 */

namespace schedule;

use Generator;

class Task
{
    protected $taskId;
    protected $coroutine;
    protected $sendValue=null;
    protected $beforeFirstYield=true;

    public function __construct($taskId,Generator $coroutine)
    {
        $this->taskId=$taskId;
        $this->coroutine=$coroutine;
    }

    public function getTaskId(){
        return $this->taskId;
    }

    public function setSendValue($value){
        $this->sendValue=$value;
    }

    public function run(){
        if($this->beforeFirstYield){
            $this->beforeFirstYield=false;
            return $this->coroutine->current();
        }else{
            $retval=$this->coroutine->send($this->sendValue);
            $this->sendValue=null;
            return $retval;
        }
    }

    public function isFinished(){
        return !$this->coroutine->valid();
    }

}