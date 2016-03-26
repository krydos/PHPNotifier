<?php
/**
 * Created by IntelliJ IDEA.
 * User: KryDos
 * Date: 22/03/16
 * Time: 22:19
 */

namespace PHPNotifier;


use PHPNotifier\interfaces\TaskInterface;
use PHPNotifier\interfaces\WriterInterface;

class FileWriter implements WriterInterface
{
    protected $db_name;

    public function __construct($path_to_store)
    {
        if (!is_string($path_to_store)) {
            throw new \InvalidArgumentException("Class accepts only string as store value");
        }

        $this->db_name = $path_to_store;
    }

    /**
     * Writes task to the store
     *
     * @param TaskInterface $task
     * @return bool
     */
    public function write(TaskInterface $task)
    {
        $json_record = json_encode([
            'id' => $task->getId(),
            'execution_time' => $task->getTimeToExecute(),
            'command' => $task->getCommand(),
            'params' => $task->getParamsString()
        ]);

        return (bool)file_put_contents($this->db_name, $json_record . "\n", FILE_APPEND);
    }

    /**
     * replaces task by ID
     *
     * @param $id
     * @param TaskInterface $task
     * @return bool
     */
    public function replace($id, TaskInterface $task)
    {
        // TODO: Implement replace() method.
    }

    /**
     * create file db or
     * db in any other place
     *
     * @return mixed
     */
    public function createDb()
    {
        if (is_dir($this->db_name)) {
            throw new \InvalidArgumentException('Directory with same name exists');
        }

        if (file_exists($this->db_name)) {
            return;
        }

        $resource = fopen($this->db_name, 'w');
        if (!$resource) {
            throw new \InvalidArgumentException('Cannot create store file in path ' . $this->db_name);
        }
    }

    /**
     * remove task from store
     *
     * @param $id
     * @return mixed
     */
    public function removeTaskById($id)
    {
        /** @var TaskInterface[] $tasks_with_removed_task */
        $tasks_with_removed_task = [];
        if (file_exists(($this->db_name))) {
            $lines = file($this->db_name);
            foreach ($lines as $line) {
                $task = Task::fillTask(json_decode($line));
                if ($task->getId() != $id) {
                    $tasks_with_removed_task[] = $task;
                }
            }
        }

        file_put_contents($this->db_name, '');

        foreach ($tasks_with_removed_task as $task) {
            $this->write($task);
        }
    }
}