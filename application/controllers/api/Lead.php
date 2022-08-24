<?php

use Restserver\Libraries\REST_Controller;

defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Lead extends CI_Controller
{

    use REST_Controller {
        REST_Controller::__construct as private __resTraitConstruct;
    }

    function __construct()
    {
        parent::__construct();
        $this->__resTraitConstruct();
    }

    public function fee_get()
    {
        $id =  $this->get('id');
        $get = $this->general->getFee($id);
        if ($get) {
            $response = $get;
            $this->set_response($response, 200);
        } else {
            $response = [
                'value' => 2,
                'message' => 'Gagal ditambahkan',
            ];
            $this->set_response($response, 500);
        }
    }

    public function payment_get()
    {
        $id =  $this->get('id');
        $get = $this->general->getPayment($id);
        if ($get) {
            $response = $get;
            $this->set_response($response, 200);
        } else {
            $response = [
                'value' => 2,
                'message' => 'Gagal ditambahkan',
            ];
            $this->set_response($response, 500);
        }
    }

    public function count_get()
    {
        $projectCode = $this->get('project_code');
        $response = null;
        $getDaily = $this->general->countLeadDay($projectCode);
        $getWeekly = $this->general->countLeadWeek($projectCode);
        $getmonthly = $this->general->countLeadMonth($projectCode);
        if ($getDaily || $getWeekly || $getmonthly) {
            $response = [
                'daily' => $getDaily,
                'weekly' => $getWeekly,
                'monthly' => $getmonthly,
            ];
            $this->set_response($response, 200);
        }
    }

    public function add_post()
    {
        $full_name = $this->input->post('full_name');
        $no_whatsapp = $this->input->post('no_whatsapp');
        $address = $this->input->post('address');
        $note = $this->input->post('note');
        $sales_id = $this->input->post('sales_id');
        $markom_id = $this->input->post('markom_id');
        $project_code = $this->input->post('project_code');
        $source = $this->input->post('source');
        $id_lead = $this->code->codeLead($project_code);
        $data = array(
            'id_lead' => $id_lead,
            'full_name' => $full_name,
            'no_whatsapp' => $no_whatsapp,
            'address' => $address,
            'note' => $note,
            'source' => $source,
            'sales_id' => $sales_id,
            'markom_id' => $markom_id,
            'project_code' => $project_code,
            'date_add' => date('Y-m-d H:i:s'),
            'update_date' => date('Y-m-d H:i:s'),
            'day' => date('Y-m-d'),
            'status' => '1',
        );
        $add = $this->db->insert('tb_lead', $data);
        if ($add) {
            $dataTrack = array(
                'id_tracking' => $this->code->codeTracking($project_code),
                'lead_id' => $id_lead,
                'user_id' => $markom_id,
                'note' => $note,
                'create_date' => date('Y-m-d H:i:s'),
                'status' => 1,
            );
            $addTrack = $this->db->insert('tb_tracking', $dataTrack);
            $updateSales = $this->db->update('tb_user', ['update_date' => date('Y-m-d H:i:s')], ['id_user' => $sales_id]);
            $dataDate = array(
                'lead_id'  => $id_lead,
                'date_add' => date('Y-m-d H:i:s'),
            );
            $addDate = $this->db->insert('tb_date', $dataDate);
            $response = [
                'value' => 1,
                'message' => 'Berhasil di tambahkan',
                'tracking' => $dataTrack,
                'date' => $dataDate,
                'lead' => $data,
                'updateSales' => $updateSales,
            ];
            $this->set_response($response, 200);
        } else {
            $response = [
                'value' => 2,
                'message' => 'Gagal ditambahkan',
            ];
            $this->set_response($response, 500);
        }
    }

    public function date_get()
    {
        $id  = $this->get('id');
        $get = $this->general->getDate($id);
        if ($get) {
            $response = $get;
            $this->set_response($response, 200);
        } else {
            $response = [
                'message' => "Gagal",
            ];

            $this->set_response($response, 500);
        }
    }

    function editLead_put()
    {
        $id = $this->put('id');
        $full_name = $this->put('full_name');
        $no_whatsapp = $this->put('no_whatsapp');
        $address = $this->put('address');
        $note = $this->put('note');
        $source = $this->put('source');

        $data = array(
            'full_name' => $full_name,
            'no_whatsapp' => $no_whatsapp,
            'address' => $address,
            'note' => $note,
            'source' => $source,
        );

        $update = $this->general->editLead($id, $data);
        if ($update) {
            $response = [
                'value' => 1,
                'message' => 'Berhasil di update',
                'id' => $id,
                'data' => $data,
            ];
            $this->set_response($response, 200);
        } else {
            $response = [
                'value' => 2,
                'message' => 'Gagal di update',
            ];
            $this->set_response($response, 500);
        }
    }

    public function deleteLead_delete()
    {
        $id = $this->delete('id');
        $delete = $this->general->deleteLead($id);
        if ($delete) {
            $response = [
                'value' => 1,
                'message' => 'Berhasil di hapus',
                'id' => $id,
            ];
            $this->set_response($response, 200);
        } else {
            $response = [
                'value' => 2,
                'message' => 'Gagal di hapus',
            ];
            $this->set_response($response, 500);
        }
    }

    public function addFollowUp_put()
    {
        $id = $this->put('id');
        $note = $this->put('note');
        $id_sales = $this->put('sales_id');
        $project_code = $this->put('project_code');
        $id_tracking = $this->code->codeTracking($project_code);
        $data = array(
            'note' => $note,
            'status' => '2',
            'update_date' => date('Y-m-d H:i:s'),
        );
        $update = $this->general->editLead($id, $data);
        if ($update) {
            $dataTrack = array(
                'id_tracking' => $id_tracking,
                'lead_id' => $id,
                'user_id' => $id_sales,
                'note' => $note,
                'create_date' => date('Y-m-d H:i:s'),
                'status' => 1,
            );
            $addTrack = $this->db->insert('tb_tracking', $dataTrack);
            $dataDate = array(
                'date_follow_up' => date('Y-m-d H:i:s'),
            );
            $addDate = $this->general->editDate($id, $dataDate);

            $response = [
                'value' => 1,
                'message' => 'Berhasil di update',
                'lead_id' => $id,
                'sales_id' => $id_sales,
                'project_code' => $project_code,
                'data'  => array(
                    'lead' => $data,
                    'tracking' => $dataTrack,
                    'date' => $dataDate,
                ),
            ];
            $this->set_response($response, 200);
        } else {
            $response = [
                'value' => 1,
                'message' => 'Gagal di update',
            ];
            $this->set_response($response, 500);
        }
    }

    public function addVisit_post()
    {
        $id = $this->post('id');
        $date_visit = $this->post('date_visit');
        $note = $this->post('note');
        $id_user = $this->post('id_user');
        $project_code = $this->post('project_code');
        $id_tracking = $this->code->codeTracking($project_code);
        $id_visit = $this->code->codeVisit($project_code);
        $data = array(
            'id_visit' => $id_visit,
            'lead_id' => $id,
            'visit_date' => $date_visit,
            'note' => $note,
            'create_date' => date('Y-m-d H:i:s'),
            'update_date' => date('Y-m-d H:i:s'),
            'status_visit' => '1',
            'project_code' => $project_code,
        );
        $add = $this->general->addVisit($data);
        if ($add) {
            $dataLead = [
                'note' => $note,
                'status' => '3',
            ];
            $updateLead = $this->general->editLead($id, $dataLead);
            $dataTrack = array(
                'id_tracking' => $id_tracking,
                'lead_id' => $id,
                'user_id' => $id_user,
                'note' => $note,
                'create_date' => date('Y-m-d H:i:s'),
                'status' => 1,
            );
            $addTrack = $this->db->insert('tb_tracking', $dataTrack);
            $dataDate = array(
                'date_will_visit' => date('Y-m-d H:i:s'),
            );
            $addDate = $this->general->editDate($id, $dataDate);

            $response = [
                'value' => 1,
                'message' => 'Berhasil di Tambahkan',
                'lead_id' => $id,
                'visit_id' => $id_visit,
                'data' => [
                    'visit' => $data,
                    'lead' => $dataLead,
                    'tracking' => $dataTrack,
                    'date' => $dataDate,
                ],
            ];
            $this->set_response($response, 200);
        }
    }

    public function addAlreadyVisit_put()
    {
        $id = $this->put('id');
        $lead_id = $this->put('id_lead');
        $id_user = $this->put('id_user');
        $project_code = $this->put('project_code');
        $id_tracking = $this->code->codeTracking($project_code);
        $note = 'Lead Telah Visit';
        $data = [
            'status_visit' => '2',
            'note' => $note,
            'update_date' => date('Y-m-d H:i:s'),
        ];
        $update = $this->general->editVisit($id, $data);
        if ($update) {
            $dataTrack = array(
                'id_tracking' => $id_tracking,
                'lead_id' => $lead_id,
                'user_id' => $id_user,
                'note' => $note,
                'create_date' => date('Y-m-d H:i:s'),
                'status' => 1,
            );
            $addTrack = $this->db->insert('tb_tracking', $dataTrack);
            $dataDate = array(
                'date_already_visit' => date('Y-m-d H:i:s'),
            );
            $addDate = $this->general->editDate($lead_id, $dataDate);

            $response = [
                'value' => 1,
                'message' => 'Berhasil di update',
                'visit_id' => $id,
                'lead_id' => $lead_id,
                'project_code' => $project_code,
                'data' => [
                    'visit' =>  $data,
                    'tracking' => $dataTrack,
                    'date' => $dataDate,
                ],
            ];
            $this->set_response($response, 200);
        } else {
            $response = array(
                'value' => 2,
                'message' => 'Gagal di update',
            );
            $this->set_response($response, 500);
        }
    }

    public function reschedule_put()
    {
        $id = $this->put('id');
        $id_lead = $this->put('id_lead');
        $id_user = $this->put('id_user');
        $note = 'Sales Telah Mengubah Jadwal Visit';
        $date_visit = $this->put('date_visit');
        $project_code = $this->put('project_code');
        $id_tracking = $this->code->codeTracking($project_code);
        $data = [
            'visit_date' => $date_visit,
            'note' => $note,
            'update_date' => date('Y-m-d H:i:s'),
        ];
        $update = $this->general->editVisit($id, $data);
        if ($update) {
            $dataTrack = array(
                'id_tracking' => $id_tracking,
                'lead_id' => $id_lead,
                'user_id' => $id_user,
                'note' => $note,
                'create_date' => date('Y-m-d H:i:s'),
                'status' => 1,
            );
            $addTrack = $this->db->insert('tb_tracking', $dataTrack);

            $response = [
                'value' => 1,
                'message' => 'Berhasil di update',
                'visit_id' => $id,
                'lead_id' => $id_lead,
                'user_id' => $id_user,
                'project_code' => $project_code,
                'data' => [
                    'data' => $data,
                    'tracking' => $dataTrack,
                ],
            ];
            $this->set_response($response, 200);
        } else {
            $response = [
                'value' => 1,
                'message' => 'Gagal di update',
            ];
            $this->set_response($response, 500);
        }
    }

    public function reservation_put()
    {
        $leadId = $this->put('lead_id');
        $homeId = $this->put('home_id');
        $userId = $this->put('user_id');
        $feeReservation = $this->put('fee_reservation');
        $paymentMethod = $this->put('payment_method');
        $note = $this->put('note');
        $projectCode = $this->put('project_code');
        $id_tracking = $this->code->codeTracking($projectCode);
        $feeId = $this->code->codeFee($projectCode);
        $data = array(
            'note' => $note,
            'home_id' => $homeId,
            'update_date' => date('Y-m-d H:i:s'),
            'status' => '4',
            'payment_method' => $paymentMethod,
        );
        $update = $this->general->editLead($leadId, $data);
        if ($update) {
            $dataTrack = array(
                'id_tracking' => $id_tracking,
                'lead_id' => $leadId,
                'user_id' => $userId,
                'note' => $note,
                'create_date' => date('Y-m-d H:i:s'),
                'status' => 1,
            );
            $this->db->insert('tb_tracking', $dataTrack);

            $dataFee = [
                'id_fee' => $feeId,
                'lead_id' => $leadId,
                'fee_reservation' => $feeReservation,
            ];
            $this->db->insert('tb_fee', $dataFee);

            $dataDate = array(
                'date_reservation' => date('Y-m-d H:i:s'),
            );
            $addDate = $this->general->editDate($leadId, $dataDate);

            $dataHome = array(
                'status_home' => '2',
            );
            $this->general->editHome($homeId, $dataHome);

            $response = [
                'value'  => 1,
                'message' => "Berhasil",
                'lead_id' =>  $leadId,
                'home_id' => $homeId,
                'user_id' => $userId,
                'tracking_id' => $id_tracking,
                'data' => [
                    'lead' => $data,
                    'fee' => $dataFee,
                    'home' => $dataHome,
                    'tracking' => $dataTrack,
                ],
            ];
            $this->set_response($response, 200);
        } else {
            $response =  [
                'value' => 2,
                'message'  => 'Gagal',
            ];
            $this->set_response($response, 50);
        }
    }

    public function booking_put()
    {
        $leadId = $this->put('lead_id');
        $feeBooking = $this->put('fee_booking');
        $price = $this->put('price');
        $discountPrice = $this->put('discount_price');
        $downpayment = $this->put('downpayment');
        $discountDownpayment = $this->put('discount_downpayment');
        $note = $this->put('note');
        $userId = $this->put('user_id');
        $homeId = $this->put('home_id');
        $projectCode = $this->put('project_code');
        $id_tracking = $this->code->codeTracking($projectCode);
        $paymentId = $this->code->codePayment($projectCode);
        $now = date('Y-m-d H:i:s');
        $data = [
            'note' => $note,
            'update_date' => $now,
            'status' => '5',
        ];
        $update = $this->general->editLead($leadId, $data);
        if ($update) {
            $dataTrack = array(
                'id_tracking' => $id_tracking,
                'lead_id' => $leadId,
                'user_id' => $userId,
                'note' => $note,
                'create_date' => date('Y-m-d H:i:s'),
                'status' => 1,
            );
            $this->db->insert('tb_tracking', $dataTrack);

            $dataDate = array(
                'date_booking' => date('Y-m-d H:i:s'),
            );
            $addDate = $this->general->editDate($leadId, $dataDate);

            $dataHome = array(
                'status_home' => 3,
                'price' => $price,
            );
            $this->general->editHome($homeId, $dataHome);

            $fee = $this->general->getFee($leadId);
            $total = 0;
            $feeR = $fee->fee_reservation;
            $total =  (int)$feeBooking + $feeR;

            $dataFee = [
                'fee_booking' => $feeBooking,
                'total' => $total,
            ];
            $this->general->editFee($leadId, $dataFee);

            if ($discountPrice != null) {
                $subtotal = $price - $discountPrice - $total;
                $dataPayment = [
                    'id_payment' => $paymentId,
                    'lead_id' => $leadId,
                    'discount_price' => $discountPrice,
                    'subtotal' => $subtotal,
                    'created_date' => $now,
                ];
            } else if ($downpayment) {
                $downpaymentPaid = (int)$downpayment - (int)$discountDownpayment;
                $subtotal = (int)$price - (int)$downpaymentPaid - (int)$total;
                $dataPayment = [
                    'id_payment' => $paymentId,
                    'lead_id' => $leadId,
                    'downpayment' => $downpayment,
                    'discount_downpayment' => $discountDownpayment,
                    'downpayment_paid' => $downpaymentPaid,
                    'subtotal' => $subtotal,
                    'created_date' => $now,
                ];
            }
            $this->db->insert('tb_payment', $dataPayment);

            $response = [
                'value' => 1,
                'message' => 'Berhasil',
                'data' => [
                    'lead' => $data,
                    'payment' => $dataPayment,
                    'home' => $dataHome,
                    'fee' => $dataFee,
                    'tracking' => $dataTrack,
                    'date' => $dataDate,
                ],
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

    public function sold_put()
    {
        $leadId = $this->put('lead_id');
        $homeId = $this->put('home_id');
        $userId = $this->put('user_id');
        $note = $this->put('note');
        $project_code = $this->put('project_code');
        $id_tracking = $this->code->codeTracking($project_code);
        $data = [
            'note' => $note,
            'status' => '6',
            'update_date' => date('Y-m-d H:i:s'),
        ];
        $update = $this->general->editLead($leadId, $data);
        if ($update) {
            $dataDate = array(
                'date_sold' => date('Y-m-d H:i:s'),
            );
            $addDate = $this->general->editDate($leadId, $dataDate);

            $dataHome = array(
                'status_home' => 4,
            );
            $this->general->editHome($homeId, $dataHome);

            $dataTrack = array(
                'id_tracking' => $id_tracking,
                'lead_id' => $leadId,
                'user_id' => $userId,
                'note' => $note,
                'create_date' => date('Y-m-d H:i:s'),
                'status' => 1,
            );
            $this->db->insert('tb_tracking', $dataTrack);


            $response = [
                'value' => 1,
                'message' => 'Berhasil',
                'data' => [
                    'lead' => $data,
                    'home' => $dataHome,
                    'track' => $dataTrack,
                    'date' => $dataDate,
                ]
            ];
            $this->set_response($response, 200);
        } else {
            $response = [
                'message' => 'Gagal',
                'value' => 2,
            ];
            $this->set_response($response, 500);
        }
    }
}
