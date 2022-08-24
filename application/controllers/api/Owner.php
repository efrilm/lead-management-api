<?php

use Restserver\Libraries\REST_Controller;

defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Owner extends CI_Controller
{

    use REST_Controller {
        REST_Controller::__construct as private __resTraitConstruct;
    }

    function __construct()
    {
        parent::__construct();
        $this->__resTraitConstruct();
    }

    public function omset_get()
    {
        $projectCode = $this->get('project_code');

        $get =  $this->general->getOmset($projectCode);
        if ($get) {
            $response = $get;
            $this->set_response($response, 200);
        } else {
            $response = [
                'value' => 2,
                'message' => 'Tidak Ada Data',
            ];
            $this->set_response($response, 500);
        }
    }

    public function add_post()
    {
        $user_name = $this->input->post('user_name');
        $email = $this->input->post('email');
        $password = password_hash($this->input->post('password'), PASSWORD_BCRYPT);
        $no_telp = $this->input->post('no_telp');
        $address = $this->input->post('address');
        $project_code = $this->input->post('project_code');
        $idUser = $this->code->codeMarkom();
        $response =  null;

        $check = $this->db->get_where('tb_user', ['email' => $email])->row();
        if ($check) {
            $response = array(
                'value' => 2,
                'message' => 'Email Sudah Terdaftar',
                'email' => $check->email,
            );
            $this->set_response($response, 500);
        } else {
            $data = array(
                'id_user' => $idUser,
                'user_name' => $user_name,
                'email' => $email,
                'password' => $password,
                'no_telp' => $no_telp,
                'address' => $address,
                'create_date' => date('Y-m-d H:i:s'),
                'update_date' => date('Y-m-d H:i:s'),
                'photo' => "default.png",
                'is_sales' => 0,
                'active' => 1,
                'level' => 3,
                'project_code' => $project_code,
            );
            $add = $this->db->insert('tb_user', $data);
            if ($add) {
                $response = array(
                    'value' => 1,
                    'message' => 'Berhasil Mendaftar',
                    'data' => $data,
                );
                $this->set_response($response, 200);
            } else {
                $response = array(
                    'value' => 1,
                    'message' => 'Gagal Mendaftar',
                    'data' => $data,
                );
                $this->set_response($response, 500);
            }
        }
    }

    public function leadAndHome_get()
    {
        $projectCode = $this->get('project_code');
        $status = $this->get('status');

        $lead =  $this->general->leadAndHome(
            $status,
            $projectCode
        );
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

    public function lead_get()
    {
        $projectCode = $this->get('project_code');
        $status = $this->get('status');

        $lead =  $this->general->lead($status, $projectCode);
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
        $projectCode = $this->get('project_code');

        $lead =  $this->general->leadLimit($projectCode);
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

    public function leadPM_get()
    {
        $projectCode = $this->get('project_code');
        $status = '6';
        $paymentMethod = $this->get('payment_method');

        $lead =  $this->general->leadPm($status, $projectCode, $paymentMethod);
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
        $projectCode = $this->get('project_code');
        $status = $this->get('status');

        $visit =  $this->general->getVisit($status, $projectCode);
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
}
