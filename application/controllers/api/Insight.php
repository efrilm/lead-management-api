<?php

use Restserver\Libraries\REST_Controller;

defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Insight extends CI_Controller
{

    use REST_Controller {
        REST_Controller::__construct as private __resTraitConstruct;
    }

    function __construct()
    {
        parent::__construct();
        $this->__resTraitConstruct();
    }

    public function day_get()
    {
        $projectCode = $this->get('project_code');

        $get = $this->general->getInsightDaily($projectCode);

        $response = null;

        if ($get) {
            $response = $get;

            $this->set_response($response, 200);
        } else {
            $response = [
                'value' => 1,
                'message' => 'Data tidak ditemukan',
            ];
            $this->set_response($response, 500);
        }
    }
    public function week_get()
    {
        $projectCode = $this->get('project_code');

        $get = $this->general->getInsightWeekly($projectCode);

        $response = null;

        if ($get) {
            $response = $get;

            $this->set_response($response, 200);
        } else {
            $response = [
                'value' => 1,
                'message' => 'Data tidak ditemukan',
            ];
            $this->set_response($response, 500);
        }
    }

    public function month_get()
    {
        $projectCode = $this->get('project_code');

        $get = $this->general->getInsightMonthly($projectCode);

        $response = null;

        if ($get) {
            $response = $get;

            $this->set_response($response, 200);
        } else {
            $response = [
                'value' => 1,
                'message' => 'Data tidak ditemukan',
            ];
            $this->set_response($response, 500);
        }
    }

    public function daySales_get()
    {
        $id = $this->get('id');
        $projectCode = $this->get('project_code');

        $get = $this->general->getInsightDailySales($id, $projectCode);

        $response = null;

        if ($get) {
            $response = $get;

            $this->set_response($response, 200);
        } else {
            $response = [
                'value' => 1,
                'message' => 'Data tidak ditemukan',
            ];
            $this->set_response($response, 500);
        }
    }
    public function weekSales_get()
    {
        $id = $this->get('id');
        $projectCode = $this->get('project_code');

        $get = $this->general->getInsightWeeklySales($id, $projectCode);

        $response = null;

        if ($get) {
            $response = $get;

            $this->set_response($response, 200);
        } else {
            $response = [
                'value' => 1,
                'message' => 'Data tidak ditemukan',
            ];
            $this->set_response($response, 500);
        }
    }
    public function monthSales_get()
    {
        $id = $this->get('id');
        $projectCode = $this->get('project_code');

        $get = $this->general->getInsightMonthlySales($id, $projectCode);

        $response = null;

        if ($get) {
            $response = $get;

            $this->set_response($response, 200);
        } else {
            $response = [
                'value' => 1,
                'message' => 'Data tidak ditemukan',
            ];
            $this->set_response($response, 500);
        }
    }

    public function dayMarkom_get()
    {
        $id = $this->get('id');
        $projectCode = $this->get('project_code');

        $get = $this->general->getInsightDailyMarkom($id, $projectCode);

        $response = null;

        if ($get) {
            $response = $get;

            $this->set_response($response, 200);
        } else {
            $response = [
                'value' => 1,
                'message' => 'Data tidak ditemukan',
            ];
            $this->set_response($response, 500);
        }
    }
    public function weekMarkom_get()
    {
        $id = $this->get('id');
        $projectCode = $this->get('project_code');

        $get = $this->general->getInsightWeeklyMarkom($id, $projectCode);

        $response = null;

        if ($get) {
            $response = $get;

            $this->set_response($response, 200);
        } else {
            $response = [
                'value' => 1,
                'message' => 'Data tidak ditemukan',
            ];
            $this->set_response($response, 500);
        }
    }
    public function monthMarkom_get()
    {
        $id = $this->get('id');
        $projectCode = $this->get('project_code');

        $get = $this->general->getInsightMonthlyMarkom($id, $projectCode);

        $response = null;

        if ($get) {
            $response = $get;

            $this->set_response($response, 200);
        } else {
            $response = [
                'value' => 1,
                'message' => 'Data tidak ditemukan',
            ];
            $this->set_response($response, 500);
        }
    }
}
