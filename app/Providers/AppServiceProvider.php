<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // File upload optimizations are now handled through Curator configuration

        // Share post categories grouped for navigation
        view()->composer('layouts.app', function ($view) {
            $view->with('navGroups', [
                'edukasi' => \App\Models\PostCategory::where('slug', 'knowledge')->with('children.children')->first(),
                'galeri' => \App\Models\PostCategory::where('slug', 'dokumentasi-event')->with('children.children')->first()
            ]);
        });

        // Load custom styling for Filament Curator using Vite
        \Filament\Support\Facades\FilamentView::registerRenderHook(
            \Filament\View\PanelsRenderHook::HEAD_END,
            fn (): string => \Illuminate\Support\Facades\Blade::render("@vite('resources/css/curator.css')")
        );
    }
}
