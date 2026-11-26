---
name: laravel-development
description: "Use when developing this CIC Laravel 13 application with PHP 8.4, Blade, SQLite, Eloquent, migrations, routes, authentication, policies, tests, or Artisan. Inspect installed versions and official Laravel/PHP documentation before using version-specific APIs."
---

# Laravel Development

## Project guardrails

- Treat `CIC-web-Agent.md`, `AGENTS.md`, `composer.json`, `composer.lock`, and `.env` as the source of truth.
- Preserve the existing XAMPP PHP 8.2 installation and SQLite data. Use `C:\tools\php84\php.exe` for Composer and Artisan when it exists; never change global `PATH`.
- Do not run `migrate:fresh`, `db:wipe`, destructive resets, or commands against production.
- Prefer Laravel and PHP APIs already supported by the installed versions. Avoid adding packages unless the task explicitly requires one.

## Required preflight

1. Run `C:\tools\php84\php.exe -v`, `C:\tools\php84\php.exe -m`, and `composer show --direct` (with the project PHP executable as needed).
2. Read the relevant official documentation before version-specific work:
   - [Laravel 13 documentation](https://laravel.com/docs/13.x)
   - [PHP 8.4 manual](https://www.php.net/manual/en/)
   - [Laravel upgrade guide](https://laravel.com/docs/13.x/upgrade)
3. Confirm `laravel/framework` and PHP constraints from `composer.json` and resolved versions from `composer.lock`; do not infer them from memory.
4. If Filament installation is requested, stop first when PHP 8.4 lacks `intl`. Inspect `C:\tools\php84\php.ini` and the matching `ext\php_intl.dll`, enable only the correct extension, then verify `intl` with `php -m`. Do not use `--ignore-platform-reqs`. Do not modify XAMPP PHP.
5. Inspect routes, models, migrations, policies, and tests before editing. Use additive migrations and preserve existing rows.

## Implementation procedure

1. Model domain behavior first: use Eloquent relationships, casts, scopes, policies, and form requests rather than duplicating rules in controllers or views.
2. Enforce Administrator and Contributor permissions server-side with policies and authorization checks; UI visibility is not authorization.
3. Keep public content queries explicit. For announcements, apply publication/status and expiration predicates in the query, not only in Blade.
4. Use Blade escaping by default. Sanitize any intentionally rendered rich text with the project-approved approach.
5. Use Laravel storage abstractions and validated paths for media. Never build paths from untrusted input.
6. Add focused feature tests for authorization, article state transitions, expiration boundaries, uploads, and public responses. Use the configured SQLite test database and isolate test data.
7. Run the smallest relevant checks, then `C:\tools\php84\php.exe artisan test` and `vendor\bin\pint --test` when applicable. Report actual failures.

## Verification checklist

- [ ] Installed PHP, Laravel, and package versions were inspected.
- [ ] Relevant official documentation was consulted.
- [ ] Existing SQLite data and XAMPP PHP were left untouched.
- [ ] Authorization is tested on the server.
- [ ] Migrations are additive and reversible where practical.
- [ ] Validation, escaping, CSRF protection, and error handling are explicit.
- [ ] Targeted tests and formatting checks pass, or blockers are documented.
