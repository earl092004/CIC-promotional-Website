    # CIC Promotional Website — Autonomous Coding Agent Instructions

## 1. Your Mission

Continue developing the **City of Ilagan College (CIC) Promotional Website** in the existing Laravel project. Work directly in the project files, implement the required features, test your changes, and fix errors where possible.

**Project directory:** `C:\xampp\htdocs\cic-promotional-website`

Do not merely explain how to build the website. Your job is to inspect the existing project and implement it.

Work autonomously on routine coding decisions. Ask me only when you need credentials, official information that is unavailable, approval for destructive actions, or a decision that could significantly change the project's scope.

## 2. Existing Development Environment

- Windows
- XAMPP installed
- Existing XAMPP PHP: 8.2.12 at `C:\xampp\php\php.exe`
- Separate PHP 8.4.26: `C:\tools\php84\php.exe`
- Composer PHAR: `C:\ProgramData\ComposerSetup\bin\composer.phar`
- Composer 2.10.3
- Node.js v24.14.0
- npm 11.9.0
- Laravel application installed successfully in the project directory
- Laravel Framework v13.36.0
- Laravel application skeleton v13.11.0
- The local development server was started in another terminal using `C:\tools\php84\php.exe artisan serve`.
- Local address: `http://127.0.0.1:8000`
- The application initially uses SQLite.

### Current blocker

The initial Filament 5 installation failed because PHP 8.4's CLI configuration did not have the `intl` extension enabled. This was resolved by enabling the existing `C:\tools\php84\ext\php_intl.dll`; verify `php -m` and the current `composer.json`/`composer.lock` before future package work.

The project dependencies now require PHP `>= 8.4.1`. XAMPP's PHP 8.2.12 must remain installed and unchanged, but it cannot execute this application's Composer autoloader. Do not run the application, Artisan, Composer, or Pint through `C:\xampp\php\php.exe`. Use `C:\tools\php84\php.exe` explicitly instead.

Start the local application with:

`C:\tools\php84\php.exe artisan serve --host=127.0.0.1 --port=8000`

Then browse to `http://127.0.0.1:8000`. If a browser or terminal is showing the `platform_check.php` fatal error with PHP 8.2.12, it is using the XAMPP PHP runtime; stop that process or point the project workflow to the PHP 8.4 command above. Never edit `vendor\composer\platform_check.php` or use `--ignore-platform-reqs` as a workaround.

First inspect:

`C:\tools\php84\php.ini`

Find `;extension=intl` and enable it by removing the leading semicolon, if the corresponding extension is available. If the line is absent or `C:\tools\php84\ext\php_intl.dll` is missing, investigate the correct fix for this PHP installation.

Verify the extension with:

`C:\tools\php84\php.exe -m`

Confirm that `intl` appears before retrying the Filament installation.

Then install a Laravel-compatible Filament 5 version using the project's PHP and Composer:

`C:\tools\php84\php.exe C:\ProgramData\ComposerSetup\bin\composer.phar require "filament/filament:^5.0" -W`

Do not bypass missing PHP requirements with `--ignore-platform-reqs` or `--ignore-platform-req=ext-intl`.

**Important:** Do not modify XAMPP's PHP installation, global PATH, or unrelated projects. Do not stop the existing development server unless necessary.

## 3. Working Rules

1. Inspect the existing project before editing files.
2. Check `git status` if Git is initialized. Preserve existing user changes.
3. Make changes in small, logical increments.
4. Use the explicit PHP 8.4 executable for Composer and Artisan commands.
5. Verify package compatibility before installing dependencies.
6. Run relevant tests and build checks after making changes.
7. Fix errors instead of ignoring them.
8. Do not invent successful test results.
9. Never expose secrets or commit `.env` credentials.
10. Do not delete user files or reset databases.
11. Never run `migrate:fresh`, `db:wipe`, or destructive database commands without explicit authorization.
12. Keep the existing SQLite configuration unless there is a strong reason to request approval for a change.
13. If something is blocked, continue with other safe tasks where possible and document the blocker.
14. Do not stop after writing a plan. Implement as much of the application as safely possible.

## 4. Website Objective

