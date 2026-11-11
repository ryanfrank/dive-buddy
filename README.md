# Dive Buddy

Dive Buddy is a web-based platform that connects divers worldwide. Users can find and coordinate with other divers when traveling, log their dives at specific sites, document experiences, and rate their dive partners.

Built with **CodeIgniter 4** (strict MVC), **PostgreSQL**, with OAuth/SAML authentication, multi-language support, and a professional administration panel.

## Features

- **User Authentication** – Register, login, and OAuth/SAML (Google, Facebook, SAML SSO)
- **User Profiles** – Manage dive profile, certification level, location, and bio
- **Dive Logging** – Log dives with site, date, depth, bottom time, conditions, and notes
- **Dive Sites** – Browse and search dive sites worldwide with ratings
- **Dive Coordination** – Connect with other divers planning to be at a location
- **Partner Ratings** – Rate dive partners after a dive (1–5 stars)
- **Administration Panel** – Manage users, dive sites, and site configuration
- **Multi-language** – English, Spanish, French, German (extensible)
- **Professional UI** – Responsive, modern design

## Requirements

- PHP 7.4 or 8.0+
- Composer
- PostgreSQL 12+
- CodeIgniter 4.4+

## Installation

```bash
# Clone the repository
git clone https://github.com/ryanfrank/dive-buddy.git
cd dive-buddy

# Install dependencies
composer install

# Copy environment config
cp .env.example .env
# Edit .env with your database credentials

# Start PostgreSQL (or use docker-compose)
docker-compose up -d

# Run the application (CodeIgniter built-in server)
php spark serve

# Or visit http://localhost:8080
```

## Database Schema

Run migrations or import `database/schema.sql` to initialize the PostgreSQL database.

## Project Structure

```
app/
  Config/         – App, Database, Routes, Filters, Auth configuration
  Controllers/    – MVC controllers (Home, Auth, User, Dive, Admin, …)
  Models/         – Data models (User, Dive, DiveSite, Rating, …)
  Views/          – HTML views (layout, home, auth, user, dive, admin)
  Language/       – Multi-language strings (en, es, fr, de)
  Filters/        – Auth and Admin route filters
public/           – Web root (index.php, CSS, JS, images)
database/         – Migrations and seeds
tests/            – PHPUnit tests
```

## Authentication

Dive Buddy supports:
- Traditional email/password authentication
- OAuth 2.0 (Google, Facebook)
- SAML 2.0 SSO (enterprise)

See `app/Config/Auth.php` to configure providers.

## Admin Panel

Access at `/admin`. The first registered user can be promoted to admin via the `site_configs` table or by setting `is_admin = true` in the `users` table.

## Mobile Apps (Optional)

Native iOS and Android applications are planned as optional extensions that consume the same API backend.

## License

MIT License
