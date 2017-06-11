<?php
namespace TableManager\Facade;

use Illuminate\Support\Facades\Facade as Facade;

class TableManager extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'TableManager';
    }
}