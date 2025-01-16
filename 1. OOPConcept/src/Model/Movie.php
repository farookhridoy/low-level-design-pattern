<?php

namespace Src\Model;

use Src\Interface\PricingContact;
use Src\Traits\HasMenuTraits;

class Movie implements PricingContact
{
    use HasMenuTraits;

    public function __construct()
    {
        $this->menus = [
            'Guardian Of the Galaxy',
            'Iron Man'
        ];
    }

    public function getPrice(): string
    {
        // TODO: Implement getPrice() method.
        return '122 tk';
    }
}