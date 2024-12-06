<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class kernel extends HttpKernel
{
    protected $routeMiddleware = [
        'admin' => \app\Http\Middleware\AdminMiddleware::class,
    ];
}
