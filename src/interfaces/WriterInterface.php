<?php
/**
 * Created by IntelliJ IDEA.
 * User: KryDos
 * Date: 22/03/16
 * Time: 22:32
 */

namespace PHPNotifier\interfaces;


interface WriterInterface
{
    /**
     * Writes task to the store
     *
     * @param TaskInterface $task
     * @return bool
     */
    public function write(TaskInterface $task);

    /**
     * replaces task by ID
     *
     * @param $id
     * @param TaskInterface $task
     * @return bool
     */
    public function replace($id, TaskInterface $task);

    /**
     * remove task from store
     *
     * @param $id
     * @return mixed
     */
    public function removeTaskById($id);

    /**
     * create file db or
     * db in any other place
     *
     * @return mixed
     */
    public function createDb();
}