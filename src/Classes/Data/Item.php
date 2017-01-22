<?php
/**
 * Created by PhpStorm.
 * User: jharing10
 * Date: 2017/01/18
 * Time: 11:08 AM
 */

namespace JoshHarington\LaravelLTI\Classes\Data;


###
###  Class representing an item
###
class Item {

    public $item_pk = NULL;
    public $item_title = '';
    public $item_text = '';
    public $item_url = '';
    public $max_rating = 3;
    public $step = 1;
    public $visible = FALSE;
    public $sequence = 0;
    public $created = NULL;
    public $updated = NULL;
    public $num_ratings = 0;
    public $tot_ratings = 0;

    // ensure non-string properties have the appropriate data type
    function __set($name, $value) {
        if ($name == 'mr') {
            $this->max_rating = intval($value);
        } else if ($name == 'st') {
            $this->step = intval($value);
        } else if ($name == 'vis') {
            $this->visible = $value == '1';
        } else if ($name == 'seq') {
            $this->sequence = intval($value);
        } else if ($name == 'cr') {
            $this->created = \DateTime::createFromFormat('Y-m-d H:i:s', $value);
        } else if ($name == 'upd') {
            $this->updated = \DateTime::createFromFormat('Y-m-d H:i:s', $value);
        } else if ($name == 'num') {
            $this->num_ratings = intval($value);
        } else if ($name == 'total') {
            $this->tot_ratings = floatval($value);
        }

    }

}