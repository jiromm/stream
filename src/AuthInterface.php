<?php

namespace Jiromm;

interface AuthInterface
{
    /**
     * @param Resource $connection
     */
    public function authenticate($connection);
}
