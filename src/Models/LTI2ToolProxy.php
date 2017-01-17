<?php
/**
 * Created by PhpStorm.
 * User: jharing10
 * Date: 2017/01/17
 * Time: 10:23 AM
 */

namespace JoshHarington\LaravelLTI\Models;


use Illuminate\Database\Eloquent\Model;

class LTI2ToolProxy extends Model {

    public $incrementing = true;
    protected $table = 'lti2_tool_proxy';
    protected $primaryKey = 'tool_proxy_pk';
    protected $fillable = ['tool_proxy_id', 'consumer_pk', 'tool_proxy', 'created', 'updated'];
    protected $hidden = [];

}

//$table->increments('tool_proxy_pk');
//$table->string('tool_proxy_id')->index();
//$table->integer('consumer_pk')->unsigned()->index();
//$table->text('tool_proxy');
//$table->dateTime('created');
//$table->dateTime('updated');