Build a modern, youthful, responsive promotional website for **City of Ilagan College (CIC)**, with a private content management system for authorized staff.

CIC approval to use its name, branding, and supplied assets has already been confirmed. Check the project for available logos, institutional colors, and campus photos.

If official assets are unavailable, use a professional temporary design and clearly identify placeholder content. Do not fabricate official school information.

## 5. Required Public Pages

Implement these pages:

- Home
- About CIC
- Academic Programs
- Admissions
- News & Stories
- Article Detail
- Campus Gallery
- Contact & Location

Use consistent navigation, footer, typography, spacing, and responsive layouts.

The homepage must include:
- An attractive hero section
- A clear introduction to CIC
- Academic program highlights
- A separate featured announcements section
- Latest published articles
- Campus photos or gallery previews
- Clear navigation to admissions and contact information

Avoid displaying the same article twice in featured announcements and latest articles when practical.

## 6. Content Management Requirements

Build a private CMS using Filament 5 and Laravel.

### Roles

**Administrator**
- Manage users
- Manage categories
- Manage About and Admissions content
- Review submitted articles
- Request revisions
- Publish and unpublish articles
- Archive content
- Manage featured announcements and expiration dates
- Manage media and gallery content
- Manage relevant site settings

**Contributor**
- Create article drafts
- Edit their own drafts
- Upload images
- Submit articles for review
- Edit articles when revisions are requested

Contributors must not publish articles or edit another contributor's drafts.

Enforce these permissions on the server. Hiding buttons in the interface is not sufficient.

There must be **no public registration**. Only authorized administrators should be able to create or invite CMS users.

Do not implement student accounts or student login features.

## 7. Article Types and Workflow

Support these article types:

- Announcements
- News
- Blogs
- Event Stories
- Achievements

Implement the workflow:

`Draft → Submitted → Changes Requested or Published → Archived/Unpublished`

Use appropriate validation, authorization policies, and clear status indicators.

Public article pages should display the approved author name, optional organization, publication date, title, and content.

Support:
- Cover images
- Inline article images
- Image captions and alternative text
- Inline image galleries
- Optional closing images
- Article sharing or copying the article link

## 8. Featured Announcements

Featured announcements may have an expiration date.

When an announcement expires:
- Remove it from active featured-announcement displays.
- Exclude it from active announcement listings where appropriate.
- Preserve the article and its history in the database.
- Keep its article page available unless an administrator separately unpublishes or archives it.

Implement and test this behavior using server-side date comparisons.

## 9. About, Admissions, and Academic Programs

- About CIC must be editable by administrators.
- Admissions must be editable by administrators.
- Academic Programs should remain fixed in code for now.
- Do not create a CMS editor for Academic Programs unless existing project requirements make it necessary.

Do not invent course offerings, admission dates, tuition fees, requirements, official contact details, or other school facts.

Use clearly labeled sample content until verified official information is available.

## 10. Media and Campus Gallery

Implement secure media uploads and a campus gallery.

Requirements:
- Validate file types and sizes.
- Generate safe filenames.
- Store uploads using Laravel's storage system.
- Support captions and alt text.
- Prevent unauthorized users from uploading, changing, or deleting protected content.
- Avoid unsafe file paths and untrusted HTML.
- Provide an organized way to select and reuse existing media where practical.

Do not allow uploaded files to execute as server-side code.

## 11. Preferred Technology

Use:

- Laravel 13
- Blade templates
- Tailwind CSS compatible with the existing project
- Filament 5
- SQLite for local development
- Git if already initialized

Follow Laravel conventions. Keep code readable and avoid unnecessary packages.

Before choosing package versions, verify compatibility with the installed PHP and Laravel versions.

## 12. Security Requirements

Implement appropriate protections:

- Laravel validation
- CSRF protection
- Server-side authorization
- Secure CMS authentication
- No public registration
- Safe file upload validation
- Safe rendering and sanitization of rich-text content
- Escaped user-generated text by default
- Protected administrative routes
- Secure handling of configuration and credentials

Never render untrusted HTML without sanitization.

Do not add public comments, student enrollment, grades, attendance, student information system functionality, or unrelated modules.

## 13. Implementation Order

Work through these tasks in order, adjusting only when the actual project state requires it:

