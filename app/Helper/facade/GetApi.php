<?php

namespace App\Helper\facade;

use Illuminate\Support\Facades\Facade;

class GetApi extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'GetApi';
    }

}
