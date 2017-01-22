<?php
/**
 * Created by PhpStorm.
 * User: jharing10
 * Date: 2017/01/17
 * Time: 11:08 AM
 */

namespace JoshHarington\LaravelLTI\Classes\Tools;

use IMSGlobal\LTI\ToolProvider;

class ToolConsumer {

    protected $consumer;

    /**
     * ToolConsumer constructor.
     * @param $consumer
     */
    public function __construct($key, $secret, $name, $db_conn, $enabled = TRUE) {
        $this->consumer = new ToolProvider\ToolConsumer($key, $db_conn);
        $this->consumer->name = $name;
        $this->consumer->secret = $secret;
        $this->consumer->enabled = $enabled;
        $this->consumer->save();
    }

    /**
     * @return ToolProvider\ToolConsumer
     */
    public function getConsumer() {
        return $this->consumer;
    }

    /**
     * @param ToolProvider\ToolConsumer $consumer
     */
    public function setConsumer($consumer) {
        $this->consumer = $consumer;
    }

}