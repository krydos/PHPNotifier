<?php
/**
 * Created by IntelliJ IDEA.
 * User: KryDos
 * Date: 22/03/16
 * Time: 21:31
 */

namespace PHPNotifier;


use PHPNotifier\interfaces\RWInterface;

class PHPNotifier
{
    /** @var  RWInterface $rw*/
    protected $rw;

    public function __construct($method, $store)
    {
        $this->rw = new RWFactory($method, $store);
    }

    protected function schedule(Task $task)
    {
        $this->rw->getWriter()->createDb();
        $this->rw->getWriter()->write($task);
    }

    public function scheduleTaskAtTime($when, $command, array $params = [])
    {
        $task = new Task($when, $command, $params);
        $this->schedule($task);
    }

    public function scheduleTaskIn($run_after, $command, array $params = [])
    {
        $task = new Task((time() + $run_after), $command, $params);
        $this->schedule($task);
    }

    public function getReader()
    {
        return $this->rw->getReader();
    }

    public function getWriter()
    {
        return $this->rw->getWriter();
    }
}