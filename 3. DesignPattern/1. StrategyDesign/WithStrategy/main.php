<?php

use Src\Bike;
use Src\Car;
use Src\FastMove;
use Src\NoMove;
use Src\NormalMove;
use Src\SuperCar;

require 'vendor/autoload.php';

$bike = new Bike(new NormalMove());
echo $bike->getType() . ": " . $bike->performMove() . PHP_EOL;

$car = new Car(new FastMove());
echo $car->getType() . ": " . $car->performMove() . PHP_EOL;

$superCar = new SuperCar(new FastMove());
echo $superCar->getType() . ": " . $superCar->performMove() . PHP_EOL;

// Change strategy at runtime
$superCar->setMoveStrategy(new NoMove());
echo $superCar->getType() . ": " . $superCar->performMove() . PHP_EOL;