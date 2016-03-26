<?php
/**
 * Created by IntelliJ IDEA.
 * User: KryDos
 * Date: 26/03/16
 * Time: 18:27
 */

namespace PHPNotifier\interfaces;


interface ExecutorInterface
{
    /**
     * run loop
     *
     * @return bool
     */
    public function run();

    /**
     * set reader for tasks
     *
     * @param ReaderInterface $reader
     * @return mixed
     */
    public function setReader(ReaderInterface $reader);

    /**
     * set tasks writer
     *
     * @param WriterInterface $writer
     * @return mixed
     */
    public function setWriter(WriterInterface $writer);
}