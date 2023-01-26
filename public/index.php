<?php

require __DIR__.'/vendor/autoload.php';

use App\Blog;
use App\Http\Request;

$request = Request::create();

$app = new Blog();

$response = $app->handle($request);
$response->send();
