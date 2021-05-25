<?php

namespace Orzcc\Amazon\ProductAdvertising\Facades;

use Illuminate\Support\Facades\Facade;
use Orzcc\Amazon\ProductAdvertising\Contracts\Factory;

class AmazonProduct extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return Factory::class;
    }
}
