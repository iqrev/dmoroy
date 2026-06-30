# Changelog

All notable changes to this project will be documented in this file.

## [2026-06-30] - CMS & Security Improvements
- Implemented 4-layer login security (Rate Limiting, Honeypot, Logging, Dashboard Widget).
- Customized Admin Login styling to match D'Moroy branding.
- Fixed global CSS override issues in Filament dark mode.
- Set Curator path generator to disable date-based folders for media uploads.
- Reverted advanced SEO features in Articles (Posts) to keep it simpler for UMKM management.
- Added a date picker for `created_at` in the Article creation form.
- Added "Lihat" action button for published articles in the Filament table.
- Fixed stale dummy images in mini-cart and cart page by dynamically fetching live product images.

## [1.0.0] - Blueprint Initial Release
- Set up as UMKM Blueprint Template
- Added generic dummy seeders
- Removed all specific client data
- Configured default Filament admin panel
- Updated views and generic settings
