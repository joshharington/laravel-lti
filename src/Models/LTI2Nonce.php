<?php
/**
 * Created by PhpStorm.
 * User: jharing10
 * Date: 2017/01/17
 * Time: 10:23 AM
 */

namespace JoshHarington\LaravelLTI\Models;


use Illuminate\Database\Eloquent\Model;

class LTI2Nonce extends Model {

    public $incrementing = true;
    protected $table = 'lti2_nonce';
    protected $primaryKey = ['consumer_pk', 'value'];
    protected $fillable = ['consumer_pk', 'value', 'expires'];
    protected $hidden = [];

}

//$table->integer('consumer_pk');
//$table->string('value');
//$table->dateTime('expires');