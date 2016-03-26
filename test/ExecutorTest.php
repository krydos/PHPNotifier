<?php
require __DIR__ . "/../vendor/autoload.php";
/**
 * Created by IntelliJ IDEA.
 * User: KryDos
 * Date: 26/03/16
 * Time: 18:22
 */
class ExecutorTest extends PHPUnit_Framework_TestCase
{
    public function testCheckDefaultClass()
    {
        $this->assertTrue(class_exists('\PHPNotifier\Executor'));
    }
}