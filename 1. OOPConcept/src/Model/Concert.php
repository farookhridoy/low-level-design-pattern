<?php

namespace Src\Model;

use Src\Interface\PricingContact;
use Src\Traits\HasMenuTraits;

class Concert implements PricingContact
{
    use HasMenuTraits;

    public function __construct()
    {
        $this->menus = [
            'Cocke',
            'Chicken Grill'
        ];
    }

    public function getPrice(): string
    {
        // TODO: Implement getPrice() method.
        return '120 tk';
    }
}