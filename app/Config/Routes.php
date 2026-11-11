<?php

namespace Config;

use CodeIgniter\Config\Routing\RouteCollection;

/**
 * Dive Buddy - Route Configuration
 * Strict MVC: all requests routed to Controllers.
 */
$routes = services('routes');

/* --------------------------------------------------------------------------
   Public routes
   -------------------------------------------------------------------------- */
$routes->get('/', 'Home::index');
$routes->get('/home', 'Home::index');
$routes->get('/about', 'Home::about');
$routes->get('/dive-sites', 'DiveSite::index');
$routes->get('/dive-sites/(:segment)', 'DiveSite::view/$1');
$routes->get('/dives', 'Dive::index');
$routes->get('/dives/(:num)', 'Dive::view/$1');

/* --------------------------------------------------------------------------
   Authentication routes
   -------------------------------------------------------------------------- */
$routes->get('/login', 'Auth::login');
$routes->post('/login', 'Auth::authenticate');
$routes->get('/register', 'Auth::register');
$routes->post('/register', 'Auth::create');
$routes->get('/logout', 'Auth::logout');

// OAuth routes
$routes->get('/auth/oauth/(:segment)', 'Auth::oauth/$1');
$routes->get('/auth/oauth/(:segment)/callback', 'Auth::oauthCallback/$1');

// SAML routes
$routes->get('/auth/saml/login', 'Auth::samlLogin');
$routes->post('/auth/saml/acs', 'Auth::samlAcs');

/* --------------------------------------------------------------------------
   User routes (require login)
   -------------------------------------------------------------------------- */
$routes->get('/user/profile', 'User::profile');
$routes->get('/user/profile/edit', 'User::edit');
$routes->post('/user/profile/update', 'User::update');
$routes->get('/user/dives', 'User::dives');
$routes->get('/user/partners', 'DivePartner::index');
$routes->post('/user/partners/connect/(:num)', 'DivePartner::connect/$1');

/* --------------------------------------------------------------------------
   Dive routes (require login)
   -------------------------------------------------------------------------- */
$routes->get('/dives/log', 'Dive::create');
$routes->post('/dives/log', 'Dive::store');
$routes->get('/dives/(:num)/edit', 'Dive::edit/$1');
$routes->post('/dives/(:num)/update', 'Dive::update/$1');
$routes->post('/dives/(:num)/delete', 'Dive::delete/$1');

/* --------------------------------------------------------------------------
   Dive partner rating routes (require login)
   -------------------------------------------------------------------------- */
$routes->get('/rating/create/(:num)', 'Rating::create/$1');
$routes->post('/rating/store', 'Rating::store');
$routes->get('/rating/(:num)', 'Rating::view/$1');

/* --------------------------------------------------------------------------
   Administration routes (require login + admin)
   -------------------------------------------------------------------------- */
$routes->get('/admin', 'Admin::dashboard');
$routes->get('/admin/users', 'Admin::users');
$routes->get('/admin/users/(:num)/toggle-admin', 'Admin::toggleAdmin/$1');
$routes->get('/admin/sites', 'Admin::sites');
$routes->get('/admin/sites/add', 'Admin::addSite');
$routes->post('/admin/sites/store', 'Admin::storeSite');
$routes->get('/admin/config', 'Admin::config');
$routes->post('/admin/config/update', 'Admin::updateConfig');
