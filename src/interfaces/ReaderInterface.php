<?php
/**
 * Created by IntelliJ IDEA.
 * User: KryDos
 * Date: 22/03/16
 * Time: 23:33
 */

namespace PHPNotifier\interfaces;


interface ReaderInterface
{
    /**
     * returns list of tasks to execute
     *
     * @return TaskInterface[]
     */
    public function getTasksToExecute();
}