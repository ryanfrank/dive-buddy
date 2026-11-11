<?php

namespace App\Libraries;

use League\OAuth2\Client\Provider\GenericProvider;
use Config\Auth;

class OAuthClient
{
    protected $config;

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

        return new GenericProvider([
            'clientId'                => $p['clientId'],
            'clientSecret'            => $p['clientSecret'],
            'redirectUri'             => $p['redirectUri'],
            'urlAuthorize'            => $p['urlAuthorize'],
            'urlAccessToken'          => $p['urlToken'],
            'urlResourceOwnerDetails' => $p['urlResource'] ?? '',
            'scope'                   => $p['scope'] ?? [],
        ]);
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

        if ($provider === 'apple') {
            return $this->getAppleUserDetails($token);
        }

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

    /**
     * Apple does not provide a standard userinfo endpoint. On first authorization,
     * the user's email and name are returned in the id_token JWT. On subsequent
     * authorizations only the sub (user ID) is available.
     */
    protected function getAppleUserDetails($token): array
    {
        $values = $token->getValues();
        $idToken = $values['id_token'] ?? null;

        $payload = $this->decodeJwtPayload($idToken ?? '');

        $oauthId = $payload['sub'] ?? $values['user_id'] ?? '';
        $email   = $payload['email'] ?? '';
        $name    = $payload['name'] ?? '';

        if (empty($name) && !empty($email)) {
            $name = explode('@', $email)[0];
        }

        return [
            'provider' => 'apple',
            'oauth_id' => $oauthId,
            'email'    => $email,
            'name'     => $name,
            'avatar'   => null,
            'token'    => $token->getToken(),
        ];
    }

    protected function decodeJwtPayload(string $jwt): array
    {
        if (empty($jwt)) {
            return [];
        }
        $parts = explode('.', $jwt);
        if (count($parts) < 2) {
            return [];
        }
        $payload = $parts[1];
        $payload = str_pad($payload, strlen($payload) + (4 - strlen($payload) % 4) % 4, '=');
        $decoded = base64_decode(strtr($payload, '-_', '+/'));
        return $decoded ? json_decode($decoded, true) : [];
    }
}
