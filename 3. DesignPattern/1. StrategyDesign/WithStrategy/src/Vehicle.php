<?php

namespace Src;

use Src\MoveStrategy;

abstract class Vehicle
{
    /**
     * @var MoveStrategy
     */
    protected $moveStrategy;

    public function __construct(MoveStrategy $moveStrategy)
    {
        $this->moveStrategy = $moveStrategy;
    }

    /**
     * @param MoveStrategy $moveStrategy
     * @return void
     */
    public function setMoveStrategy(MoveStrategy $moveStrategy): void
    {
        $this->moveStrategy = $moveStrategy;
    }

    /**
     * @return string
     */
    public function performMove(): string
    {
        return $this->moveStrategy->move();
    }

    /**
     * @return string
     */
    abstract public function getType(): string;
}