<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class Auth extends BaseConfig
{
    // OAuth 2.0 providers (Google, Facebook, etc.)
    public array $oauthProviders = [
        'google' => [
            'clientId'     => getenv('oauth.google.client_id') ?: '',
            'clientSecret' => getenv('oauth.google.client_secret') ?: '',
            'redirectUri'  => getenv('oauth.google.redirect_uri') ?: '',
            'urlAuthorize' => 'https://accounts.google.com/o/oauth2/v2/auth',
            'urlToken'     => 'https://oauth2.googleapis.com/token',
            'urlResource'  => 'https://www.googleapis.com/oauth2/v2/userinfo',
            'scope'        => ['email', 'profile'],
        ],
        'facebook' => [
            'clientId'     => getenv('oauth.facebook.client_id') ?: '',
            'clientSecret' => getenv('oauth.facebook.client_secret') ?: '',
            'redirectUri'  => getenv('oauth.facebook.redirect_uri') ?: '',
            'urlAuthorize' => 'https://www.facebook.com/v12.0/dialog/oauth',
            'urlToken'     => 'https://graph.facebook.com/v12.0/oauth/access_token',
            'urlResource'  => 'https://graph.facebook.com/me?fields=id,email,name',
            'scope'        => ['email', 'public_profile'],
        ],
    ];

    // SAML 2.0 SSO (enterprise)
    public bool $samlEnabled = filter_var(getenv('saml.enabled'), FILTER_VALIDATE_BOOLEAN);
    public array $saml = [
        'idp' => [
            'entityId' => getenv('saml.idp.entity_id') ?: '',
            'ssoUrl'   => getenv('saml.idp.sso_url') ?: '',
            'x509cert' => getenv('saml.idp.x509_cert') ?: '',
        ],
        'sp' => [
            'entityId'    => getenv('saml.sp.entity_id') ?: '',
            'privateKey'  => getenv('saml.sp.private_key') ?: '',
            'x509cert'    => getenv('saml.sp.certificate') ?: '',
        ],
    ];

    public string $loginRoute = '/login';
    public string $logoutRoute = '/logout';
    public string $afterLoginRoute = '/user/profile';
}
