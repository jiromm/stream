<?php

namespace Jiromm;

class File implements StreamInterface
{
    public function __construct($filename)
    {
        $this->file = popen($filename, 'r');
    }

    public function getResource()
    {
        return $this->file;
    }
}
