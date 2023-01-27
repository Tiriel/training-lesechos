<?php

namespace App\Http\Enum;

enum RequestTypesEnum: string
{
    case REQUEST_TYPE_SUB = 'sub_request';
    case REQUEST_TYPE_MAIN = 'main_request';
}
