<?php

namespace App\Providers\Filament;

use App\Filament\Pages\Auth\Login;
use App\Http\Middleware\LoginRateLimiter;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Support\Facades\FilamentView;
use Filament\View\PanelsRenderHook;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\HtmlString;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('admin')
            ->login(Login::class)
            ->brandName("D'Moroy")
            ->font('Plus Jakarta Sans')
            ->sidebarCollapsibleOnDesktop()
            ->colors([
                'primary' => Color::hex('#996515'),
                'gray' => Color::hex('#78716c'),
                'danger' => Color::Rose,
                'info' => Color::hex('#C5A880'),
                'success' => Color::Emerald,
                'warning' => Color::Amber,
            ])
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([
                // Widgets\AccountWidget::class,
            ])
            ->plugins([
                \Awcodes\Curator\CuratorPlugin::make()
                    ->label('Media')
                    ->pluralLabel('Media')
                    ->navigationIcon('heroicon-o-photo')
                    ->navigationGroup('Konten')
                    ->navigationSort(5),
            ])
            ->renderHook(
                PanelsRenderHook::HEAD_END,
                fn (): string => '<link rel="preconnect" href="https://fonts.googleapis.com">
                    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
                    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700&display=swap" rel="stylesheet">
                    <style>' . file_get_contents(resource_path('css/filament/admin/theme.css')) . '</style>',
            )
            ->renderHook(
                PanelsRenderHook::AUTH_LOGIN_FORM_BEFORE,
                fn (): string => '<div style="text-align:center;margin-bottom:1.5rem;">
                    <div style="display:flex;align-items:center;justify-content:center;gap:0.75rem;margin-bottom:0.75rem;">
                        <span style="width:3rem;height:1px;background:var(--dmoroy-gold);display:block;"></span>
                        <span style="color:var(--dmoroy-gold);font-weight:700;letter-spacing:0.2em;text-transform:uppercase;font-size:0.6rem;">Admin Panel</span>
                        <span style="width:3rem;height:1px;background:var(--dmoroy-gold);display:block;"></span>
                    </div>
                    <p style="color:var(--dmoroy-brown);font-family:Playfair Display,serif;font-size:1.75rem;font-weight:700;margin:0;letter-spacing:-0.02em;">D\'Moroy</p>
                    <p style="color:var(--dmoroy-brown);opacity:0.5;font-size:0.7rem;margin-top:0.25rem;letter-spacing:0.15em;text-transform:uppercase;">Artisan Handmade</p>
                </div>',
            )
            ->renderHook(
                PanelsRenderHook::AUTH_LOGIN_FORM_AFTER,
                fn (): string => '<div style="text-align:center;margin-top:1.5rem;padding-top:1rem;border-top:1px solid var(--dmoroy-gold);opacity:0.6;">
                    <p style="color:var(--dmoroy-brown);font-size:0.65rem;letter-spacing:0.1em;text-transform:uppercase;">Dilindungi oleh sistem keamanan</p>
                </div>',
            )
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
                LoginRateLimiter::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ]);
    }
}
