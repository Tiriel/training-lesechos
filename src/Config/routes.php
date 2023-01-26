<?php

namespace App\Config;

use App\Routing\Route;

const ROUTES = [
    new Route(
        'main_index',
        '/',
    ),
    new Route(
        'main_contact',
        '/contact',
    ),
    new Route(
        'post_list',
        '/posts',
    ),
    new Route(
        'post_show',
        '/posts/{slug}',
        requirements: ['slug' => '\w+']
    ),
];
