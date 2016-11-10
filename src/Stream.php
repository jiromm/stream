<?php

namespace Jiromm;

class Stream
{
    /**
     * @var StreamInterface|Resource
     */
    protected $stream;

    /**
     * @var Callable
     */
    protected $callback;

    /**
     * @param StreamInterface $stream
     */
    public function __construct(StreamInterface $stream)
    {
        $this->stream = $stream;
    }

    public function fetch(Callable $callback)
    {
        $this->callback = $callback;
    }

    public function run()
    {
        while ($line = stream_get_line($this->stream->getResource(), 65535, PHP_EOL)) {
            $callback = $this->callback;
            $callback($line);

            if (ob_get_level() > 0) {
                ob_flush();
                flush();
            }
        }

        fclose($this->stream->getResource());
    }
}
