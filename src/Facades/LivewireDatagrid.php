<?php

namespace AhrimFakhriy\LivewireDatagrid\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \AhrimFakhriy\LivewireDatagrid\LivewireDatagrid
 */
class LivewireDatagrid extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \AhrimFakhriy\LivewireDatagrid\LivewireDatagrid::class;
    }
}
