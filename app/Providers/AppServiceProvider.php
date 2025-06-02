<?php

namespace App\Providers;
use Illuminate\Support\Facades\App;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
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
    if (Schema::hasTable('empresas')) {
        $empresa = Empresa::first();
        View::share('empresa', $empresa);
    }

    if (App::environment('production')) {
        $publicPath = base_path('../public_html');
        $this->app->bind('path.public', function() use ($publicPath) {
            return $publicPath;
        });
    }
}
}
