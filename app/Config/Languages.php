<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class Languages extends BaseConfig
{
    public array $supported = ['en', 'es', 'fr', 'de'];
    public string $default = 'en';
    public bool $negotiate = true;
}
