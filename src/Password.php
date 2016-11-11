<?php

namespace Jiromm;

class Password implements AuthInterface
{
    /**
     * @var string
     */
    protected $login;

    /**
     * @var string
     */
    protected $password;

    /**
     * @param string $login
     * @param string $password
     */
    public function __construct($login, $password)
    {
        $this->login = $login;
        $this->password = $password;
    }

    /**
     * @param Resource $connection
     */
    public function authenticate($connection)
    {
        ssh2_auth_password($connection, $this->login, $this->password);
    }
}
