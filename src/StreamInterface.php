<?php

namespace Jiromm;

interface StreamInterface
{
    /**
     * @return Resource
     */
    public function getResource();

    public function run();
}
