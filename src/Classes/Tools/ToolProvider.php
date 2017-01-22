<?php
namespace JoshHarington\LaravelLTI\Classes\Tools;

use IMSGlobal\LTI\Profile\Item;
use IMSGlobal\LTI\Profile\Message;
use IMSGlobal\LTI\Profile\ResourceHandler;
use IMSGlobal\LTI\Profile\ServiceDefinition;
use IMSGlobal\LTI\ToolProvider\ContentItem;
use JoshHarington\LaravelLTI\Classes\Data\DataConn;

class ToolProvider extends \IMSGlobal\LTI\ToolProvider\ToolProvider {

    protected $dataConn;

    /**
     * ToolProvider constructor.
     */
    public function __construct($data_connector) {
        parent::__construct($data_connector);

        $this->dataConn = new DataConn;

        $this->baseUrl = $this->dataConn->getAppUrl();

        $this->vendor = new Item('ims', 'IMSGlobal', 'IMS Global Learning Consortium Inc', 'https://www.imsglobal.org/');
        $this->product = new Item('test-id', 'Plugin', 'Sample Plugin', 'http://tools.dev/', 1);

        $requiredMessages = array(new Message('basic-lti-launch-request', 'connect.php', array('User.id', 'Membership.role')));
        $optionalMessages = array(new Message('ContentItemSelectionRequest', 'connect.php', array('User.id', 'Membership.role')),
            new Message('DashboardRequest', 'connect.php', array('User.id'), array('a' => 'User.id'), array('b' => 'User.id')));

        $this->resourceHandlers[] = new ResourceHandler(
            new Item('test-id', 'Plugin', 'Sample Plugin'), 'https://placeholdit.imgix.net/~text?txtsize=6&txt=50%C3%9750&w=50&h=50',
            $requiredMessages, $optionalMessages);

        $this->requiredServices[] = new ServiceDefinition(array('application/vnd.ims.lti.v2.toolproxy+json'), array('POST'));

    }

    function onLaunch() {
        global $db;

        // Check the user has an appropriate role
        if ($this->user->isLearner() || $this->user->isStaff()) {
            // Initialise the user session
            $_SESSION['consumer_pk'] = $this->consumer->getRecordId();
            $_SESSION['resource_pk'] = $this->resourceLink->getRecordId();
            $_SESSION['user_consumer_pk'] = $this->user->getResourceLink()->getConsumer()->getRecordId();
            $_SESSION['user_resource_pk'] = $this->user->getResourceLink()->getRecordId();
            $_SESSION['user_pk'] = $this->user->getRecordId();
            $_SESSION['isStudent'] = $this->user->isLearner();
            $_SESSION['isContentItem'] = FALSE;

            // Redirect the user to display the list of items for the resource link
            $this->redirectUrl = $this->dataConn->getAppUrl();

        } else {

            $this->reason = 'Invalid role.';
            $this->ok = FALSE;

        }
    }

    function onContentItem() {
        // Check that the Tool Consumer is allowing the return of an LTI link
        $this->ok = in_array(ContentItem::LTI_LINK_MEDIA_TYPE, $this->mediaTypes) || in_array('*/*', $this->mediaTypes);
        if (!$this->ok) {
            $this->reason = 'Return of an LTI link not offered';
        } else {
            $this->ok = !in_array('none', $this->documentTargets) || (count($this->documentTargets) > 1);
            if (!$this->ok) {
                $this->reason = 'No visible document target offered';
            }
        }
        if ($this->ok) {
            // Initialise the user session
            $_SESSION['consumer_pk'] = $this->consumer->getRecordId();
            $_SESSION['resource_id'] = $this->dataConn->getGuid();
            $_SESSION['resource_pk'] = NULL;
            $_SESSION['user_consumer_pk'] = $_SESSION['consumer_pk'];
            $_SESSION['user_pk'] = NULL;
            $_SESSION['isStudent'] = FALSE;
            $_SESSION['isContentItem'] = TRUE;
            $_SESSION['lti_version'] = $_POST['lti_version'];
            $_SESSION['return_url'] = $this->returnUrl;
            $_SESSION['title'] = $this->dataConn->postValue('title');
            $_SESSION['text'] = $this->dataConn->postValue('text');
            $_SESSION['data'] = $this->dataConn->postValue('data');
            $_SESSION['document_targets'] = $this->documentTargets;
            // Redirect the user to display the list of items for the resource link
            $this->redirectUrl = $this->dataConn->getAppUrl();
        }
    }

