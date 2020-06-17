<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Blade directives
        Blade::directive('actualyear', function () {
            return "<?php echo (new \DateTime('now'))->format('Y'); ?>";
        });

        Blade::directive('now', function () {
            return "<?php echo (new \DateTime('now'))->format('m-d-Y'); ?>";
        });

        Blade::directive('currentfullname', function () {
            return "<?php echo currentUser()->fullName(); ?>";
        });

        Blade::withoutDoubleEncoding();
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
