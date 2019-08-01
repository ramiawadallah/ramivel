<?php

namespace Ramvel\Multiauth\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Ramvel\Multiauth\View\ThemeViewFinder;
use Ramvel\Multiauth\View\Composers;

//BY Boomvel

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        Schema::enableForeignKeyConstraints();
        Schema::defaultStringLength(191);
        $this->app['view']->composer('layouts.frontend', Composers\InjectPages::class);
        //$this->app['view']->setFinder($this->app['theme.finder']);
        // $this->app['view']->composer('layouts.home', Composers\InjectPages::class);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
        $this->app->singleton('theme.finder', function ($app) {
          $finder = new ThemeViewFinder($app['files'], $app['config']['view.paths']);

          $config = $app['config']['cms.theme'];
          $finder->setBasePath($app['path.public'].'/'.$config['folder']);
          $finder->setActiveTheme($config['active']);

          return $finder;
        });
    }
}
