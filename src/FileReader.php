<?php
/**
 * Created by IntelliJ IDEA.
 * User: KryDos
 * Date: 22/03/16
 * Time: 23:35
 */

namespace PHPNotifier;


use PHPNotifier\interfaces\ReaderInterface;
use PHPNotifier\interfaces\TaskInterface;

class FileReader implements ReaderInterface
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
     * returns list of tasks to execute
     *
     * @return TaskInterface[]
     */
    public function getTasksToExecute()
    {
        $current_time = time();

        if (!file_exists($this->db_name)) {
            return [];
        }

        $lines = file($this->db_name);

        $tasks = [];
        foreach ($lines as $line) {
            $task_json = json_decode($line);
            if ($current_time == $task_json->execution_time) {
                $tasks[] = Task::fillTask($task_json);
            }
        }

        return $tasks;
    }
}