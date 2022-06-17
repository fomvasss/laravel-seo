<?php

namespace Fomvasss\Seo\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Fomvasss\Seo\Seo
 */
class Seo extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Fomvasss\Seo\Seo::class;
    }
}
