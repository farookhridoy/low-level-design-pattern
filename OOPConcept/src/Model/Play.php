<?php

namespace Src\Model;

use Src\AbstractClass\Vehicle;

class Play extends Vehicle
{
    /**
     * @return string
     */
    public function start()
    {
        return $this->brand . " start this";
    }

}