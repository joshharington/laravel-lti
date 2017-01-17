<?php
/**
 * Created by PhpStorm.
 * User: jharing10
 * Date: 2017/01/17
 * Time: 10:24 AM
 */

namespace JoshHarington\LaravelLTI\Models;


use Illuminate\Database\Eloquent\Model;

class LTI2ResourceLink extends Model {

    public $incrementing = true;
    protected $table = 'lti2_resource_link';
    protected $primaryKey = 'resource_link_pk';
    protected $fillable = ['context_pk', 'consumer_pk', 'lti_resource_link_id', 'settings', 'lti_resource_link_id', 'settings', 'primary_resource_link_pk', 'share_approved', 'created', 'updated'];
    protected $hidden = [];

}

//$table->increments('resource_link_pk');
//$table->integer('context_pk')->nullable()->index();
//$table->integer('consumer_pk')->nullable()->index();
//$table->string('lti_resource_link_id');
//$table->text('settings')->nullable();
//$table->integer('primary_resource_link_pk');
//$table->tinyInteger('share_approved');
//$table->dateTime('created');
//$table->dateTime('updated');