<?php

use Restserver\Libraries\REST_Controller;

defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Project extends CI_Controller
{

    use REST_Controller {
        REST_Controller::__construct as private __resTraitConstruct;
    }

    function __construct()
    {
        parent::__construct();
        $this->__resTraitConstruct();
    }

    public function index_get()
    {
        $code = $this->get('code');
        if ($code === null) {
            $project = $this->project->getProject();
        } else {
            $project = $this->project->getProject($code);
        }

        if ($project) {
            $response = [
                'value' => 1,
                'message' => 'Project Ditemukan',
                'data' => $project,
            ];
            $this->set_response($response, 200);
        } else {
            $response = [
                'value' => 2,
                'message' => 'Project Tidak Ditemukan',
            ];
            $this->set_response($response, 500);
        }
    }

    public function add_post()
    {
        $code_project = $this->input->post('code_project');
        $name_project = $this->input->post('name_project');
        $unist = $this->input->post('units');
        $remaining_units = $this->input->post('remaining_units');
        $code_markom = $this->code->generateString(5);
        $code_sales = $this->code->generateString(5);
        $code_owner = $this->code->generateString(5);
        $data = [
            'code_project' => $code_project,
            'name_project' => $name_project,
            'units' => $unist,
            'remaining_units' => $remaining_units,
            'code_markom' => $code_markom,
            'code_sales' => $code_sales,
            'code_owner' => $code_owner,
            'create_date' => date('Y-m-d H:i:s'),
            'update_date' => date('Y-m-d H:i:s'),
        ];
        $add = $this->db->insert('tb_project', $data);

        if ($add) {
            $response = [
                'value' => 1,
                'message' => "Berhasil",
                'data' => $data,
            ];
            $this->set_response($response, 200);
        } else {
            $response = [
                'value' => 2,
                'message' => "Gagal",
            ];
            $this->set_response($response, 500);
        }
    }

}
