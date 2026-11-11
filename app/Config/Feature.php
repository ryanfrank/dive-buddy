<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class Feature extends BaseConfig
{
    /**
     * --------------------------------------------------------------------------
     * Strict Locale Negotiation
     * --------------------------------------------------------------------------
     *
     * If true, then strict locale negotiation is used when determining
     * the best language to serve to the user. If false, then the
     * first, highest-ranking client requested language is returned.
     *
     * @var bool
     */
    public bool $strictLocaleNegotiation = false;
}
