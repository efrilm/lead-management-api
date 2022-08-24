<?php

use Restserver\Libraries\REST_Controller;

defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Tracking extends CI_Controller
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
        $leadId = $this->post('id_lead');
        $userId = $this->post('id_user');
        $note = $this->post('note');
        $project_code = $this->post('project_code');

        $id_tracking = $this->code->codeTracking($project_code);
        $data = array(
            'id_tracking' => $id_tracking,
            'lead_id' => $leadId,
            'user_id' => $userId,
            'note' => $note,
            'create_date' => date('Y-m-d H:i:s'),
            'status' => 1,
        );
        $add = $this->db->insert('tb_tracking', $data);
        if ($add) {
            $dataLead = [
                'note' => $note,
            ];
            $this->general->editLead($leadId, $dataLead);
            $response = [
                'value' => 1,
                'message' => 'Berhasil ditambahkan',
                'data' => $data,
            ];
            $this->set_response($response, 200);
        } else {
            $response = [
                'value' => 1,
                'message' => 'Gagal ditambahkan',
            ];
            $this->set_response($response, 500);
        }
    }

    public function index_get()
    {
        $id = $this->get('id');

        $get = $this->general->getTracking($id);
        if ($get) {
            $response = $get;
            $this->set_response($response, 200);
        } else {
            $response =  [
                'message' => "tidak ditemukan",
            ];
            $this->set_response($response, 500);
        }
    }
}