1. Inspect the repository and current application.
2. Fix and verify the PHP 8.4 `intl` extension.
3. Install Filament 5 successfully.
4. Configure the private admin panel and authentication.
5. Implement administrator and contributor roles with server-side permissions.
6. Create the shared public layout and responsive navigation.
7. Build the required public pages.
8. Implement database models and migrations for articles, categories, media, and editable pages as needed.
9. Implement the article workflow and administrator review process.
10. Implement featured-announcement expiration.
11. Build the Filament resources and forms with the correct role restrictions.
12. Implement secure media uploads and gallery management.
13. Add tests for authorization, article workflow, expiration, and public pages.
14. Run migrations safely against the configured local database.
15. Run automated tests and frontend build checks.
16. Check the application's routes and fix errors.
17. Inspect the rendered site in a browser if browser tools are available.
18. Write a README containing setup instructions, CMS roles, workflow, and backup guidance.

Do not claim a feature is finished unless it is implemented and appropriately verified.

## 14. Database and Migration Safety

Before running migrations, inspect `.env` and the database configuration.

- Preserve existing data.
- Prefer additive migrations.
- Never reset or wipe the database without permission.
- Do not switch from SQLite to MySQL without approval.
- Do not connect to production systems.
- Do not expose `.env` or application logs publicly.

## 15. Definition of Done

The prototype should have:

- A working Laravel application at `http://127.0.0.1:8000`
- Functional public navigation and all required pages
- A responsive and consistent design
- A private CMS with no public registration
- Administrator and Contributor roles
- Server-side authorization
- Working article submission and review workflow
- Working featured-announcement expiration
- Secure media uploads and campus gallery
- Clearly labeled placeholder content
- Successful relevant tests and frontend build checks, or documented blockers
- A useful README with local setup and backup guidance

If time or environment limitations prevent completion, finish the highest-priority safe tasks and clearly identify what remains.

## 16. Final Report

When finished, report:

1. **Completed:** Features actually implemented.
2. **Files changed:** Important files and their purpose.
3. **Commands run:** Commands and actual results.
4. **Tests:** Which tests passed or failed.
5. **Remaining issues:** Any incomplete requirements or blockers.
6. **Next action:** One clear step for me, if needed.

## 17. Current Development Progress

