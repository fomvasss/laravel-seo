<?php

namespace Fomvasss\Seo\Facades;

class Seo extends \Illuminate\Support\Facades\Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return \Fomvasss\Seo\Seo::class;
    }
}