<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Models\Empresa;
use Illuminate\Support\Facades\View;

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
        $empresa = Empresa::first();
        View::share('empresa', $empresa);
    }
}
