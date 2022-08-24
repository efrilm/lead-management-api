<?php

use Restserver\Libraries\REST_Controller;

defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Auth extends CI_Controller
{

    use REST_Controller {
        REST_Controller::__construct as private __resTraitConstruct;
    }

    function __construct()
    {
        parent::__construct();
        $this->__resTraitConstruct();
    }

    public function signin_post()
    {
        $email = $this->input->post('email');
        $password = $this->input->post('password');
        $code = $this->input->post('code');
        $response = null;
        // Jika User Ditemukan
        $user = $this->db->get_where('tb_user', ['email' => $email, 'project_code' => $code,])->row();
        if ($user) {
            if ($user->active == 1) {
                if (password_verify($password, $user->password)) {
                    $data = [
                        'id_user' => $user->id_user,
                        'project_code' => $user->project_code,
                        'email' => $user->email,
                        'user_name' => $user->user_name,
                        'level' => $user->level,
                    ];
                    if ($user->level == 1) {
                        $response = array(
                            'value' => 1,
                            'position' => 'Sales',
                            'message' => "Login Berhasil Sebagai Sales",
                            'data' => $data,
                        );
                        $this->set_response($response, 200);
                    } else if ($user->level == 2) {
                        $response = array(
                            'value' => 1,
                            'position' => 'Markom',
                            'message' => "Login Berhasil Sebagai Markom",
                            'data' => $data,
                        );
                        $this->set_response($response, 200);
                    } else if ($user->level ==  3) {
                        $response = array(
                            'value' => 1,
                            'position' => 'Owner',
                            'message' => "Login Berhasil Sebagai Owner",
                            'data' => $data,
                        );
                        $this->set_response($response, 200);
                    }
                } else {
                    $response = [
                        'value' => 2,
                        'message' => 'Password Salah',
                    ];
                    $this->set_response($response, 500);
                }
            } else {
                $response = [
                    'value' => 3,
                    'message' => 'Email Belum Aktif',
                ];
                $this->set_response($response, 500);
            }
        } else {
            $response = [
                'value' => 4,
                'message' => 'Email Belum Terdaftar',
            ];
            $this->set_response($response, 500);
        }
    }

    public function signup_post()
    {
        $user_name = $this->input->post('user_name');
        $email = $this->input->post('email');
        $password = password_hash($this->input->post('password'), PASSWORD_BCRYPT);
        $no_telp = $this->input->post('no_telp');
        $address = $this->input->post('address');
        $project_code = $this->input->post('project_code');
        $level = $this->input->post('level');
        $idUser = $this->code->codeUser();
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
                'is_sales' => 1,
                'active' => 1,
                'level' => $level,
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
                    'value' => 2,
                    'message' => 'Gagal Mendaftar',
                    'data' => $data,
                );
                $this->set_response($response, 500);
            }
        }
    }

    public function codeProject_post()
    {
        $code = $this->input->post('code_project');
        $codeUser = $this->input->post('code_user');
        $check = $this->general->checkCode($code);
        if ($check[0]['code_markom'] == $codeUser) {
            $response = [
                'value' => 1,
                'message' => "Kode Markom Ditemukan",
                'data' => $check,
            ];
            $this->set_response($response, 200);
        } else if ($check[0]['code_sales'] == $codeUser) {
            $response = [
                'value' => 2,
                'message' => "Kode sales Ditemukan",
                'data' => $check,
            ];
            $this->set_response($response, 200);
        } else if ($check[0]['code_owner'] == $codeUser) {
            $response = [
                'value' => 3,
                'message' => "Kode owner Ditemukan",
                'data' => $check,
            ];
            $this->set_response($response, 200);
        } else {
            $response = [
                'value' => 4,
                'message' => "Kode Yang Ada Masukkan Salah",
                'data' => $check,
            ];
            $this->set_response($response, 500);
        }
    }
}
