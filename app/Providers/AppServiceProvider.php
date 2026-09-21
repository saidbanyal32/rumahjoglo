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
        \Illuminate\Support\Facades\View::composer('*', function ($view) {
            $settings = \Illuminate\Support\Facades\Cache::remember('site_settings_all', 60, function () {
                try {
                    return \App\Models\Setting::all()->pluck('value', 'key')->toArray();
                } catch (\Throwable $e) {
                    return [];
                }
            });

            $rawWa = $settings['contact_whatsapp'] ?? '6281234567890';
            $cleanWa = preg_replace('/[^0-9]/', '', (string)$rawWa);
            if (str_starts_with($cleanWa, '0')) {
                $cleanWa = '62' . substr($cleanWa, 1);
            } elseif (str_starts_with($cleanWa, '8')) {
                $cleanWa = '62' . $cleanWa;
            }

            $settings['formatted_whatsapp'] = $cleanWa ?: '6281234567890';

            $view->with('siteSettings', $settings);
        });
    }
}
