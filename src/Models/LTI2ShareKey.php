<?php
/**
 * Created by PhpStorm.
 * User: jharing10
 * Date: 2017/01/17
 * Time: 10:24 AM
 */

namespace JoshHarington\LaravelLTI\Models;


use Illuminate\Database\Eloquent\Model;

class LTI2ShareKey extends Model {

    public $incrementing = true;
    protected $table = 'lti2_share_key';
    protected $primaryKey = 'share_key_id';
    protected $fillable = ['resource_link_pk', 'auto_approve', 'expires'];
    protected $hidden = [];

}

//$table->string('share_key_id');
//$table->integer('resource_link_pk')->index();
//$table->tinyInteger('auto_approve');
//$table->dateTime('expires');