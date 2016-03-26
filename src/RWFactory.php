<?php
/**
 * Created by IntelliJ IDEA.
 * User: KryDos
 * Date: 23/03/16
 * Time: 00:28
 */

namespace PHPNotifier;


use PHPNotifier\interfaces\ReaderInterface;
use PHPNotifier\interfaces\RWInterface;
use PHPNotifier\interfaces\WriterInterface;

class RWFactory implements RWInterface
{
    protected $reader;
    protected $writer;

    /**
     * RWFactory constructor.
     *
     * @param $method method of reader/writer
     * @param $store path to file or db name
     */
    public function __construct($method, $store)
    {
        $reader_class = '\PHPNotifier\\' . $method.'Reader';
        $writer_class = '\PHPNotifier\\' . $method.'Writer';
        if (!class_exists($reader_class)) {
            throw new \InvalidArgumentException('Class ' . $reader_class . ' does not exist');
        }

        if (!class_exists($writer_class)) {
            throw new \InvalidArgumentException('Class ' . $writer_class . ' does not exist');
        }

        $this->reader = new $reader_class($store);
        $this->writer = new $writer_class($store);
    }

    /**
     * returns writer
     *
     * @return WriterInterface
     */
    public function getWriter()
    {
        return $this->writer;
    }

    /**
     * returns reader
     *
     * @return ReaderInterface
     */
    public function getReader()
    {
        return $this->reader;
    }
}