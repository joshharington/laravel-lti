<?php
/**
 * Created by PhpStorm.
 * User: jharing10
 * Date: 2017/01/17
 * Time: 10:24 AM
 */

namespace JoshHarington\LaravelLTI\Models;


use Illuminate\Database\Eloquent\Model;

class LTI2Context extends Model {

    public $incrementing = true;
    protected $table = 'lti2_context';
    protected $primaryKey = 'context_pk';
    protected $fillable = ['consumer_pk', 'lti_context_id', 'settings', 'settings', 'created',  'updated'];
    protected $hidden = [];

}

//$table->increments('context_pk');
//$table->integer('consumer_pk')->index();
//$table->string('lti_context_id');
//$table->text('settings')->nullable();
//$table->dateTime('created');
//$table->dateTime('updated');