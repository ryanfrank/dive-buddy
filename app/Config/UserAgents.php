<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class UserAgents extends BaseConfig
{
    /**
     * --------------------------------------------------------------------------
     * User agent platforms
     * --------------------------------------------------------------------------
     * List of platforms to check for. Each platform is an array with the
     * following structure:
     *
     *   'platformName' => '/regexPattern/'
     *
     * @var array<string, string>
     */
    public array $platforms = [
        'windows'     => '/windows/i',
        'macintosh'   => '/macintosh|mac os x/i',
        'linux'       => '/linux/i',
        'ubuntu'      => '/ubuntu/i',
        'iphone'      => '/iphone/i',
        'ipod'        => '/ipod/i',
        'ipad'        => '/ipad/i',
        'android'     => '/android/i',
        'blackberry'  => '/blackberry/i',
        'opera'       => '/Opera/i',
    ];

    /**
     * --------------------------------------------------------------------------
     * User agent browsers
     * --------------------------------------------------------------------------
     *
     * @var array<string, string>
     */
    public array $browsers = [
        'chrome'      => '/Chrome/i',
        'safari'      => '/Safari/i',
        'firefox'     => '/Firefox/i',
        'msie'        => '/MSIE/i',
        'opera'       => '/Opera/i',
        'netscape'    => '/Netscape/i',
    ];

    /**
     * --------------------------------------------------------------------------
     * User agent mobiles
     * --------------------------------------------------------------------------
     *
     * @var array<string, string>
     */
    public array $mobiles = [
        'mobile'      => '/Mobile/i',
        'android'     => '/Android/i',
        'iphone'      => '/iPhone/i',
        'ipod'        => '/iPod/i',
        'ipad'        => '/iPad/i',
    ];

    /**
     * --------------------------------------------------------------------------
     * User agent robots
     * --------------------------------------------------------------------------
     *
     * @var array<string, string>
     */
    public array $robots = [
        'googlebot'   => '/Googlebot/i',
        'bingbot'     => '/bingbot/i',
        'slurp'       => '/Slurp/i',
        'duckduckbot' => '/DuckDuckBot/i',
        'baiduspider' => '/Baiduspider/i',
        'yandexbot'   => '/YandexBot/i',
        'aolbuild'    => '/AOLBuild/i',
    ];
}
