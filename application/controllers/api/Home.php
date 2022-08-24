<?php

use Restserver\Libraries\REST_Controller;

defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Home extends CI_Controller
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
        $noHome = $this->post('no_home');
        $typeHome = $this->post('type_home');
        $projectCode = $this->post('project_code');
        $homeId = $this->code->codeHome($projectCode);

        $data = [
            'id_home' => $homeId,
            'no_home' => $noHome,
            'type_home' => $typeHome,
            'status_home' => 1,
            'project_code' => $projectCode,
        ];

        $add = $this->db->insert('tb_home', $data);
        if ($add) {
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
        $status = $this->get('status');
        $projectCode = $this->get('project_code');

        $get = $this->general->getHome($status, $projectCode);
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
    public function limit_get()
    {
        $status = $this->get('status');
        $projectCode = $this->get('project_code');

        $get = $this->general->getHome3($status, $projectCode);
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

    public function index_put()
    {
        $id = $this->put('id');
        $noHome = $this->put('no_home');
        $typeHome = $this->put('type_home');

        $data = [
            'no_home' => $noHome,
            'type_home' => $typeHome,
        ];
        $update = $this->general->editHome($id, $data);
        if ($update) {
            $response =  [
                'value' => 1,
                'message' => "Berhasil Mengupdated",
                'data' => $data,
            ];
            $this->set_response($response, 200);
        } else {
            $response =  [
                'value' => 2,
                'message' => "Gagal",
            ];
            $this->set_response($response, 500);
        }
    }

    public function index_delete()
    {
        $id = $this->delete('id');

        $delete = $this->general->deleteHome($id);
        if ($delete) {
            $response =  [
                'value' => 1,
                'message' => "Berhasil",
                'id' => $id,
            ];
            $this->set_response($response, 200);
        } else {
            $response =  [
                'value' => 2,
                'message' => "Gagal",
            ];
            $this->set_response($response, 500);
        }
    }

    public function count_get()
    {
        $projectCode = $this->get('project_code');

        $response = null;

        $getAvailable = $this->general->countHome('1', $projectCode);
        $getReservation = $this->general->countHome('2', $projectCode);
        $getBooking = $this->general->countHome('3', $projectCode);
        $getSold = $this->general->countHome('4', $projectCode);

        if ($getAvailable || $getReservation || $getBooking || $getSold) {
            $response = [
                'available' => $getAvailable,
                'reservation' => $getReservation,
                'booking' => $getBooking,
                'sold' => $getSold,
            ];
            $this->set_response($response, 200);
        }
    }
}
