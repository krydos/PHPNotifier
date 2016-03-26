<?php
require __DIR__ . "/../vendor/autoload.php";
/**
 * Created by IntelliJ IDEA.
 * User: KryDos
 * Date: 22/03/16
 * Time: 21:27
 */
class PHPNotifierTest extends PHPUnit_Framework_TestCase
{
    public function testClassExists()
    {
        $this->assertTrue(class_exists('\PHPNotifier\PHPNotifier'));
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testExceptionWhenTryingToWriteIfWriterIsNotSet()
    {
        $notifier = new \PHPNotifier\PHPNotifier('File', 'test');
        $notifier->scheduleTaskAtTime(1000, '');
    }
}