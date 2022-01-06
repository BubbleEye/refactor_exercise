<?php

namespace app;

use Exception;

class Command
{
    public $parameter;

    public function __construct()
    {
        if ($_SERVER['argc'] !== 2) {
            throw new Exception('Ambiguous number of parameters!');
        }
        $this->parameter = $_SERVER['argv'][1];
    }
}