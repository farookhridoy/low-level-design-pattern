<?php

namespace Src;

use Src\MoveStrategy;

class NormalMove implements MoveStrategy
{
    public function move(): string
    {
        return "Moving at normal speed.";
    }
}