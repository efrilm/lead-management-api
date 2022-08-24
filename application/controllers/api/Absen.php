<?php

use Restserver\Libraries\REST_Controller;

defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Absen extends CI_Controller
{

    use REST_Controller {
        REST_Controller::__construct as private __resTraitConstruct;
    }

    function __construct()
    {
        parent::__construct();
        $this->__resTraitConstruct();
    }

    public function index_post()
    {
        $note = $this->post('note');
        $status = $this->post('status');
        $userId = $this->post('user_id');
        $fileName = $_FILES['image']['name'];
        $projectCode = $this->post('project_code');

        $response = null;
        move_uploaded_file($_FILES['image']['tmp_name'], "./images/absen/" . $fileName);

        $data = [
            'note' => $note,
            'image' => $fileName,
            'date' => date('Y-m-d H:i:s'),
            'status' => $status,
            'user_id' =>  $userId,
            'project_code'  => $projectCode,
        ];
        $add = $this->db->insert('tb_absent', $data);

        if ($add) {
            $response = [
                'value' => 1,
                'message' => 'Berhasil',
                'data' => $data,
            ];
            $this->set_response($response, 200);
        } else {
            $response = [
                'value' => 2,
                'message' => 'Gagal',
            ];
            $this->set_response($response, 500);
        }
    }

    public function index_get()
    {
        $projectCode = $this->get('project_code');
        $get = $this->general->getAbsen($projectCode);

        if ($get) {
            $response = $get;
            $this->set_response($response, 200);
        } else {
            $response = [
                'value' => 2,
                'message' => 'Data Tidak Ditemukan',
            ];
            $this->set_response($response, 500);
        }
    }

    public function today_get()
    {
        $projectCode = $this->get('project_code');
        $get = $this->general->getAbsenToday($projectCode);

        if ($get) {
            $response = $get;
            $this->set_response($response, 200);
        } else {
            $response = [
                'value' => 2,
                'message' => 'Data Tidak Ditemukan',
            ];
            $this->set_response($response, 500);
        }
    }
}
