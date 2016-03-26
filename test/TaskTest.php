<?php
require __DIR__ . "/../vendor/autoload.php";
/**
 * Created by IntelliJ IDEA.
 * User: KryDos
 * Date: 22/03/16
 * Time: 22:11
 */
class TaskTest extends PHPUnit_Framework_TestCase
{
    public function testClassExists()
    {
        $this->assertTrue(class_exists('\PHPNotifier\Task'));
    }

    public function testGetCommand()
    {
        $task = new \PHPNotifier\Task(1000, 'echo', [
            'Hello World',
            '>',
            'file'
        ]);

        $this->assertEquals('echo', $task->getCommand());
    }

    public function testGetParametersWithSpaces()
    {
        $task = new \PHPNotifier\Task(1000, 'echo', [
            'Hello World',
            '>',
            'file'
        ]);

        $params = $task->getParamsString();
        $this->assertEquals(' Hello World > file', $params);
    }

    public function testTaskExecuted()
    {
        $store_file = __DIR__ . '/tmp/test.file.created.by.test.task';
        $task = new \PHPNotifier\Task(1000, 'echo', [
            'Hello World',
            '>',
            $store_file
        ]);

        $task->execute();

        $this->assertTrue(file_exists($store_file));
        $test_file_content = file_get_contents($store_file);
        $this->assertEquals("Hello World\n", $test_file_content);

        unlink($store_file);
    }
}