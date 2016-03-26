<?php
use PHPNotifier\Task;

require __DIR__ . "/../vendor/autoload.php";
/**
 * Created by IntelliJ IDEA.
 * User: KryDos
 * Date: 23/03/16
 * Time: 00:47
 */
class FileReaderTest extends PHPUnit_Framework_TestCase
{
    public function testGetTasksToExecute()
    {
        $store_file = __DIR__ . '/tmp/file_for_test';
        $notifier = new \PHPNotifier\PHPNotifier('File', $store_file);

        $current_time = time();

        /**
         * I'm going to record 3 items
         * since I'm not sure how fast tests are executing
         * and this test is time sensitive
         */
        $notifier->scheduleTaskAtTime($current_time - 1, 'ls');
        $notifier->scheduleTaskAtTime($current_time, 'ls');
        $notifier->scheduleTaskAtTime($current_time + 1, 'ls');

        /** @var Task[] $tasks */
        $tasks = $notifier->getReader()->getTasksToExecute();
        $this->assertFalse(empty($tasks));
        $this->containsOnlyInstancesOf(Task::class);

        unlink($store_file);
    }

    public function testGetTasksToExecuteIfThereIsNoTasks()
    {
        $store_file = __DIR__ . '/tmp/file_for_test';
        $notifier = new \PHPNotifier\PHPNotifier('File', $store_file);

        $current_time = time();

        /**
         * I'm going to record 3 items
         * all items are from passed
         */
        $notifier->scheduleTaskAtTime($current_time - 1, 'ls');
        $notifier->scheduleTaskAtTime($current_time - 2, 'ls');
        $notifier->scheduleTaskAtTime($current_time - 3, 'ls');

        /** @var Task[] $tasks */
        $tasks = $notifier->getReader()->getTasksToExecute();
        $this->assertTrue(empty($tasks));

        unlink($store_file);
    }
}