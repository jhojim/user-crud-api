<?php

namespace SRC\Common;

use Slim\Http\Environment as SlimEnvironment;

class Environment extends SlimEnvironment
{
    public function __construct()
    {
        parent::__construct($_SERVER);
    }
}