<?php
/**
 * Created by IntelliJ IDEA.
 * User: KryDos
 * Date: 23/03/16
 * Time: 00:24
 */

namespace PHPNotifier\interfaces;


interface RWInterface
{
    /**
     * returns writer
     *
     * @return WriterInterface
     */
    public function getWriter();

    /**
     * returns reader
     *
     * @return ReaderInterface
     */
    public function getReader();
}