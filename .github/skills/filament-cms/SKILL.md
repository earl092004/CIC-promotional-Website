---
name: filament-cms
description: "Use when building or maintaining the private Filament 5 CMS for CIC: panels, resources, forms, tables, media uploads, Administrator and Contributor permissions, article review workflows, announcements, or expiration. Verify installed packages and official Filament/Laravel docs before using version-specific APIs; do not assume Filament is installed."
---

# Filament CMS

## Installation and version preflight

1. Inspect `composer.json`, `composer.lock`, `vendor/composer/installed.php`, and `php -m` before importing Filament classes.
2. Use the separate PHP 8.4 executable documented by the project. Preserve XAMPP PHP 8.2 and all SQLite data.
3. If Filament is absent, do not pretend it is available. Before any requested installation, inspect `C:\tools\php84\php.ini` and `C:\tools\php84\ext\php_intl.dll`; enable the matching `intl` extension only if it is present, verify `C:\tools\php84\php.exe -m`, and stop with an explicit blocker if it cannot be enabled.
4. After installation is explicitly approved, verify the resolved Filament 5 and Laravel versions, then read the matching [Filament documentation](https://filamentphp.com/docs/5.x), [Filament upgrade guide](https://filamentphp.com/docs/5.x/upgrade), and [Laravel authorization documentation](https://laravel.com/docs/13.x/authorization). Never bypass platform requirements.

## CMS procedure

1. Configure one private panel with no public registration. Only authorized Administrators can create or invite CMS users.
2. Define Administrator and Contributor abilities in policies and/or the project's established permission mechanism. Test every create, view, update, submit, publish, archive, media, and user-management action.
3. Implement article states explicitly: `Draft -> Submitted -> Changes Requested or Published -> Archived/Unpublished`. Record the reviewer and meaningful transition timestamps where the schema supports it.
4. Scope Contributor queries and mutations to their own drafts and revision-requested articles. Contributors may submit and upload allowed media, but cannot publish, approve, manage users, or edit another contributor's drafts.
5. Give Administrators review controls, category/content management, publication controls, featured-announcement dates, and protected media management.
6. Validate uploads by MIME/content, extension, size, dimensions where relevant, and storage disk. Generate safe names, store through Laravel's filesystem, and prevent executable uploads. Keep alt text and captions required where the UI needs them.
7. Query active featured announcements with server-side date comparisons. On expiration, remove the item from active featured/listing queries while preserving its article/history and its page unless separately unpublished or archived.
8. Use Filament validation and notifications for recoverable form errors; do not rely on hidden actions as security.

## Verification checklist

- [ ] Filament is actually installed and its exact version was inspected before API use.
- [ ] PHP 8.4 `intl` was resolved before installation; XAMPP PHP and project data were preserved.
- [ ] No public registration exists.
- [ ] Administrator and Contributor server-side authorization is tested.
- [ ] Article workflow transitions reject unauthorized or invalid transitions.
- [ ] Upload validation, storage, filenames, authorization, alt text, and non-executable handling are tested.
- [ ] Expired announcements disappear from active displays without destructive deletion.
- [ ] Relevant Filament resources load and targeted tests pass.
