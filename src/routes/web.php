<?php
/**
 * Created by PhpStorm.
 * User: jharing10
 * Date: 2017/01/17
 * Time: 10:49 AM
 */

Route::group(['prefix' => '/lti/tools', 'namespace' => '\\JoshHarington\LaravelLTI\Http\Controllers', 'middleware' => ['web']], function() {
    Route::match(['get', 'post'], '/{config}/{launch_url?}', ['as' => 'lti.launch', 'uses' => 'LTIController@launch']);
});