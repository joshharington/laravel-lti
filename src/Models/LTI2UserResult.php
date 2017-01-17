<?php
/**
 * Created by PhpStorm.
 * User: jharing10
 * Date: 2017/01/17
 * Time: 10:24 AM
 */

namespace JoshHarington\LaravelLTI\Models;


use Illuminate\Database\Eloquent\Model;

class LTI2UserResult extends Model {

    public $incrementing = true;
    protected $table = 'lti2_user_result';
    protected $primaryKey = 'user_pk';
    protected $fillable = ['resource_link_pk', 'lti_user_id', 'lti_result_sourcedid', 'created', 'updated'];
    protected $hidden = [];

}

//$table->increments('user_pk');
//$table->integer('resource_link_pk')->index();
//$table->string('lti_user_id');
//$table->text('lti_result_sourcedid');
//$table->dateTime('created');
//$table->dateTime('updated');