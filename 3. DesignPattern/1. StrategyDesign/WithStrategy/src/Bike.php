<?php

namespace Src;

use Src\Vehicle;

class Bike extends Vehicle
{
    public function getType(): string
    {
        return "Bike";
    }
}