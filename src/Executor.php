<?php
/**
 * Created by IntelliJ IDEA.
 * User: KryDos
 * Date: 26/03/16
 * Time: 18:29
 */

namespace PHPNotifier;


use PHPNotifier\interfaces\ExecutorInterface;
use PHPNotifier\interfaces\ReaderInterface;
use PHPNotifier\interfaces\WriterInterface;

class Executor implements ExecutorInterface
{
    /** @var ReaderInterface $reader */
    protected $reader;

    /** @var WriterInterface $writer */
    protected $writer;

    public function __construct(ReaderInterface $reader, WriterInterface $writer)
    {
        $this->reader = $reader;
        $this->writer = $writer;
    }

    /**
     * run loop
     *
     * @return bool
     */
    public function run()
    {
        while (true) {
            $tasks = $this->reader->getTasksToExecute();
            if (!empty($tasks)) {
                echo "Found " . count($tasks) . " to execute\n";
                foreach ($tasks as $task) {
                    echo "going to execute task - " . $task->getId() . " ('.$task->getCommand() . $task->getParamsString().')\n";
                    $task->execute();
                    echo "executed\n";
                    echo "removing task...\t";
                    $this->writer->removeTaskById($task->getId());
                    echo "done...\n";
                }
            }

            sleep(1);
        }
    }

    /**
     * set reader for tasks
     *
     * @param ReaderInterface $reader
     * @return mixed
     */
    public function setReader(ReaderInterface $reader)
    {
        $this->reader = $reader;
    }

    /**
     * set tasks writer
     *
     * @param WriterInterface $writer
     * @return mixed
     */
    public function setWriter(WriterInterface $writer)
    {
        $this->writer = $writer;
    }
}