<?php

namespace Config;

use CodeIgniter\Config\Config;

class Languages extends Config
{
    public array $supported = ['en', 'es', 'fr', 'de'];
    public string $default = 'en';
    public bool $negotiate = true;
}
