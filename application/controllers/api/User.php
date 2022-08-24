<?php

use Restserver\Libraries\REST_Controller;

defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class User extends CI_Controller
{

    use REST_Controller {
        REST_Controller::__construct as private __resTraitConstruct;
    }

    function __construct()
    {
        parent::__construct();
        $this->__resTraitConstruct();
    }

    public function users_get()
    {
        $id = $this->get('id');
        $query = $this->db->get_where('tb_user', ['id_user' => $id])->row();
        if ($query) {
            $response = [
                'value' => 1,
                'messaga' => 'User ditemukan',
                'data' => $query,
            ];
            $this->set_response($response, 200);
        } else {
            $response = [
                'value' => 1,
                'messaga' => 'User Tidak ditemukan',
            ];
            $this->set_response($response, 500);
        }
    }
    public function userByLevel_get()
    {
        $level = $this->get('level');
        $projectCode = $this->get('project_code');
        $query = $this->general->getUserByLevel($level, $projectCode);
        if ($query) {
            $response = $query;
            $this->set_response($response, 200);
        } else {
            $response = [
                'value' => 1,
                'messaga' => 'User Tidak ditemukan',
            ];
            $this->set_response($response, 500);
        }
    }

    public function antrian_get()
    {
        $projectCode = $this->get('project_code');
        $antrian = $this->general->antrian($projectCode);
        if ($antrian) {
            $response = $antrian;
            $this->set_response($response, 200);
        } else {
            $response = array(
                'value' => 2,
                'message' => "Antrian Tidak Temukan",
            );
            $this->set_response($response, 500);
        }
    }

    public function antrianLimit_get()
    {
        $projectCode = $this->get('project_code');
        $antrian = $this->general->antrian($projectCode, 3);
        if ($antrian) {
            $response = $antrian;
            $this->set_response($response, 200);
        } else {
            $response = array(
                'value' => 2,
                'message' => "Antrian Tidak Temukan",
            );
            $this->set_response($response, 500);
        }
    }

    public function name_put()
    {
        $id = $this->put('id');
        $name = $this->put('name');
        $data = [
            'user_name' => $name,
        ];
        $update = $this->general->editUser($id, $data);
        if ($update) {
            $response = [
                'value' => 1,
                'message'  => 'Berhasil',
            ];
            $this->set_response($response, 200);
        } else {
            $response = [
                'value' => 2,
                'message'  => 'Gagal',
            ];
            $this->set_response($response, 500);
        }
    }

    public function email_put()
    {
        $id = $this->put('id');
        $email = $this->put('email');
        $data = [
            'email' => $email,
        ];
        $update = $this->general->editUser($id, $data);
        if ($update) {
            $response = [
                'value' => 1,
                'message'  => 'Berhasil',
            ];
            $this->set_response($response, 200);
        } else {
            $response = [
                'value' => 2,
                'message'  => 'Gagal',
            ];
            $this->set_response($response, 500);
        }
    }

    public function setToken_put()
    {
        $id = $this->put('id');
        $token = $this->put('token');
        $data = [
            'token' => $token,
        ];
        $update = $this->general->editUser($id, $data);
        if ($update) {
            $response = [
                'value' => 1,
                'message'  => 'Berhasil',
            ];
            $this->set_response($response, 200);
        } else {
            $response = [
                'value' => 2,
                'message'  => 'Gagal',
            ];
            $this->set_response($response, 500);
        }
    }

    public function noTelp_put()
    {
        $id = $this->put('id');
        $no_telp = $this->put('no_telp');
        $data = [
            'no_telp' => $no_telp,
        ];
        $update = $this->general->editUser($id, $data);
        if ($update) {
            $response = [
                'value' => 1,
                'message'  => 'Berhasil',
            ];
            $this->set_response($response, 200);
        } else {
            $response = [
                'value' => 2,
                'message'  => 'Gagal',
            ];
            $this->set_response($response, 500);
        }
    }

    public function password_put()
    {
        $id = $this->put('id');
        $password = password_hash($this->put('password'), PASSWORD_BCRYPT);
        $data = [
            'password' => $password,
        ];
        $update = $this->general->editUser($id, $data);
        if ($update) {
            $response = [
                'value' => 1,
                'message'  => 'Berhasil',
            ];
            $this->set_response($response, 200);
        } else {
            $response = [
                'value' => 2,
                'message'  => 'Gagal',
            ];
            $this->set_response($response, 500);
        }
    }

    public function photo_post()
    {
        $id = $this->post('id');
        $response = null;
        $fileName = $_FILES['image']['name'];
        move_uploaded_file($_FILES['image']['tmp_name'], "./images/profile/" . $fileName);
        $data = [
            'photo' => $fileName,
        ];
        $update = $this->general->editUser($id, $data);
        if ($update) {
            $response = [
                'value' => 1,
                'message'  => 'Berhasil',
            ];
            $this->set_response($response, 200);
        } else {
            $response = [
                'value' => 2,
                'message'  => 'Gagal',
            ];
            $this->set_response($response, 500);
        }
    }
}
