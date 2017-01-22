<?php
/**
 * Created by PhpStorm.
 * User: jharing10
 * Date: 2017/01/18
 * Time: 11:20 AM
 */

use IMSGlobal\LTI\ToolProvider\DataConnector\DataConnector;
use \JoshHarington\LaravelLTI\Classes\Tools\ToolProvider;

// Cancel any existing session
session_name('tools');
session_start();
$_SESSION = array();
session_destroy();

// Initialise database
$db = NULL;
$dataConn = new \JoshHarington\LaravelLTI\Classes\Data\DataConn;
if ($dataConn->init($db)) {
    $data_connector = DataConnector::getDataConnector($dbConn->DB_TABLENAME_PREFIX, $db);
    $tool = new ToolProvider($data_connector);
    $tool->setParameterConstraint('oauth_consumer_key', TRUE, 50, array('basic-lti-launch-request', 'ContentItemSelectionRequest', 'DashboardRequest'));
    $tool->setParameterConstraint('resource_link_id', TRUE, 50, array('basic-lti-launch-request'));
    $tool->setParameterConstraint('user_id', TRUE, 50, array('basic-lti-launch-request'));
    $tool->setParameterConstraint('roles', TRUE, NULL, array('basic-lti-launch-request'));
} else {
    $tool = new ToolProvider(NULL);
    $tool->reason = $_SESSION['error_message'];
}
$tool->handleRequest();