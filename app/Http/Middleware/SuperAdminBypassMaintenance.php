<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SuperAdminBypassMaintenance
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Jika website sedang dalam mode maintenance
        if (app()->isDownForMaintenance()) {
            
            // 1. Jika yang sedang login adalah Super Admin, biarkan lewat (Bypass 100%)
            if (auth()->check() && auth()->user()->isSuperAdmin()) {
                return $next($request);
            }

            // 2. Jika bukan Super Admin (atau belum login), tapi mencoba akses rute admin, biarkan lewat agar bisa login
            if ($request->is('admin*') || $request->is('livewire*')) {
                return $next($request);
            }

            // 3. Selain kondisi di atas, lemparkan ke halaman 503 Maintenance
            abort(503);
        }

        return $next($request);
    }
}
