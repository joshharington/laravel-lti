<?php
namespace JoshHarington\LaravelLTI;

use Illuminate\Http\Request;
use JoshHarington\LaravelLTI\Http\Controllers\ImportLTIToolController;

class LaravelLTI {

    public function import() {
        return view('jh.lti::layouts.tools.import');
    }

    public function launch($launch_url, $key, $secret, $launch_data = []) {


        #
        # END OF CONFIGURATION SECTION
        # ------------------------------
        $now = new \DateTime();
        $launch_data["lti_version"] = "LTI-1p0";
        $launch_data["lti_message_type"] = "basic-lti-launch-request";
        # Basic LTI uses OAuth to sign requests
        # OAuth Core 1.0 spec: http://oauth.net/core/1.0/
        $launch_data["oauth_callback"] = "about:blank";
        $launch_data["oauth_consumer_key"] = $key;
        $launch_data["oauth_version"] = "1.0";
        $launch_data["oauth_nonce"] = uniqid('', true);
        $launch_data["oauth_timestamp"] = $now->getTimestamp();
        $launch_data["oauth_signature_method"] = "HMAC-SHA1";
        # In OAuth, request parameters must be sorted by name
        $launch_data_keys = array_keys($launch_data);
        sort($launch_data_keys);
        $launch_params = array();
        foreach ($launch_data_keys as $key) {
            array_push($launch_params, $key . "=" . rawurlencode($launch_data[$key]));
        }
        $base_string = "POST&" . urlencode($launch_url) . "&" . rawurlencode(implode("&", $launch_params));
        $secret = urlencode($secret) . "&";
        $signature = base64_encode(hash_hmac("sha1", $base_string, $secret, true));

        return view('jh.lti::layouts.tools.launch', ['signature' => $signature, 'launch_url' => $launch_url, 'launch_data' => $launch_data]);
    }

    public function store_tool() {

    }

}