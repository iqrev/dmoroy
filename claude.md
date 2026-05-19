# Project Context for Claude

This document serves as a persistent context initialization file for Claude when working on the "Batik Jambi Berkah" project. Read this before suggesting architectural changes or server commands.

## Overview
Batik Jambi Berkah is an E-commerce and CMS platform. It is built on the Laravel ecosystem and relies heavily on Filament V3 for administration and content management.

## Technical Architecture
- **Backend Framework**: Laravel 13.x
- **Frontend**: Blade Templating + Tailwind CSS v4
- **Admin Architecture**: Filament V3 (TALL Stack: Tailwind, Alpine.js, Laravel, Livewire)
- **Database**: MySQL

## Critical Deployment Rules (Hostinger Shared Hosting)
Because this project is deployed on Hostinger Shared Hosting via hPanel, you must strictly adhere to the following environmental constraints:

1. **PHP CLI Versioning**:
   The default SSH `php` binary points to an older version (8.2). Laravel 13 requires PHP 8.3+. 
   - **Action**: Always provide commands using the `php8.4` binary.
   - Example: `php8.4 artisan clear:cache` or `/usr/bin/php8.4 composer.phar install`.

2. **The Symlink Restriction**:
   Hostinger disables PHP's `symlink()` and `exec()` functions on shared plans. Calling `php artisan storage:link` will result in a fatal error.
   - **Action**: Instruct the user to manually create the symlink via SSH bash:
     `ln -s "$PWD/storage/app/public" "$PWD/public/storage"`

3. **Maintenance Mode Trap**:
   The application uses a custom Filament widget (`MaintenanceWidget`) to invoke `Artisan::call('down')`. 
   - **Action**: Ensure that `bootstrap/app.php` explicitly ignores the `/admin*` and `/livewire*` routes for `PreventRequestsDuringMaintenance` middleware. This guarantees admins can always access the dashboard to turn the site back online via the UI.

## Codebase Conventions
- **Admin Panel Theme**: Configured in `AdminPanelProvider.php`. Uses `#8b0000` (Crimson) as primary color and `Plus Jakarta Sans` for fonts.
- **Filament Components**: Do not use deprecated V2 components (e.g., replace `x-filament::card` with `x-filament::section`).
- **Data Protection**: Never suggest destructive database commands (`migrate:fresh`) as the production database contains live catalogue and post data. Always use safe migrations (`migrate --force`).
