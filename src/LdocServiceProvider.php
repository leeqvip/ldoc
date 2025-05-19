<?php

namespace Ldoc;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;

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
            $this->publishes([__DIR__.'/../storage/docs' => App::storagePath('docs')], 'ldoc-storage');
        }

        $prefix = $this->app['config']->get('ldoc.uri_prefix');
        $environment = $this->app['config']->get('ldoc.environment');

        if (App::environment($environment)) {
            $this->app['router']->prefix($prefix)->group(function () use ($prefix) {
                Route::get('/{path?}', function ($path = '') use ($prefix) {
                    $handler = new Handler(
                        $this->app['config']->get('ldoc.docs_dir'),
                        $prefix
                    );

                    return View::make('ldoc::index', $handler->handle($path));
                })->where('path', '.*');
            });
        }

        $this->loadViewsFrom(__DIR__.'/../resources/views', 'ldoc');
    }
}
