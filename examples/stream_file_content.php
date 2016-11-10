<?php

require '../vendor/autoload.php';

$file = new \Jiromm\File(__DIR__ . '/../bin/deploy.sh');
$stream = new \Jiromm\Stream($file);
$stream->fetch(function ($line) {
    echo $line . PHP_EOL;
});

$stream->on('start', function () {
    echo 'Started' . PHP_EOL;
});

$stream->on('finish', function () {
    echo 'Finished' . PHP_EOL;
});

$stream->run();
