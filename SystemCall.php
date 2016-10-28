<?php
/**
 * Created by hyw.
 * Info:
 * Date: 2016/10/28
 * Time: 14:13
 */

namespace schedule;


class SystemCall
{
    protected $callback;

    public function __construct($callback){
        $this->callback=$callback;
    }

    public function __invoke(Task $task,Scheduler $scheduler)
    {
        $callback=$this->callback;
        return $callback($task,$scheduler);
    }

}