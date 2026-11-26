param(
    [string]$Destination = (Join-Path (Get-Location) 'backups')
)

$ErrorActionPreference = 'Stop'

$projectRoot = Split-Path -Parent $PSScriptRoot
$databasePath = Join-Path $projectRoot 'database\database.sqlite'
$mediaPath = Join-Path $projectRoot 'storage\app\private\media'
$timestamp = Get-Date -Format 'yyyyMMdd-HHmmss'
$backupRoot = Join-Path $Destination $timestamp

if (-not (Test-Path -LiteralPath $databasePath)) {
    throw "SQLite database was not found at $databasePath"
}

New-Item -ItemType Directory -Path $backupRoot -Force | Out-Null
Copy-Item -LiteralPath $databasePath -Destination (Join-Path $backupRoot 'database.sqlite')

if (Test-Path -LiteralPath $mediaPath) {
    Copy-Item -LiteralPath $mediaPath -Destination (Join-Path $backupRoot 'media') -Recurse
}

Write-Output "Backup created at $backupRoot"
