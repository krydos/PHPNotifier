<?php
require __DIR__ . "/../vendor/autoload.php";

/**
 * Created by IntelliJ IDEA.
 * User: KryDos
 * Date: 22/03/16
 * Time: 23:10
 */
class FileWriterTest extends PHPUnit_Framework_TestCase
{
    public function testStoreShouldBeCreatedAfterWrite()
    {
        $store_file = __DIR__ . '/tmp/file_for_test';
        $phpNotifier = new \PHPNotifier\PHPNotifier('File', $store_file);

        $phpNotifier->scheduleTaskAtTime(1000, '');

        $this->assertTrue(file_exists($store_file));

        unlink($store_file);
    }

    public function testStoreFileShouldNotBeEmptyAfterInsert()
    {
        $store_file = __DIR__ . '/tmp/file_for_test';
        $phpNotifier = new \PHPNotifier\PHPNotifier('File', $store_file);

        $phpNotifier->scheduleTaskAtTime(1000, '');

        $file_data = file($store_file);

        $this->assertFalse(empty($file_data));

        unlink($store_file);
    }

    public function testRemoveTask()
    {
        $store_file = __DIR__ . '/tmp/file_for_test';
        $notifier = new \PHPNotifier\PHPNotifier('File', $store_file);

        $current_time = time();
        $notifier->scheduleTaskAtTime($current_time - 1, 'ls');
        $notifier->scheduleTaskAtTime($current_time, 'ls');
        $notifier->scheduleTaskAtTime($current_time + 1, 'ls');

        $this->assertEquals(3, count(file($store_file)));

        $tasks = $notifier->getReader()->getTasksToExecute();

        foreach ($tasks as $task) {
            $notifier->getWriter()->removeTaskById($task->getId());
        }

        $this->assertEquals(2, count(file($store_file)));

        unlink($store_file);
    }
}