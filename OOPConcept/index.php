<?php
require 'vendor/autoload.php';

use Src\Model\Concert;
use Src\Model\Movie;
use Src\Model\Play;

$concert = new Concert();
print_r($concert->getMenu());
print_r($concert->getPrice());

$movie = new Movie();
print_r($movie->getMenu());
print_r($movie->getPrice());

$car = new Play();
$car->setVehicle("Toyta");
$car->setVehicle("Labargini");
print_r($car->start());
$car->setVehicle("Cycle");
print_r($car->start());

