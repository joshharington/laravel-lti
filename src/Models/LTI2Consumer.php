<?php
namespace JoshHarington\LaravelLTI\Models;

use Illuminate\Database\Eloquent\Model;

class LTI2Consumer extends Model {

    public $incrementing = true;
    protected $table = 'lti2_consumer';
    protected $primaryKey = 'consumer_pk';
    protected $fillable = ['name', 'consumer_key256', 'consumer_key', 'secret', 'lti_version', 'consumer_name',
        'consumer_version', 'consumer_guid', 'profile', 'tool_proxy', 'settings', 'protected', 'enabled',
        'enable_from', 'enable_until', 'last_access', 'created', 'updated'];
    protected $hidden = ['secret'];

}

//$table->increments('consumer_pk');
//$table->string('name');
//$table->string('consumer_key256')->unique();
//$table->text('consumer_key')->nullable();
//$table->text('secret');
//$table->string('lti_version')->nullable();
//$table->string('consumer_name')->nullable();
//$table->string('consumer_version')->nullable();
//$table->text('consumer_guid')->nullable();
//$table->text('profile')->nullable();
//$table->text('tool_proxy')->nullable();
//$table->text('settings')->nullable();
//$table->tinyInteger('protected')->nullable();
//$table->tinyInteger('enabled')->nullable();
//$table->dateTime('enable_from')->nullable();
//$table->dateTime('enable_until')->nullable();
//$table->date('last_access')->nullable();
//$table->dateTime('created')->nullable();
//$table->dateTime('updated')->nullable();