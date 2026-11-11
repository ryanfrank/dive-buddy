<?php

namespace App\Libraries;

use OneLogin\Saml2\Auth;
use OneLogin\Saml2\Settings;

class SAMLClient
{
    protected $config;

    public function __construct()
    {
        $this->config = config('Auth');
    }

    public function isEnabled(): bool
    {
        return (bool) $this->config->samlEnabled;
    }

    public function getSettings(): array
    {
        $s = $this->config->saml;
        return [
            'idp' => [
                'entityId' => $s['idp']['entityId'],
                'singleSignOnService' => [
                    'url' => $s['idp']['ssoUrl'],
                ],
                'x509cert' => $s['idp']['x509cert'],
            ],
            'sp' => [
                'entityId' => $s['sp']['entityId'],
                'privateKey' => $s['sp']['privateKey'],
                'x509cert' => $s['sp']['x509cert'],
            ],
        ];
    }

    public function getAuth(): ?Auth
    {
        if (!$this->isEnabled()) {
            return null;
        }
        $settings = new Settings($this->getSettings(), true);
        return new Auth($settings);
    }
}
