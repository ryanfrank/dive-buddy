<?php

namespace Config;

use CodeIgniter\Database\Config;

class Database extends Config
{
    public array $default = [
        'DBDriver'  => 'Postgre',
        'DBPrefix'  => '',
        'pConnect'  => false,
        'DBDebug'   => (ENVIRONMENT !== 'production'),
        'charset'   => 'UTF8',
        'DBCollat'  => '',
        'swapPre'   => false,
        'encrypt'   => false,
        'debug'     => false,
        'port'      => 5432,
    ];

    public array $development = [
        'DBDriver'  => 'Postgre',
        'username'  => getenv('database.default.username') ?: 'postgres',
        'password'  => getenv('database.default.password') ?: 'password',
        'database'  => getenv('database.default.database') ?: 'dive_buddy',
        'hostname'  => getenv('database.default.hostname') ?: 'localhost',
        'port'      => 5432,
        'DBDebug'   => true,
    ];

    public array $testing = [
        'DBDriver'  => 'Postgre',
        'username'  => getenv('database.default.username') ?: 'postgres',
        'password'  => getenv('database.default.password') ?: 'password',
        'database'  => getenv('database.default.database') ?: 'dive_buddy_test',
        'hostname'  => getenv('database.default.hostname') ?: 'localhost',
        'port'      => 5432,
        'DBDebug'   => true,
    ];

    public array $production = [
        'DBDriver'  => 'Postgre',
        'username'  => getenv('database.default.username') ?: 'postgres',
        'password'  => getenv('database.default.password') ?: '',
        'database'  => getenv('database.default.database') ?: 'dive_buddy',
        'hostname'  => getenv('database.default.hostname') ?: 'localhost',
        'port'      => 5432,
        'DBDebug'   => false,
    ];
}
