<?php

namespace App\Controllers;

use App\Libraries\OAuthClient;
use App\Libraries\SAMLClient;
use App\Models\UserModel;
use Config\Auth;

class Auth extends BaseController
{
    protected $userModel;
    protected $oauth;
    protected $saml;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->oauth = new OAuthClient();
        $this->saml = new SAMLClient();
    }

    public function login()
    {
        if (session()->get('is_logged_in')) {
            return redirect()->to('/user/profile');
        }
        $authConfig = config(Auth::class);
        return view('auth/login', [
            'title' => lang('Auth.login'),
            'oauthProviders' => array_keys($authConfig->oauthProviders),
            'samlEnabled' => $this->saml->isEnabled(),
        ]);
    }

    public function authenticate()
    {
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $user = $this->userModel->findByEmail($email);
        if (!$user || !password_verify($password, $user['password'])) {
            return redirect()->back()->with('error', lang('Auth.invalid_credentials'))->withInput();
        }

        if (!$user['is_active']) {
            return redirect()->back()->with('error', lang('Auth.account_disabled'))->withInput();
        }

        $this->createSession($user);
        return redirect()->to('/user/profile')->with('success', lang('Auth.login_success'));
    }

    public function register()
    {
        if (session()->get('is_logged_in')) {
            return redirect()->to('/user/profile');
        }
        return view('auth/register', ['title' => lang('Auth.register')]);
    }

    public function create()
    {
        $rules = [
            'email'    => 'required|valid_email|is_unique[users.email]',
            'password' => 'required|min_length[8]',
            'name'     => 'required|min_length[2]|max_length[100]',
        ];
        if (!$this->validate($rules)) {
            return redirect()->back()->with('errors', $this->validator->getErrors())->withInput();
        }

        $data = [
            'email' => $this->request->getPost('email'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'name' => $this->request->getPost('name'),
            'location' => $this->request->getPost('location'),
            'certification_level' => $this->request->getPost('certification_level'),
            'bio' => $this->request->getPost('bio'),
            'is_admin' => false,
        ];

        $this->userModel->save($data);
        $user = $this->userModel->findByEmail($data['email']);
        $this->createSession($user);

        return redirect()->to('/user/profile')->with('success', lang('Auth.register_success'));
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/')->with('success', lang('Auth.logout_success'));
    }

    public function oauth(string $provider)
    {
        try {
            $result = $this->oauth->getAuthorizationUrl($provider);
            session()->set('oauth_state', $result['state']);
            session()->set('oauth_provider', $provider);
            return redirect()->to($result['url']);
        } catch (\Exception $e) {
            return redirect()->to('/login')->with('error', lang('Auth.oauth_error', ['provider' => $provider]));
        }
    }

    public function oauthCallback(string $provider)
    {
        $state = $this->request->getGet('state');
        $code = $this->request->getGet('code');
        $savedState = session()->get('oauth_state');
        $savedProvider = session()->get('oauth_provider');

        if ($state !== $savedState || $provider !== $savedProvider) {
            return redirect()->to('/login')->with('error', lang('Auth.oauth_state_mismatch'));
        }

        try {
            $details = $this->oauth->getUserDetails($provider, $code);
            $user = $this->userModel->findByOAuth($details['provider'], $details['oauth_id']);

            if (!$user) {
                $user = $this->userModel->findByEmail($details['email']);
                if (!$user) {
                    $newUser = [
                        'email' => $details['email'],
                        'name' => $details['name'],
                        'oauth_provider' => $details['provider'],
                        'oauth_id' => $details['oauth_id'],
                        'email_verified' => true,
                        'is_admin' => false,
                    ];
                    $this->userModel->save($newUser);
                    $user = $this->userModel->findByEmail($details['email']);
                } else {
                    $this->userModel->update($user['id'], [
                        'oauth_provider' => $details['provider'],
                        'oauth_id' => $details['oauth_id'],
                        'email_verified' => true,
                    ]);
                    $user = $this->userModel->findByEmail($details['email']);
                }
            }

            $this->createSession($user);
            session()->remove('oauth_state');
            session()->remove('oauth_provider');

            return redirect()->to('/user/profile')->with('success', lang('Auth.login_success'));
        } catch (\Exception $e) {
            return redirect()->to('/login')->with('error', lang('Auth.oauth_failed'));
        }
    }

    public function samlLogin()
    {
        if (!$this->saml->isEnabled()) {
            return redirect()->to('/login')->with('error', lang('Auth.saml_disabled'));
        }
        $auth = $this->saml->getAuth();
        if (!$auth) {
            return redirect()->to('/login')->with('error', lang('Auth.saml_error'));
        }
        return redirect()->to($auth->login());
    }

    public function samlAcs()
    {
        if (!$this->saml->isEnabled()) {
            return redirect()->to('/login');
        }
        $auth = $this->saml->getAuth();
        $auth->processResponse();
        $errors = $auth->getErrors();
        if (!empty($errors)) {
            return redirect()->to('/login')->with('error', lang('Auth.saml_failed'));
        }
        if (!$auth->isAuthenticated()) {
            return redirect()->to('/login')->with('error', lang('Auth.saml_not_authenticated'));
        }

        $attributes = $auth->getAttributes();
        $email = $attributes['email'][0] ?? $attributes['uid'][0] ?? '';
        $name = $attributes['name'][0] ?? $email;

        $user = $this->userModel->findByEmail($email);
        if (!$user) {
            $this->userModel->save([
                'email' => $email,
                'name' => $name,
                'oauth_provider' => 'saml',
                'oauth_id' => $attributes['uid'][0] ?? $email,
                'email_verified' => true,
                'is_admin' => false,
            ]);
            $user = $this->userModel->findByEmail($email);
        }

        $this->createSession($user);
        return redirect()->to('/user/profile')->with('success', lang('Auth.login_success'));
    }

    protected function createSession(array $user): void
    {
        $session = session();
        $session->set([
            'is_logged_in' => true,
            'user_id' => $user['id'],
            'user_email' => $user['email'],
            'user_name' => $user['name'],
            'is_admin' => (bool) $user['is_admin'],
        ]);
    }
}
