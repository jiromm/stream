<?php

namespace Jiromm;

class File implements StreamInterface
{
    /**
     * @var Resource
     */
    protected $file;

    /**
     * @param string $filename
     */
    public function __construct($filename)
    {
        $this->filename = $filename;
    }

    /**
     * @return Resource
     * @throws \Exception
     */
    public function getResource()
    {
        if (!is_resource($this->file)) {
            throw new \Exception('Resource not defined');
        }

        return $this->file;
    }

    public function run()
    {
        $this->file = popen($this->filename, 'r');
    }
}