    function onDashboard() {
        global $db;

        $title = 'Tools';
        $app_url = 'http://tools.dev';
        $icon_url = $this->dataConn->getAppUrl() . 'https://placeholdit.imgix.net/~text?txtsize=6&txt=50%C3%9750&w=50&h=50';
        $context_id = $this->dataConn->postValue('context_id', '');
        if (empty($this->context)) {
            $ratings = $this->dataConn->getUserSummary($db, $this->user->getResourceLink()->getConsumer()->getRecordId(), $this->user->getRecordId());
            $num_ratings = count($ratings);
            $courses = array();
            $lists = array();
            $tot_rating = 0;
            foreach ($ratings as $rating) {
                $courses[$rating->lti_context_id] = TRUE;
                $lists[$rating->resource_id] = TRUE;
                $tot_rating += ($rating->rating / $rating->max_rating);
            }
            $num_courses = count($courses);
            $num_lists = count($lists);
            if ($num_ratings > 0) {
                $av_rating = $this->dataConn->floatToStr($tot_rating / $num_ratings * 5);
            }
            $html = '<p> Here is a summary of your rating of items: </p> <ul> <li><em>Number of courses:</em> ' . $num_courses . '</li> <li><em>Number of rating lists:</em> ' . $num_lists . '</li> <li><em>Number of ratings made:</em> ' . $num_ratings . '</li>';
            if ($num_ratings > 0) {
                $html .= '<li><em>Average rating:</em> ' . $av_rating . ' out of 5</li>';
            }
            $html .= '</ul>';
            $this->output = $html;
        } else {
            if ($this->user->isLearner()) {
                $ratings = $this->dataConn->getUserRatings($db, $this->context->getRecordId(), $this->user->getRecordId());
            } else {
                $ratings = $this->dataConn->getContextRatings($db, $this->context->getRecordId());
            }
            $resources = array();
            $totals = array();
            foreach ($ratings as $rating) {
                $tot = ($rating->rating / $rating->max_rating);
                if (array_key_exists($rating->title, $resources)) {
                    $resources[$rating->title] += 1;
                    $totals[$rating->title] += $tot;
                } else {
                    $resources[$rating->title] = 1;
                    $totals[$rating->title] = $tot;
                }
            }
            ksort($resources);
            $items = '';
            $n = 0;
            foreach ($resources as $title => $value) {
                $n++;
                $av = $this->dataConn->floatToStr($totals[$title] / $value * 5);
                $plural = '';
                if ($value <> 1) {
                    $plural = 's';
                }
                $items .= '<item><title>Link ' . $n . '</title><description>' . $value . ' item' . $plural . ' rated (average ' . $av . ' out of 5)</description></item>';
            }
            $rss = '<rss xmlns:a10="http://www.w3.org/2005/Atom" version="2.0"> <channel> <title>Dashboard</title> <link>' . $app_url . '</link> <description /> <image> <url>' . $icon_url . '</url> <title>Dashboard</title> <link>' . $app_url . '</link> <description>' . $title . ' Dashboard</description> </image>' . $items . ' </channel> </rss>';
            header('Content-type: text/xml');
            $this->output = $rss;
        }
    }

    function onRegister() {
        // Initialise the user session
        $_SESSION['consumer_pk'] = $this->consumer->getRecordId();
        $_SESSION['tc_profile_url'] = $_POST['tc_profile_url'];
        $_SESSION['tc_profile'] = $this->consumer->profile;
        $_SESSION['return_url'] = $_POST['launch_presentation_return_url'];

        // Redirect the user to process the registration
        $this->redirectUrl = $this->dataConn->getAppUrl() . 'register.php';

    }

    function onError() {
        $msg = $this->message;
        if ($this->debugMode && !empty($this->reason)) {
            $msg = $this->reason;
        }
        $title = 'Tools';

        $this->errorOutput = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">' .
            '<html lang="en" xml:lang="en" xmlns="http://www.w3.org/1999/xhtml">' .
                '<head>' .
                    '<meta http-equiv="content-language" content="EN" />' .
                    '<meta http-equiv="content-type" content="text/html; charset=UTF-8" />' .
                    '<title>' . $title . '</title>' .
                    '<link href="css/rateit.css" media="screen" rel="stylesheet" type="text/css" />' .
                    '<script src="js/jquery.min.js" type="text/javascript"></script>' .
                    '<script src="js/jquery.rateit.min.js" type="text/javascript"></script>' .
                    '<link href="css/rating.css" media="screen" rel="stylesheet" type="text/css" />' .
                '</head>' .
                    '<body>' .
                        '<h1>Error</h1>' .
                        '<p style="font-weight: bold; color: #f00;">' . $msg . '</p>' .
                    '</body>' .
                '</html>';
    }


}