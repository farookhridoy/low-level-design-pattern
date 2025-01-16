<?php

namespace Src;

use Src\MoveStrategy;

class FastMove implements MoveStrategy
{
    public function move(): string
    {
        return "Moving at Fast speed.";
    }
}