<?php
namespace Src;
use Src\Vehicle;

class Car extends Vehicle {
    public function getType(): string {
        return "Car";
    }
}