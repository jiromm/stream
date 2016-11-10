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
     * @var array
     */
    protected $events;

    /**
     * @param StreamInterface $stream
     */
    public function __construct(StreamInterface $stream)
    {
        $this->stream = $stream;
    }

    /**
     * @param Callable $callback
     */
    public function fetch(Callable $callback)
    {
        $this->callback = $callback;
    }

    public function run()
    {
        if (isset($this->events['start'])) {
            $startCallback = $this->events['start'];
            $startCallback();
        }

        while ($line = stream_get_line($this->stream->getResource(), 65535, PHP_EOL)) {
            $callback = $this->callback;
            $callback($line);

            if (ob_get_level() > 0) {
                ob_flush();
                flush();
            }
        }

        fclose($this->stream->getResource());

        if (isset($this->events['finish'])) {
            $startCallback = $this->events['finish'];
            $startCallback();
        }
    }

    /**
     * @param string $event
     * @param Callable $callback
     */
    public function on($event, Callable $callback)
    {
        $this->events[$event] = $callback;
    }
}
