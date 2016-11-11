<?php

require '../vendor/autoload.php';

$auth = new \Jiromm\Password('login', 'password');
$ssh = new \Jiromm\SSH('host', 22, $auth);
$stream = new \Jiromm\Stream($ssh);

$stream->fetch(function ($line) {
    echo $line . PHP_EOL;
});

$ssh->exec('/bin/bash /var/deploy.sh');

$stream->run();
