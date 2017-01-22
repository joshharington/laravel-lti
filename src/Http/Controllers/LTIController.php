<?php
/**
 * Created by PhpStorm.
 * User: jharing10
 * Date: 2017/01/17
 * Time: 10:47 AM
 */

namespace JoshHarington\LaravelLTI\Http\Controllers;


use App\Http\Controllers\Controller;

class LTIController extends Controller {

    protected $data;

    /**
     * LTIController constructor.
     */
    public function __construct() {

        $this->data = [
            'chemvantage' => [
                'launch_url' => 'https://www.chemvantage.org/lti/',
                'key' => 'custom-josh',
                'secret' => '9f9e6d87b0a10fdb536c8f1465503f84',
                'launch_data' => [
                    "user_id" => "292832126",
                    "roles" => "Instructor",
                    "resource_link_id" => "120988f929-274612",
                    "resource_link_title" => "Weekly Blog",
                    "resource_link_description" => "A weekly blog.",
                    "lis_person_name_full" => "Jane Q. Public",
                    "lis_person_name_family" => "Public",
                    "lis_person_name_given" => "Given",
                    "lis_person_contact_email_primary" => "user@school.edu",
                    "lis_person_sourcedid" => "school.edu:user",
                    "context_id" => "456434513",
                    "context_title" => "Design of Personal Environments",
                    "context_label" => "SI182",
                    "tool_consumer_instance_guid" => "lmsng.school.edu",
                    "tool_consumer_instance_description" => "University of School (LMSng)"
                ]
            ],
            'tao' => [
                'launch_url' => 'https://unisaonline.net/tao/ltiDeliveryProvider/DeliveryTool/launch',
                'key' => 'unisa',
                'secret' => '12345',
                'launch_data' => [
                    "resource_link_id" => "120988f929-274612",
                    "resource_link_title" => "Weekly Blog",
                    "resource_link_description" => "A weekly blog.",
                    "user_id" => "292832126",
                    "roles" => "Learner",  // or Learner
                    "lis_person_name_full" => 'Jane Q. Public',
                    "lis_person_name_family" => 'Public',
                    "lis_person_name_given" => 'Given',
                    "lis_person_contact_email_primary" => "user@school.edu",
                    "lis_person_sourcedid" => "school.edu:user",
                    "context_id" => "456434513",
                    "context_title" => "Design of Personal Environments",
                    "context_label" => "SI182",
                    "tool_consumer_info_product_family_code" => "ims",
                    "tool_consumer_info_version" => "1.1",
                    "tool_consumer_instance_guid" => "lmsng.school.edu",
                    "tool_consumer_instance_description" => "UNISA",
                    'launch_presentation_locale' => 'en-US',
                    'launch_presentation_document_target' => 'frame',
                    'launch_presentation_width' => '750px',
                    'launch_presentation_height' => '750px',
                    'custom_skip_thankyou' => 'true',
                    'custom_force_restart' => 'true',
                ]
            ]
        ];

    }


    public function launch($config, $launch_url = '') {

        $data = $this->data[$config];

        if($launch_url != '') {
            $launch_url = $data['launch_url'] . '/' . $launch_url;
        } else {
            $launch_url = $data['launch_url'];
        }

        $key = $data['key'];
        $secret = $data['secret'];
        $launch_data = $data['launch_data'];

        return laravel_lti()->launch($launch_url, $key, $secret, $launch_data);
    }

}