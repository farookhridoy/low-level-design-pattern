<?php

namespace Src;

use Src\MoveStrategy;

class NoMove implements MoveStrategy
{
    public function move(): string
    {
        return "This vehicle does not move..";
    }
}