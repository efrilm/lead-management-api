<?php

use Restserver\Libraries\REST_Controller;

defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Sales extends CI_Controller
{

    use REST_Controller {
        REST_Controller::__construct as private __resTraitConstruct;
    }

    function __construct()
    {
        parent::__construct();
        $this->__resTraitConstruct();
    }


    public function antrian_get()
    {
        $projectCode = $this->get('project_code');
        $antrian = $this->general->antrian($projectCode);
        if ($antrian) {
            $response = array(
                'value' => 1,
                'message' => "Antrian di Temukan",
                'data' => $antrian,
            );
            $this->set_response($response, 200);
        } else {
            $response = array(
                'value' => 2,
                'message' => "Antrian Tidak Temukan",
            );
            $this->set_response($response, 500);
        }
    }

    public function sales_get()
    {
        $project_code = $this->get('project_code');
        if ($project_code === null) {
            $sales = $this->general->sales();
        } else {
            $sales = $this->general->sales($project_code);
        }
        if ($sales) {
            $response = [
                'value' => 1,
                'message' => 'data sales ditemukan',
                'data' => $sales,
            ];
            $this->set_response($response, 200);
        } else {
            $response = [
                'value' => 2,
                'message' => 'data sales Tidak ditemukan',
            ];
            $this->set_response($response, 500);
        }
    }

    public function lead_get()
    {
        $idSales = $this->get('id');
        $projectCode = $this->get('project_code');
        $status = $this->get('status');

        $lead =  $this->general->leadSales($idSales, $status, $projectCode);
        if ($lead) {
            $response = $lead;
            $this->set_response($response, 200);
        } else {
            $response = [
                'value' => 2,
                'message' => 'Tidak Ada Data',
            ];
            $this->set_response($response, 500);
        }
    }

    public function leadLimit_get()
    {
        $idSales = $this->get('id');
        $projectCode = $this->get('project_code');

        $lead =  $this->general->leadLimitSales($idSales, $projectCode);
        if ($lead) {
            $response = $lead;
            $this->set_response($response, 200);
        } else {
            $response = [
                'value' => 2,
                'message' => 'Tidak Ada Data',
            ];
            $this->set_response($response, 500);
        }
    }

    public function leadAndHome_get()
    {
        $idSales = $this->get('id');
        $projectCode = $this->get('project_code');
        $status = $this->get('status');

        $lead =  $this->general->leadAndHomeSales($idSales, $status, $projectCode);
        if ($lead) {
            $response = $lead;
            $this->set_response($response, 200);
        } else {
            $response = [
                'value' => 2,
                'message' => 'Tidak Ada Data',
            ];
            $this->set_response($response, 500);
        }
    }

    public function leadPm_get()
    {
        $id = $this->get('id');
        $projectCode = $this->get('project_code');
        $status = '6';
        $paymentMethod = $this->get('payment_method');

        $lead =  $this->general->leadPmSales($id, $status, $projectCode, $paymentMethod);
        if ($lead) {
            $response = $lead;
            $this->set_response($response, 200);
        } else {
            $response = [
                'value' => 2,
                'message' => 'Tidak Ada Data',
            ];
            $this->set_response($response, 500);
        }
    }

    public function visit_get()
    {
        $idSales = $this->get('id');
        $projectCode = $this->get('project_code');
        $status = $this->get('status');

        $visit =  $this->general->getVisitSales($idSales, $status, $projectCode);
        if ($visit) {
            $response = $visit;
            $this->set_response($response, 200);
        } else {
            $response = [
                'value' => 2,
                'message' => 'Tidak Ada Data',
            ];
            $this->set_response($response, 500);
        }
    }

    public function count_get()
    {
        $salesId = $this->get('sales_id');
        $projectCode = $this->get('project_code');

        $getDaily = $this->general->countLeadDaySales($salesId, $projectCode);
        $getWeekly = $this->general->countLeadWeekSales($salesId, $projectCode);
        $getMonthly = $this->general->countLeadMonthlySales($salesId, $projectCode);

        $response = null;

        if ($getDaily || $getWeekly || $getMonthly) {
            $response = [
                'daily' => $getDaily,
                'weekly' => $getWeekly,
                'monthly' => $getMonthly,
            ];

            $this->set_response($response, 200);
        }
    }
}
