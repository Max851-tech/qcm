<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * Enregistre les services dans l'application.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Effectue les opérations d'initialisation après que tous les services ont été enregistrés.
     *
     * @return void
     */
    public function boot()
    {
        $this->routes(function () {
            Route::middleware('web')
                ->group(base_path('routes/web.php'));

            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api.php'));
        });
    }
}
