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
        $this->loadMigrationsFrom(__DIR__.'/database/migrations');
    }

    public function register() {

    }

}