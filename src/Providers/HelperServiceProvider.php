<?php
namespace Codelife\CodelifeHelpers\Providers;

use Illuminate\Support\ServiceProvider;

// add extras in composer.json file
// Include this provider first in config/app.php
// Codelife\CodelifeHelpers\Providers\HelperServiceProvider::class,
class HelperServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */

    public function boot(): void{
        $this->publishes([
            __DIR__.'/../../database/migrations/' => database_path('/migrations')
        ], 'migrations');
        // Publish these migrations tags
        // php artisan vendor:publish --provider="Codelife\CodelifeHelpers\Providers\HelperServiceProvider" --tag='migrations'
        // php artisan vendor:publish --provider="Codelife\CodelifeHelpers\Providers\HelperServiceProvider" --tag="migrations"
    }
}
