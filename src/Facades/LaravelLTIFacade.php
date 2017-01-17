<?php
/**
 * Created by PhpStorm.
 * User: jharing10
 * Date: 2017/01/17
 * Time: 10:05 AM
 */

namespace JoshHarington\LaravelLTI\Facades;


use Illuminate\Support\Facades\Facade;

class LaravelLTIFacade extends Facade {

    public static function getFacadeAccessor() {
        return 'laravel_lti';
    }

}