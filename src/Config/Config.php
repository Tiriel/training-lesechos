<?php

namespace App\Config;

use App\Routing\Route;

class Config
{
    public static function getRoutes(): array
    {
        return [
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
    }

    public static function getTemplateContext(): array
    {
        return [
            '_contextTitle' => 'Test OOP',
        ];
    }
}
