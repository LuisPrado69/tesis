<?php


namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function boot()
    {

        View::composer('layout.left_col', 'App\Http\ViewComposers\MenuComposer');
        View::composer('layout.partial.shortcut_widget', 'App\Http\ViewComposers\ShortcutComposer');
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}