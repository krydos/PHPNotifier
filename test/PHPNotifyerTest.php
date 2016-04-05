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
        $notifier = new \PHPNotifier\PHPNotifier(\PHPNotifier\PHPNotifier::FILE_METHOD, 'test');
        $notifier->scheduleTaskAtTime(1000, '');
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testNotNumericTime()
    {
        $notifier = new \PHPNotifier\PHPNotifier(\PHPNotifier\PHPNotifier::FILE_METHOD, 'test');
        $notifier->scheduleTaskAtTime('unknown string', '', ['hello', 'world']);
    }

    public function testValidDateStringShouldBeAccepted()
    {
        $notifier = new \PHPNotifier\PHPNotifier(\PHPNotifier\PHPNotifier::FILE_METHOD, 'testdir');
        $notifier->scheduleTaskAtTime('2016-04-04 00:00:00', '', []);
    }
}