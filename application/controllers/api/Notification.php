<?php

use Restserver\Libraries\REST_Controller;

defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Notification extends CI_Controller
{

    use REST_Controller {
        REST_Controller::__construct as private __resTraitConstruct;
    }

    function __construct()
    {
        parent::__construct();
        $this->__resTraitConstruct();
    }

    public function absen_get()
    {
        $id = $this->get('id');
        $notifId  = $this->get('notif_id');
        $restApiKey = $this->get('rest_api_key');
        $getUser = $this->general->getUser($id);
        $name = $getUser->user_name;

        $heading      = array(
            "en" => "Selamat Pagi, $name"
        );

        $content      = array(
            "en" => "Berikan Yang Terbaik"
        );

        $fields = array(
            'app_id' => $notifId,
            'included_segments' => array(
                'Subscribed Users'
            ),
            'data' => array(
                "foo" => "bar"
            ),
            'contents' => $content,
            'headings' => $heading,
        );

        $fields = json_encode($fields);
        print("\nJSON sent:\n");
        print($fields);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json; charset=utf-8',
            'Authorization: Basic ' . $restApiKey,
        ));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_POST, TRUE);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

        $response = curl_exec($ch);
        curl_close($ch);

        return $response;
    }

    public function pamit_get()
    {
        $id = $this->get('id');
        $notifId  = $this->get('notif_id');
        $restApiKey = $this->get('rest_api_key');
        $getUser = $this->general->getUser($id);
        $name = $getUser->user_name;

        $heading      = array(
            "en" => "Pamit, $name"
        );

        $content      = array(
            "en" => "Terima Kasih!"
        );

        $fields = array(
            'app_id' => $notifId,
            'included_segments' => array(
                'Subscribed Users'
            ),
            'data' => array(
                "foo" => "bar"
            ),
            'contents' => $content,
            'headings' => $heading,
        );

        $fields = json_encode($fields);
        print("\nJSON sent:\n");
        print($fields);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json; charset=utf-8',
            'Authorization: Basic ' . $restApiKey,
        ));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_POST, TRUE);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

        $response = curl_exec($ch);
        curl_close($ch);

        return $response;
    }

    public function lead_get()
    {
        $id = $this->get('id');
        $notifId = $this->get('notif_id');

        // cari di id user
        $user = $this->general->getUser($id);
        $token = $user->token;

        $headings = array(
            "en" => 'Ada Lead nih!'
        );

        $content = array(
            "en" => "Segera Follow Up dan Berikan Yang Terbaik",
        );


        $fields = array(
            'app_id' => $notifId,
            'include_player_ids' => array($token),
            'data' => array("foo" => "bar"),
            'contents' => $content,
            "headings" => $headings,
        );

        $fields = json_encode($fields);
        print("\nJSON sent:\n");
        print($fields);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_POST, TRUE);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

        $response = curl_exec($ch);
        curl_close($ch);

        return $response;
    }

    public function followUp_get()
    {
        $id = $this->get('id');
        $salesId = $this->get('sales_id');
        $notifId = $this->get('notif_id');

        // cari di id user
        $user = $this->general->getUser($id);
        $token = $user->token;

        // Get Sales 
        $sales = $this->general->getUser($salesId);
        $name = $sales->user_name;

        $headings = array(
            "en" => 'Follow Up!'
        );

        $content = array(
            "en" => "Lead Yang Anda Berikan Kepada $name Sudah di Follow Up dan Jangan Lupa di Cek Ya",
        );


        $fields = array(
            'app_id' => $notifId,
            'include_player_ids' => array($token),
            'data' => array("foo" => "bar"),
            'contents' => $content,
            "headings" => $headings,
        );

        $fields = json_encode($fields);
        print("\nJSON sent:\n");
        print($fields);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_POST, TRUE);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

        $response = curl_exec($ch);
        curl_close($ch);

        return $response;
    }

    public function visit_get()
    {
        $id = $this->get('id');
        $notifId  = $this->get('notif_id');
        $restApiKey = $this->get('rest_api_key');
        $getUser = $this->general->getUser($id);
        $name = $getUser->user_name;

        $heading      = array(
            "en" => "Tamu yang akan visit"
        );

        $content      = array(
            "en" => "Dari $name sudah dijadwalkan"
        );

        $fields = array(
            'app_id' => $notifId,
            'included_segments' => array(
                'Subscribed Users'
            ),
            'data' => array(
                "foo" => "bar"
            ),
            'contents' => $content,
            'headings' => $heading,
        );

        $fields = json_encode($fields);
        print("\nJSON sent:\n");
        print($fields);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json; charset=utf-8',
            'Authorization: Basic ' . $restApiKey,
        ));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_POST, TRUE);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

        $response = curl_exec($ch);
        curl_close($ch);

        return $response;
    }

    public function alreadyVisit_get()
    {
        $id = $this->get('id');
        $notifId  = $this->get('notif_id');
        $restApiKey = $this->get('rest_api_key');
        $getUser = $this->general->getUser($id);
        $name = $getUser->user_name;

        $heading      = array(
            "en" => "Tamu sudah datang"
        );

        $content      = array(
            "en" => "Dari $name"
        );

        $fields = array(
            'app_id' => $notifId,
            'included_segments' => array(
                'Subscribed Users'
            ),
            'data' => array(
                "foo" => "bar"
            ),
            'contents' => $content,
            'headings' => $heading,
        );

        $fields = json_encode($fields);
        print("\nJSON sent:\n");
        print($fields);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json; charset=utf-8',
            'Authorization: Basic ' . $restApiKey,
        ));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_POST, TRUE);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

        $response = curl_exec($ch);
        curl_close($ch);

        return $response;
    }

    public function reservation_get()
    {
        $id = $this->get('id');
        $notifId  = $this->get('notif_id');
        $restApiKey = $this->get('rest_api_key');
        $getUser = $this->general->getUser($id);
        $name = $getUser->user_name;

        $heading      = array(
            "en" => "Ada yang reservasi nih dari $name"
        );

        $content      = array(
            "en" => "Jangan lupa ucapkan selamat ya!"
        );

        $fields = array(
            'app_id' => $notifId,
            'included_segments' => array(
                'Subscribed Users'
            ),
            'data' => array(
                "foo" => "bar"
            ),
            'contents' => $content,
            'headings' => $heading,
        );

        $fields = json_encode($fields);
        print("\nJSON sent:\n");
        print($fields);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json; charset=utf-8',
            'Authorization: Basic ' . $restApiKey,
        ));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_POST, TRUE);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

        $response = curl_exec($ch);
        curl_close($ch);

        return $response;
    }

    public function booking_get()
    {
        $id = $this->get('id');
        $notifId  = $this->get('notif_id');
        $restApiKey = $this->get('rest_api_key');
        $getUser = $this->general->getUser($id);
        $name = $getUser->user_name;

        $heading      = array(
            "en" => "Ada yang booking nih dari $name"
        );

        $content      = array(
            "en" => "Jangan lupa ucapkan selamat ya!"
        );

        $fields = array(
            'app_id' => $notifId,
            'included_segments' => array(
                'Subscribed Users'
            ),
            'data' => array(
                "foo" => "bar"
            ),
            'contents' => $content,
            'headings' => $heading,
        );

        $fields = json_encode($fields);
        print("\nJSON sent:\n");
        print($fields);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json; charset=utf-8',
            'Authorization: Basic ' . $restApiKey,
        ));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_POST, TRUE);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

        $response = curl_exec($ch);
        curl_close($ch);

        return $response;
    }

    public function sold_get()
    {
        $id = $this->get('id');
        $notifId  = $this->get('notif_id');
        $restApiKey = $this->get('rest_api_key');
        $getUser = $this->general->getUser($id);
        $name = $getUser->user_name;

        $heading      = array(
            "en" => "Ada yang akad nih dari $name"
        );

        $content      = array(
            "en" => "Jangan lupa ucapkan selamat ya!"
        );

        $fields = array(
            'app_id' => $notifId,
            'included_segments' => array(
                'Subscribed Users'
            ),
            'data' => array(
                "foo" => "bar"
            ),
            'contents' => $content,
            'headings' => $heading,
        );

        $fields = json_encode($fields);
        print("\nJSON sent:\n");
        print($fields);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json; charset=utf-8',
            'Authorization: Basic ' . $restApiKey,
        ));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_POST, TRUE);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

        $response = curl_exec($ch);
        curl_close($ch);

        return $response;
    }
}
