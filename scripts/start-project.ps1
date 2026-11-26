$projectDirectory = Split-Path -Parent $PSScriptRoot
$php = "C:\tools\php84\php.exe"

if (-not (Test-Path $php)) {
    Write-Error "PHP 8.4 was not found at $php"
    exit 1
}

if (-not (Test-Path (Join-Path $projectDirectory ".env"))) {
    Copy-Item (Join-Path $projectDirectory ".env.example") (Join-Path $projectDirectory ".env")
    & $php (Join-Path $projectDirectory "artisan") key:generate
    & $php (Join-Path $projectDirectory "artisan") migrate
    & $php (Join-Path $projectDirectory "artisan") storage:link
}

Start-Process powershell.exe -ArgumentList "-NoExit", "-Command", "Set-Location '$projectDirectory'; & '$php' artisan serve --host=127.0.0.1 --port=8000"
Start-Process powershell.exe -ArgumentList "-NoExit", "-Command", "Set-Location '$projectDirectory'; npm run dev"

Write-Host "Starting Laravel and Vite..."
