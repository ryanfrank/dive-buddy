<?php

namespace Config;

use CodeIgniter\Database\Config;

class Database extends Config
{
    public string $filesPath = APPPATH . 'Database' . DIRECTORY_SEPARATOR;
    public string $defaultGroup = 'default';

    public array $default = [
        'DSN'          => '',
        'hostname'     => '192.168.2.40',
        'username'     => 'postgres',
        'password'     => 'OneP@ssw0rd4All!',
        'database'     => 'dive-buddy',
        'DBDriver'     => 'Postgre',
        'DBPrefix'     => '',
        'pConnect'     => false,
        'DBDebug'      => (ENVIRONMENT !== 'production'),
        'charset'      => 'UTF8',
        'DBCollat'     => '',
        'swapPre'      => false,
        'encrypt'      => false,
        'debug'        => false,
        'port'         => 5432,
    ];

    public array $development = [
        'DSN'          => '',
        'hostname'     => '192.168.2.40',
        'username'     => 'postgres',
        'password'     => 'OneP@ssw0rd4All!',
        'database'     => 'dive-buddy',
        'DBDriver'     => 'Postgre',
        'DBPrefix'     => '',
        'pConnect'     => false,
        'DBDebug'      => true,
        'charset'      => 'UTF8',
        'DBCollat'     => '',
        'swapPre'      => false,
        'encrypt'      => false,
        'debug'        => false,
        'port'         => 5432,
    ];

    public array $testing = [
        'DSN'          => '',
        'hostname'     => '192.168.2.40',
        'username'     => 'postgres',
        'password'     => 'OneP@ssw0rd4All!',
        'database'     => 'dive-buddy_test',
        'DBDriver'     => 'Postgre',
        'DBPrefix'     => '',
        'pConnect'     => false,
        'DBDebug'      => true,
        'charset'      => 'UTF8',
        'DBCollat'     => '',
        'swapPre'      => false,
        'encrypt'      => false,
        'debug'        => false,
        'port'         => 5432,
    ];

    public array $production = [
        'DSN'          => '',
        'hostname'     => '192.168.2.40',
        'username'     => 'postgres',
        'password'     => 'OneP@ssw0rd4All!',
        'database'     => 'dive-buddy',
        'DBDriver'     => 'Postgre',
        'DBPrefix'     => '',
        'pConnect'     => false,
        'DBDebug'      => false,
        'charset'      => 'UTF8',
        'DBCollat'     => '',
        'swapPre'      => false,
        'encrypt'      => false,
        'debug'        => false,
        'port'         => 5432,
    ];
}
