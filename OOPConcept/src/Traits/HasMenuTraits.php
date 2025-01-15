<?php

namespace Src\Traits;

trait HasMenuTraits
{
    public $menus;

    /**
     * @return void
     */
    public function getMenu()
    {
        return $this->menus;
    }
}