- Created four project Agent Skills under `.github/skills/`: Laravel development, frontend design, Filament CMS, and webapp testing/security.
- Replaced the default Laravel welcome screen with a responsive CIC promotional homepage.
- Added the supplied CIC logo at `public\images\cic-logo.png`.
- Added logo-derived theme colors in `resources\css\app.css`: royal blue, deep blue, cyan, green, red, and yellow.
- Changed the homepage navigation to a white header with a visible logo mark.
- Added accessible navigation hover/focus animation, CTA lift/shadow animation, logo mark motion, and reduced-motion support.
- Added reusable project-wide motion classes for interactive lifts, CTA effects, image zoom, focus-within states, and entrance reveals. Future pages should use these classes instead of inventing unrelated effects.
- Added and verified the homepage feature test, Blade compilation, Tailwind/Vite production build, and Pint formatting.
- Filament 5.10.2 is installed and the private `/admin` panel has been scaffolded. The PHP 8.4 `intl` extension was enabled and verified. Use the explicit PHP 8.4 Composer and Artisan commands documented above.
- A safe additive user-role migration has been applied, with `administrator` and `contributor` roles. No CMS user is created automatically; create authorized users only after confirming the initial credentials and workflow.
- A local Administrator account exists for the supplied administrator email. Its password is intentionally not recorded in this file, source code, or logs.
- The Filament login screen has a CIC-branded intro panel using the supplied logo, CIC blue/cyan/yellow colors, responsive styling, and reduced-motion-safe interaction.
- The Article CMS foundation is installed for Announcements, News, Blogs, and Achievements. It includes an additive `articles` table, Eloquent model/scopes, draft-first Filament forms, validated public-disk image uploads, article policy checks, and contributor ownership scoping.
- Article workflow actions are implemented: contributors can submit drafts, administrators can request changes, publish, unpublish, or archive through policy-authorized Filament actions.
- Public article listing and detail routes are implemented at `/articles` and `/articles/{slug}`. Published article details remain available after announcement expiration, while expired announcements are excluded from the active public listing query.
- Added a protected Filament Media & Gallery resource with validated public-disk image uploads, required title/alt text, captions, gallery visibility, contributor ownership scoping, and administrator-only deletion.
- Added a Filament Content Overview widget showing published articles, articles awaiting review, and gallery asset counts.
- Increased the PHP 8.4 upload limits to `upload_max_filesize=10M` and `post_max_size=12M`, and configured Livewire temporary uploads to use the local disk with a 5 MB validation limit. Restart the PHP 8.4 development server after changing these settings.
- Updated `APP_URL` to `http://127.0.0.1:8000` so local public storage URLs match the documented development server.
- Connected the homepage to live published articles and visible gallery media through `HomeController`; empty states remain visible until approved CMS content exists.
- Added a live homepage gallery preview and article cards with links to the public article listing/detail pages.
- Administrators can now publish or archive Draft articles directly; Contributors must still submit their own Draft or Changes requested articles for review.
- Added Administrator-only CMS user management at `/admin/users`, with role selection for Administrator or Contributor, minimum password validation, and protection against deleting the currently logged-in account.
- Contributor dashboard statistics are now scoped to the signed-in Contributor's own articles and gallery assets; Administrators retain global content statistics.
- Added a dedicated public gallery at `/gallery`, showing only Media & Gallery assets marked `Show in public gallery`, with pagination, accessible alt text, captions, and an intentional empty state.
- Added a homepage Featured Announcements section driven by the server-side `activeFeatured()` scope. Expired announcements are excluded from both the featured block and homepage latest stories, while their published detail pages remain available.
- Improved the Filament dashboard with role-aware clickable statistics, review-state counts, dashboard visual styling, and a dedicated Articles `Needs review` filter for Administrators.
- Unified homepage announcements and latest stories into one ordered content feed. Active featured announcements are highlighted in that feed without duplication; expired announcements remain excluded by server-side filtering.
- Added public article search and type filtering at `/articles`, preserving server-side publication and announcement-expiration rules across pagination. Invalid type values safely fall back to the full published listing.
- Enhanced public article details with same-type related published stories and an accessible copy-link action powered by the shared Vite entrypoint.
- Added authenticated draft previews for Contributors and Administrators. Article creation now clearly saves as `Save draft`, and the edit page provides `Preview article`; unpublished content remains inaccessible to public visitors.
- Improved Article and Media & Gallery form layouts with full-width upload/editor fields and helper text explaining slugs, excerpts, image titles, and alternative text.
- Added a reusable public navigation header to the Stories listing, Article detail/preview, and Gallery pages so visitors can always return Home, Stories, Gallery, or Contact CIC.
- Added the public Programs Offered page at `/programs`, listing BS Psychology, BS Medical Technology, BS Radiologic Technology, and BS Information System from the provided CIC/CHED-RO2 RRPA announcement. Added a homepage programs preview and an official Facebook updates link without inventing enrollment requirements or schedules.
- Added Administrator-managed program previews at `/programs/{slug}` with official seeded program records, laboratory/campus image galleries supporting 1–5 images, facility descriptions, related program suggestions, publication toggles, and safe empty states before images are uploaded.
- Added responsive mobile navigation to the homepage and all shared public pages, with keyboard-accessible menu toggles, focus movement, close-on-navigation behavior, and reduced-motion-compatible styling.
- Added a dedicated public About CIC page at `/about` with shared responsive navigation, clearly labeled placeholder institutional copy, CIC-branded direction cards, and links to programs and stories. Homepage About links now open the dedicated page.
- Added a dedicated public Admissions page at `/admissions` with a clear applicant pathway, program/about/contact links, and explicitly labeled placeholders for requirements, schedules, office hours, and FAQs until CIC confirms official details. Homepage and shared navigation Admissions links now open the dedicated page.
- Improved visitor UX on the homepage with a “Find your way” pathway for enrollment, programs, news, and contact actions, plus an accessible FAQ section that uses verified program information and clearly labels pending admissions/contact details.
- Added the CIC motto to the public brand treatment: “Educatio Eximia Ad Progressum” with the English translation “Quality Education Towards Progress” in the shared navigation, homepage hero, and footer. Replaced the abbreviated navigation brand label with the full “City of Ilagan College” name.
- Replaced abrupt native FAQ disclosure behavior with animated accessible FAQ toggles. The plus icon rotates into a close state, panels expand/collapse smoothly, and reduced-motion preferences minimize the transition.
- Added a shared scroll-aware “Back to top” control to public pages and corrected FAQ listener initialization so FAQ behavior is independent of mobile navigation setup. The control is keyboard accessible when visible, uses smooth scrolling where appropriate, and respects reduced-motion preferences.
- Improved the private CMS dashboard with a role-aware workflow guide. Contributors now get direct draft, article, and media shortcuts plus revision-request guidance; Administrators get review, user-management, and queue-priority shortcuts without changing server-side authorization.
- Added an Administrator-only content review queue showing submitted articles, open revision requests, and featured announcements expiring within seven days, with direct links to each article and intentional empty states.
- Fixed the Filament workflow guide's administrator-only filter links by passing generated URLs from the widget class instead of referencing an unavailable Blade `Article` class. Fixed Media & Gallery thumbnails to use the private `media` disk and guarded media route. Replaced the plain Filament brand text with a CIC logo, full college name, and motto treatment.
- Refined the Filament dashboard UI with a CIC-branded gradient workspace hero, stronger metric cards, color-coded review queue columns, a branded topbar label, responsive spacing, and removal of the generic Filament information card.
- Corrected the dashboard layout after visual review by removing the duplicate topbar identity and oversized account card, changing workflow links into compact action containers, and keeping review areas in responsive columns at laptop widths.
- Increased admin sidebar branding visibility with a larger high-contrast CIC seal, full college name, and readable motto lines. Rebuilt the review queue as responsive status cards with icons, counts, article metadata, and intentional empty states for clearer scanning on mobile, tablet, and desktop.
- Added an accessible image lightbox to public program facility previews and the campus gallery. Visitors can open images, use previous/next controls, close with Escape or the close button, see captions and position counts, and return focus to the triggering image.
- Improved visitor navigation with a sticky, translucent public header and route-aware active navigation states (`aria-current="page"` plus visual highlighting) across shared public pages.
- Completed an implementation audit and fixed several concrete gaps: added the required public Contact & Location page at `/contact`, replaced the public placeholder email link with verified-information messaging, corrected same-type related-story filtering with a fallback, restricted Contributor media record viewing to owned assets, fixed mobile-menu initialization on pages without copy-link buttons, and added crawler-safe `robots.txt` and `sitemap.xml` endpoints that exclude admin, previews, drafts, and expired announcement listings.
- Removed the editable hidden Article `status` field so workflow state can only change through server-authorized transition actions; article creation still assigns Draft server-side.
- Moved existing CMS upload bytes from the public storage disk to the private `media` disk through the additive migration `2026_10_15_170000_move_uploads_to_private_media`. New Article, Media & Gallery, and Program uploads use that private disk. The guarded `/media/{path}` endpoint serves only published/visible assets publicly and permits authenticated owners/Administrators to preview private assets.
- Updated all public image views and sanitized inline article image URLs to use guarded `/media/{path}` delivery. Added migration-safe media delivery and private-preview regression tests.
- Added reference-aware private media lifecycle cleanup. Replaced or deleted Article covers, Media & Gallery assets, and Program images are removed from private storage only when no remaining database record or article inline-content reference uses the path.
- Added `.env.production.example` with `APP_DEBUG=false`, production URL, SQLite, private-session, and SMTP placeholders; real deployment secrets and verified CIC mail/domain values must be supplied outside source control. Added `scripts\backup-local.ps1` for non-destructive SQLite/private-media backups and documented Windows private-storage ACL guidance in `README.md`.
- Fixed safe inline article images: stored editor images under the local public storage URL now render on article detail pages while unsafe image sources and event attributes are removed.
- Added a responsive article detail layout with a readable main column, sticky related-story suggestions, and a fallback to other published story types when no same-type suggestions exist.

Be concise, factual, and transparent. Do not claim the entire website is complete if important features remain unfinished.
