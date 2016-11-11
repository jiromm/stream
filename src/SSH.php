<?php

namespace Jiromm;

class SSH implements StreamInterface
{
    /**
     * @var Resource $resource
     */
    protected $connection;

    /**
     * @var string
     */
    protected $host;

    /**
     * @var int
     */
    protected $port;

    /**
     * @var AuthInterface
     */
    protected $auth;

    /**
     * @var string
     */
    protected $command;

    /**
     * @var Resource|bool
     */
    protected $stream;

    /**
     * SSH constructor.
     *
     * @param string $host
     * @param int $port
     * @param AuthInterface $auth
     */
    public function __construct($host, $port, AuthInterface $auth)
    {
        $this->host = $host;
        $this->port = $port;
        $this->auth = $auth;
    }

    /**
     * @return bool|Resource
     * @throws \Exception
     */
    public function getResource()
    {
        if (!is_resource($this->stream)) {
            throw new \Exception('Resource not defined');
        }

        return $this->stream;
    }

    /**
     * @param string $command
     */
    public function exec($command)
    {
        $this->command = $command;
    }

    public function run()
    {
        $this->connection = ssh2_connect($this->host, $this->port);

        $this->auth->authenticate($this->connection);

        $this->stream = ssh2_exec($this->connection, $this->command);
        stream_set_blocking($this->stream, true);
    }
}
