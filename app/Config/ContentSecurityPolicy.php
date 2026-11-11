<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class ContentSecurityPolicy extends BaseConfig
{
    /**
     * --------------------------------------------------------------------------
     * Content Security Policy defaults
     * --------------------------------------------------------------------------
     *
     * These are the default values that will be used if no other
     * value is provided.
     *
     * @var array<string, string>
     */
    protected array $default = [
        'default-src'  => ['self'],
        'script-src'   => ['self'],
        'style-src'    => ['self'],
        'img-src'      => ['self'],
        'font-src'     => ['self'],
        'connect-src'  => ['self'],
        'frame-src'    => ['self'],
        'frame-ancestors' => ['self'],
    ];

    /**
     * --------------------------------------------------------------------------
     * Content Security Policy
     * --------------------------------------------------------------------------
     *
     * These are the values that will be used for the Content-Security-Policy
     * header. You can add as many directives as you need, and they will be
     * merged with the defaults.
     *
     * @var array<string, string>
     */
    public array $policy = [];

    /**
     * --------------------------------------------------------------------------
     * Report Only
     * --------------------------------------------------------------------------
     *
     * If true, the policy will be sent as Content-Security-Policy-Report-Only
     * instead of Content-Security-Policy.
     *
     * @var bool
     */
    public bool $reportOnly = false;

    /**
     * --------------------------------------------------------------------------
     * Report URI
     * --------------------------------------------------------------------------
     *
     * The URI to send violation reports to.
     *
     * @var string|null
     */
    public ?string $reportURI = null;
}
