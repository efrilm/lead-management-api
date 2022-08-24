<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Code_model extends CI_Model
{


  public function generateString($strength = 16)
  {
    $permitedChar  = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $input_length = strlen($permitedChar);
    $randomString = '';
    for ($i = 0; $i < $strength; $i++) {
      $random_character = $permitedChar[mt_rand(0, $input_length - 1)];
      $randomString .= $random_character;
    }

    return $randomString;
  }

  public function codeUser()
  {
    $this->db->select('RIGHT(tb_user.id_user, 3) as code', false);
    $this->db->order_by('id_user', 'DESC');
    $this->db->limit(1);
    $query = $this->db->get('tb_user');
    if ($query->num_rows() <> 0) {
      // Jika Kode Sudah Ada
      $data = $query->row();
      $kode = intval($data->code) + 1;
    } else {
      $kode = 1;
    }
    $kodemax = str_pad($kode, 4, '0', STR_PAD_LEFT);
    $hasilKode = 'USGR' . date('dmy') . $kodemax;
    return $hasilKode;
  }

  public function codeSales()
  {
    $this->db->select('RIGHT(tb_user.id_user, 3) as code', false);
    $this->db->order_by('id_user', 'DESC');
    $this->db->limit(1);
    $query = $this->db->get('tb_user');
    if ($query->num_rows() <> 0) {
      // Jika Kode Sudah Ada
      $data = $query->row();

      $kode = intval($data->code) + 1;
    } else {
      $kode = 1;
    }
    $kodemax = str_pad($kode, 4, '0', STR_PAD_LEFT);
    $hasilKode = 'SLSGR' . date('dmy') . $kodemax;
    return $hasilKode;
  }

  public function codeMarkom()
  {
    $this->db->select('RIGHT(tb_user.id_user, 3) as code', false);
    $this->db->order_by('id_user', 'DESC');
    $this->db->limit(1);
    $query = $this->db->get('tb_user');
    if ($query->num_rows() <> 0) {
      // Jika Kode Sudah Ada
      $data = $query->row();
      $kode = intval($data->code) + 1;
    } else {
      $kode = 1;
    }
    $kodemax = str_pad($kode, 4, '0', STR_PAD_LEFT);
    $hasilKode = 'MRKGR' . date('dmy') . $kodemax;
    return $hasilKode;
  }

  public function codeLead($projectCode)
  {
    $this->db->select('RIGHT(tb_lead.id_lead, 3) as code', false);
    $this->db->order_by('id_lead', 'DESC');
    $this->db->limit(1);
    $query = $this->db->get('tb_lead');
    if ($query->num_rows() <> 0) {
      // Jika Kode Sudah Ada
      $data = $query->row();
      $kode = intval($data->code) + 1;
    } else {
      $kode = 1;
    }
    $kodemax = str_pad($kode, 4, '0', STR_PAD_LEFT);
    $hasilKode = $projectCode . 'GR' . date('dmy') . $kodemax;
    return $hasilKode;
  }

  public function codeVisit($projectCode)
  {
    $this->db->select('RIGHT(tb_visit.id_visit, 3) as code', false);
    $this->db->order_by('id_visit', 'DESC');
    $this->db->limit(1);
    $query = $this->db->get('tb_visit');
    if ($query->num_rows() <> 0) {
      // Jika Kode Sudah Ada
      $data = $query->row();
      $kode = intval($data->code) + 1;
    } else {
      $kode = 1;
    }
    $kodemax = str_pad($kode, 4, '0', STR_PAD_LEFT);
    $hasilKode = $projectCode . 'GRVS' . date('dmy') . $kodemax;
    return $hasilKode;
  }

  public function codeTracking($projectCode)
  {
    $this->db->select('RIGHT(tb_tracking.id_tracking, 3) as code', false);
    $this->db->order_by('id_tracking', 'DESC');
    $this->db->limit(1);
    $query = $this->db->get('tb_tracking');
    if ($query->num_rows() <> 0) {
      // Jika Kode Sudah Ada
      $data = $query->row();
      $kode = intval($data->code) + 1;
    } else {
      $kode = 1;
    }
    $kodemax = str_pad($kode, 4, '0', STR_PAD_LEFT);
    $hasilKode =  'TRK' . $projectCode .  date('dmy') . $kodemax;
    return $hasilKode;
  }

  public function codeHome($projectCode)
  {
    $this->db->select('RIGHT(tb_home.id_home, 3) as code', false);
    $this->db->order_by('id_home', 'DESC');
    $this->db->limit(1);
    $query = $this->db->get('tb_home');
    if ($query->num_rows() <> 0) {
      // Jika Kode Sudah Ada
      $data = $query->row();
      $kode = intval($data->code) + 1;
    } else {
      $kode = 1;
    }
    $kodemax = str_pad($kode, 4, '0', STR_PAD_LEFT);
    $hasilKode =  'HMT' . $projectCode . $kodemax;
    return $hasilKode;
  }

  public function codeFee($projectCode)
  {
    $this->db->select('RIGHT(tb_fee.id_fee, 3) as code', false);
    $this->db->order_by('id_fee', 'DESC');
    $this->db->limit(1);
    $query = $this->db->get('tb_fee');
    if ($query->num_rows() <> 0) {
      // Jika Kode Sudah Ada
      $data = $query->row();
      $kode = intval($data->code) + 1;
    } else {
      $kode = 1;
    }
    $kodemax = str_pad($kode, 4, '0', STR_PAD_LEFT);
    $hasilKode =  'FRBT' . $projectCode . $kodemax;
    return $hasilKode;
  }

  public function codePayment($projectCode)
  {
    $this->db->select('RIGHT(tb_payment.id_payment, 3) as code', false);
    $this->db->order_by('id_payment', 'DESC');
    $this->db->limit(1);
    $query = $this->db->get('tb_payment');
    if ($query->num_rows() <> 0) {
      // Jika Kode Sudah Ada
      $data = $query->row();
      $kode = intval($data->code) + 1;
    } else {
      $kode = 1;
    }
    $kodemax = str_pad($kode, 4, '0', STR_PAD_LEFT);
    $hasilKode =  'PM' . $projectCode . $kodemax;
    return $hasilKode;
  }
}
