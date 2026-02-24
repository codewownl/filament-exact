<?php

namespace CodeWOW\FilamentExact\Facades;

use Illuminate\Support\Facades\Facade;

class FilamentExact extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \CodeWOW\FilamentExact\FilamentExact::class;
    }
}
