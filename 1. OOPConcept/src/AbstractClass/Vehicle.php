<?php

namespace Src\AbstractClass;

abstract class Vehicle extends VType
{
    protected $brand;

    abstract public function start();

    public function setVehicle($brand)
    {
        $this->brand = $brand .'/'. $this->type();
    }

    public function type()
    {
        return 'habijabi';
    }
}