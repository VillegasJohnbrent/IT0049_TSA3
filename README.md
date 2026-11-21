# Tasks for Today

IT0049 — Technical Summative Assessment 3. A Laravel application for viewing daily tasks, the full task list, and a user profile.

## Requirements

PHP 8.2+, Composer 2, and SQLite. Enable `pdo_sqlite`, `mbstring`, `openssl`, `fileinfo`, `dom`, `xml`, and `xmlwriter` in php.ini.

## Setup

On Windows, run `INSTALL-WINDOWS.bat`, then `START-WINDOWS.bat`.

For manual setup, run these commands from the project folder:

```sh
composer install
php artisan config:clear
php scripts/prepare.php
php artisan migrate --seed
php artisan serve
```

Open http://localhost:8000.

Set `DEVELOPER_NAME` and `DEVELOPER_SECTION` in `.env`, then run `php artisan config:clear`.

## Pages

- `/` — Tasks scheduled for today.
- `/tasks` — All tasks, ordered by date.
- `/profile` — User details.
- `/about` — Project and developer information.

## Database

Migrations and the seeder are in `database/`. Initial seeding creates nine tasks across yesterday, today, and tomorrow, plus one user. Dates use Philippine time. Stored dates remain unchanged when the seeder runs again.

SQLite is the default. To use MySQL, create an empty database, set `DB_CONNECTION=mysql`, and configure the `DB_*` values in `.env`. Run `php artisan config:clear` and `php artisan migrate --seed`.

## Tests

```sh
php artisan test
```

Tests use a separate in-memory SQLite database.

## Deployment

Install dependencies with `composer install --no-dev --optimize-autoloader`. Configure `.env`, set `APP_ENV=production`, `APP_DEBUG=false`, and `APP_URL` to the hosted address. Generate an application key on first setup and run `php artisan migrate --seed --force`.

Set the web root to `public/` and allow writes to `storage/` and `bootstrap/cache/`. SQLite requires persistent storage.

Commit `composer.lock` after installation. Exclude `.env`, `vendor/`, and local database files from Git.
