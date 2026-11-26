# City of Ilagan College Promotional Website

A Laravel 13 promotional website and private Filament CMS for City of Ilagan College.

## What you need

- PHP 8.4: `C:\tools\php84\php.exe`
- Composer
- Node.js and npm

Do not use XAMPP's PHP 8.2 for this project.

## First-time setup

Open PowerShell in the project folder:

```powershell
Set-Location "C:\xampp\htdocs\cic-promotional-website"
npm install
& "C:\tools\php84\php.exe" "C:\ProgramData\ComposerSetup\bin\composer.phar" install
& "C:\tools\php84\php.exe" artisan migrate
& "C:\tools\php84\php.exe" artisan storage:link
```

If the `.env` file is missing:

```powershell
Copy-Item ".env.example" ".env"
& "C:\tools\php84\php.exe" artisan key:generate
& "C:\tools\php84\php.exe" artisan migrate
& "C:\tools\php84\php.exe" artisan storage:link
```

## Run the website

Run this command once:

```powershell
Set-Location "C:\xampp\htdocs\cic-promotional-website"
.\scripts\start-project.ps1
```

The script opens Laravel and Vite in separate terminals.

- Website: http://127.0.0.1:8000
- CMS: http://127.0.0.1:8000/admin
- Frontend development server: http://localhost:5173

If port 5173 is busy, Vite will select another available port automatically.

## Run manually

Terminal 1:

```powershell
Set-Location "C:\xampp\htdocs\cic-promotional-website"
& "C:\tools\php84\php.exe" artisan serve --host=127.0.0.1 --port=8000
```

Terminal 2:

```powershell
Set-Location "C:\xampp\htdocs\cic-promotional-website"
npm run dev
```

Keep both terminals open while using the website.

## Deploy to Railway

Railway's Railpack detects this Laravel app, installs Composer and npm dependencies, builds the Vite assets, and runs Laravel's migrations and optimization by default. The application already provides the `/up` health endpoint.

1. Push the project to a GitHub repository and create a Railway project using **Deploy from GitHub repo**.
2. Add a Railway PostgreSQL service. In the app service's **Variables**, set the values from `.env.production.example`, including:
   - `APP_ENV=production`, `APP_DEBUG=false`, and a secure `APP_KEY`
   - `DB_CONNECTION=pgsql`
   - `DB_URL=${{Postgres.DATABASE_URL}}` (change `Postgres` if your database service has a different name)
   - `RAILPACK_PHP_EXTENSIONS=pdo_pgsql`
   - `LOG_CHANNEL=stderr`
3. Generate an application key locally with `& "C:\tools\php84\php.exe" artisan key:generate --show`, then add its output as the Railway `APP_KEY` variable. Do not commit the key.
4. Deploy, generate a public domain in the app service's **Settings → Networking**, then set `APP_URL` to that HTTPS domain and redeploy.
5. Before accepting CMS uploads, attach a Railway volume to the app service at `/app/storage/app/private/media`. The CMS stores uploaded media on the local filesystem; without persistent storage, uploads can be lost when Railway replaces the container.
6. Create the first CMS user from the Railway service shell with `php artisan make:filament-user`. New users default to the Contributor role. To promote the intended administrator, run `php artisan tinker --execute='App\Models\User::where("email", "YOUR_ADMIN_EMAIL")->update(["role" => App\Models\User::ROLE_ADMINISTRATOR]);'` with that user's email.

Railway's new PostgreSQL database starts empty: it does not import content, CMS users, or uploaded files from the local SQLite database. Do not run `php artisan db:seed` in production; the current seeder creates a test user. Migrate existing site content and media separately if they need to appear on the live site. Keep `.env` and local SQLite data out of GitHub.
