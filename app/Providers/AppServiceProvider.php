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
    }
}
