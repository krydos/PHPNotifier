<?php
/**
 * Created by IntelliJ IDEA.
 * User: KryDos
 * Date: 22/03/16
 * Time: 22:10
 */

namespace PHPNotifier;


use PHPNotifier\interfaces\TaskInterface;

class Task implements TaskInterface
{
    protected $id;
    protected $timestamp;
    protected $command;
    protected $params;

    public function __construct($timestamp, $command, $params, $new = true)
    {
        $this->id = ($new ? uniqid() : null);
        $this->timestamp = $timestamp;
        $this->command = $command;
        $this->params = $params;
    }

    /**
     * @param $object
     * @return Task
     */
    public static function fillTask($object)
    {
        $task = new self($object->execution_time, $object->command, $object->params, false);
        $task->id = $object->id;

        return $task;
    }

    /**
     * returns unix timestamp
     * of when command should be executed
     *
     * @return int
     */
    public function getTimeToExecute()
    {
        return $this->timestamp;
    }

    /**
     * returns command name
     * to execute
     *
     * @return string
     */
    public function getCommand()
    {
        return $this->command;
    }

    /**
     * returns array of parameters
     *
     * @return array
     */
    public function getParamsArray()
    {
        $this->params;
    }

    /**
     * returns string of parameters
     *
     * @return mixed
     */
    public function getParamsString()
    {
        $params_string = '';

        if (is_array($this->params)) {
            foreach ($this->params as $item) {
                $params_string .= ' ' . $item;
            }
        }

        return $params_string;
    }

    /**
     * returns id of the task
     *
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * executes command
     *
     * @return null
     */
    public function execute()
    {
        exec($this->getCommand() . $this->getParamsString());
    }
}