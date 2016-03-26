<?php
/**
 * Created by IntelliJ IDEA.
 * User: KryDos
 * Date: 22/03/16
 * Time: 22:23
 */

namespace PHPNotifier\interfaces;


interface TaskInterface
{
    /**
     * returns unix timestamp
     * of when command should be executed
     *
     * @return int
     */
    public function getTimeToExecute();

    /**
     * returns command name
     * to execute
     *
     * @return string
     */
    public function getCommand();

    /**
     * returns array of parameters
     *
     * @return array
     */
    public function getParamsArray();

    /**
     * returns string of parameters
     *
     * @return mixed
     */
    public function getParamsString();

    /**
     * returns id of the task
     *
     * @return mixed
     */
    public function getId();

    /**
     * executes command
     *
     * @return null
     */
    public function execute();
}