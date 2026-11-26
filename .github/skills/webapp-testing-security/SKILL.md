---
name: webapp-testing-security
description: "Use when testing or security-checking this Laravel 13 and Blade/Tailwind web app, including browser flows, CMS authorization, article submission/review, announcement expiration, secure image uploads, forms, routes, and SQLite behavior. Inspect installed versions and official documentation before version-specific tooling or APIs."
---

# Web App Testing and Security

## Test preflight

1. Inspect `composer.json`, `composer.lock`, `package.json`, test configuration, routes, policies, and the installed PHP/modules. Read the relevant official Laravel 13, PHP 8.4, Tailwind/Vite, and installed Filament documentation before relying on version-specific behavior.
2. Use the project's PHP 8.4 executable for Composer/Artisan. Do not alter XAMPP PHP 8.2, reset SQLite, expose `.env`, or install unknown packages.
3. Check whether Filament is installed before writing CMS tests. If installation is needed, resolve and verify `intl` first; never use ignored platform requirements.

## Verification procedure

1. Run focused PHPUnit feature tests for:
   - Administrator versus Contributor access to every CMS mutation.
   - Contributor ownership, draft/revision rules, and valid article transitions.
   - Publication, unpublication, archive, and reviewer behavior.
   - Announcement expiration at before, exactly-at, and after-expiration boundaries.
   - Upload MIME/type/size/path validation and authorization.
   - Public route status, escaping, CSRF-protected forms, and missing/expired content.
2. Run static and baseline checks used by the repository, such as `vendor\bin\pint --test`, `C:\tools\php84\php.exe artisan test`, and `npm run build`.
3. If browser tooling is available, exercise the public navigation and private CMS with separate users. Check responsive widths, keyboard focus, validation errors, console errors, redirects, and unauthorized responses.
4. Review changes for mass assignment, IDOR, missing policies, unsafe rich text, path traversal, upload execution, unvalidated redirects, secret leakage, insecure debug/configuration, and data-destructive migrations.
5. Prefer assertions on authorization and output behavior over implementation details. Use temporary test files and clean them through the test framework.

## Security acceptance checklist

- [ ] Authentication and private panel routes are protected; no public registration is exposed.
- [ ] Every state-changing endpoint validates input, CSRF, authorization, and ownership.
- [ ] User text is escaped; intentional rich text is sanitized.
- [ ] Uploads are validated by content/type/size, stored outside executable paths, and served safely.
- [ ] Expiration is enforced server-side and uses an unambiguous timezone/date policy.
- [ ] SQLite tests preserve the real local database and never use destructive production commands.
- [ ] Secrets, logs, and personal data are not included in output or commits.
- [ ] Failures are reported with the failing command, test, route, and likely cause; no silent fallbacks.
