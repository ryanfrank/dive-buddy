<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class App extends BaseConfig
{
    public string $siteName = 'Dive Buddy';
    public string $siteEmail = 'admin@divebuddy.com';
    public string $siteDescription = 'Connect with divers worldwide. Log dives, find partners, rate experiences.';
    public string $baseURL = 'http://localhost:8080/';
    public string $uriProtocol = 'REQUEST_URI';
    public string $indexPage = '';
    public string $permittedURIChars = 'a-z 0-9~%.:_\\-';
    public array $supportedLocales = ['en', 'es', 'fr', 'de'];
    public string $defaultLocale = 'en';
    public bool $negotiateLocale = true;
    public bool $strictLocaleNegotiation = false;
    public array $allowedHostnames = [];
    public string $charset = 'UTF-8';
    public bool $forceGlobalSecureRequests = false;
    public bool $CSPEnabled = false;
    public string $appTimezone = 'UTC';

    public string $sessionDriver = 'CodeIgniter\\Session\\Handlers\\DatabaseHandler';
    public string $sessionCookieName = 'dive_buddy_session';
    public int $sessionExpiration = 7200;
    public string $sessionSavePath = 'ci_sessions';
    public bool $sessionMatchIP = false;
    public int $sessionTimeToUpdate = 300;
    public bool $sessionRegenerateDestroy = false;

    public string $cookiePrefix = '';
    public string $cookieDomain = '';
    public string $cookiePath = '/';
    public bool $cookieSecure = false;
    public bool $cookieHTTPOnly = true;
    public string $cookieSameSite = 'Lax';

    public bool $csrfProtection = true;
    public string $csrfTokenName = 'csrf_token_name';
    public string $csrfCookieName = 'csrf_cookie_name';
    public int $csrfExpire = 7200;
    public bool $csrfRegenerate = true;
    public bool $csrfRedirect = true;
    public string $csrfSameSite = 'Lax';
    public bool $strictCSRF = false;

    public string $defaultTimezone = 'UTC';

    public array $proxyIPs = [];
}
