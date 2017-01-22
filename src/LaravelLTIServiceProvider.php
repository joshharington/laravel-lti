<?php
/**
 * Created by PhpStorm.
 * User: jharing10
 * Date: 2017/01/17
 * Time: 9:23 AM
 */

namespace JoshHarington\LaravelLTI;


use Illuminate\Support\ServiceProvider;

class LaravelLTIServiceProvider extends ServiceProvider {

    public function boot() {
        $this->migrations();
        $this->views();
        $this->routes();
    }

    public function register() {
        $this->app->singleton('laravel_lti', function($app) {
            return new LaravelLTI;
        });
    }

    public function migrations() {
        $this->publishes([__DIR__.'/database/migrations' => database_path('migrations')], 'migrations');
    }

    public function views() {
        $this->loadViewsFrom(__DIR__.'/resources/views', 'jh.lti');
    }

    public function routes() {
        $this->loadRoutesFrom(__DIR__.'/routes/web.php', 'jh.lti');
    }

}