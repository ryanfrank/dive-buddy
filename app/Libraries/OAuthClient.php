<?php

namespace App\Libraries;

use League\OAuth2\Client\Provider\Google;
use League\OAuth2\Client\Provider\Facebook;
use Config\Auth;

class OAuthClient
{
    protected array $config;

    public function __construct()
    {
        $this->config = config('Auth');
    }

    public function getProvider(string $provider)
    {
        $providers = $this->config->oauthProviders;
        if (!isset($providers[$provider])) {
            throw new \InvalidArgumentException("Unknown OAuth provider: {$provider}");
        }
        $p = $providers[$provider];

        return match ($provider) {
            'google' => new Google([
                'clientId'     => $p['clientId'],
                'clientSecret' => $p['clientSecret'],
                'redirectUri'  => $p['redirectUri'],
            ]),
            'facebook' => new Facebook([
                'clientId'     => $p['clientId'],
                'clientSecret' => $p['clientSecret'],
                'redirectUri'  => $p['redirectUri'],
                'graphVersion' => 'v12.0',
            ]),
            default => throw new \InvalidArgumentException("Unsupported OAuth provider: {$provider}"),
        };
    }

    public function getAuthorizationUrl(string $provider): array
    {
        $oauth = $this->getProvider($provider);
        $url = $oauth->getAuthorizationUrl();
        $state = $oauth->getState();
        return ['url' => $url, 'state' => $state];
    }

    public function getUserDetails(string $provider, string $code): array
    {
        $oauth = $this->getProvider($provider);
        $token = $oauth->getAccessToken('authorization_code', ['code' => $code]);
        $resourceOwner = $oauth->getResourceOwner($token);

        return [
            'provider' => $provider,
            'oauth_id' => $resourceOwner->getId(),
            'email'    => $resourceOwner->getEmail(),
            'name'     => $resourceOwner->getName(),
            'avatar'   => $resourceOwner->getAvatarUrl() ?? null,
            'token'    => $token->getToken(),
        ];
    }
}
