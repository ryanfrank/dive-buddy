<?php

namespace Config;

use CodeIgniter\Config\Config;

class Filters extends Config
{
    public array $aliases = [
        'csrf'    => \CodeIgniter\Filters\CSRF::class,
        'toolbar' => \CodeIgniter\Filters\DebugToolbar::class,
        'honeypot' => \CodeIgniter\Filters\Honeypot::class,
        'auth'    => \App\Filters\Auth::class,
        'admin'   => \App\Filters\Admin::class,
    ];

    public array $globals = [
        'before' => [
            'honeypot',
            'csrf',
        ],
        'after' => [
            'toolbar',
        ],
    ];

    public array $methods = [];

    public array $filters = [
        // Auth filter: protect user/dive/rating routes
        'auth' => [
            'before' => [
                'user/*',
                'dives/log',
                'dives/*/edit',
                'dives/*/update',
                'dives/*/delete',
                'rating/*',
                'user/partners/*',
            ],
        ],
        // Admin filter: protect admin routes
        'admin' => [
            'before' => [
                'admin/*',
            ],
        ],
    ];
}
