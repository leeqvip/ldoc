<?php

namespace Ldoc;

use Illuminate\Support\ServiceProvider;
use Route;

class LdocServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(dirname(__DIR__).'/config/ldoc.php', 'ldoc');
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([__DIR__.'/../storage/docs' => storage_path('docs')], 'ldoc-storage');
        }

        $prefix = $this->app['config']->get('ldoc.uri_prefix');

        $this->app['router']->prefix($prefix)->group(function () use ($prefix) {
            Route::get('/{path?}', function ($path = '') use ($prefix) {
                $handler = new Handler(
                    $this->app['config']->get('ldoc.docs_dir'),
                    $prefix
                );

                return view('ldoc::index', $handler->handle($path));
            })->where('path', '.*');
        });

        $this->loadViewsFrom(__DIR__.'/../resources/views', 'ldoc');
    }
}
