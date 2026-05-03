<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;

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
        // 2. Fuerza HTTPS en producción
        if (config('app.env') !== 'local') {
            URL::forceScheme('https');
        }
        // --- 2. NUEVO FIX: POLÍTICA DE SEGURIDAD DE CONTENIDO (CSP) ---
        // Esto le dice al navegador exactamente en qué recursos confiar.
        if (config('app.env') !== 'local') {
            app()->afterResolving('response', function ($response) {
                // Generamos la regla CSP y la agregamos al header de la respuesta
                $csp = "default-src 'self' https://fonts.gstatic.com; " .
                       "script-src 'self' 'unsafe-inline' 'unsafe-eval'; " . // 'unsafe-eval' es necesario para Vite
                       "style-src 'self' 'unsafe-inline' https://fonts.googleapis.com; " . // Whitelist Google Fonts
                       "img-src 'self' data:; " . // Whitelist imágenes locales y base64
                       "font-src 'self' https://fonts.gstatic.com; " .
                       "frame-ancestors 'none'; " . // Previene clickjacking
                       "object-src 'none'; "; // Desactiva plugins (como flash)

                $response->headers->set('Content-Security-Policy', $csp);
            });
        }
    }
}