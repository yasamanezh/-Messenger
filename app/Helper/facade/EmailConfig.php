<?php

namespace App\Helper\facade;

use Illuminate\Support\Facades\Facade;

class EmailConfig extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'EmailConfig';
    }

}
