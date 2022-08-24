<?php
defined('BASEPATH') or exit('No direct script access allowed');

class General_model extends CI_Model
{


  public function __construct()
  {
    parent::__construct();
  }

  public function antrian($projectCode, $limit = null)
  {
    $this->db->where('is_sales', 1);
    $this->db->where('project_code', $projectCode);
    if ($limit != null) {
      $this->db->limit($limit);
    }
    $this->db->order_by('update_date', 'ASC');
    return $this->db->get('tb_user')->result_array();
  }

  public function sales($projectCode = null)
  {
    $this->db->where('level', 1);
    if ($projectCode === null) {
      return $this->db->get('tb_user')->result_array();
    } else {
      $this->db->where('project_code', $projectCode);
      return $this->db->get('tb_user')->result_array();
    }
  }

  public function markom($projectCode = null)
  {
    $this->db->where('level', 2);
    if ($projectCode === null) {
      return $this->db->get('tb_user')->result_array();
    } else {
      $this->db->where('project_code', $projectCode);
      return $this->db->get('tb_user')->result_array();
    }
  }

  public function leadSales($idSales, $status, $projectCode)
  {
    $this->db->where('sales_id', $idSales);
    $this->db->where('status', $status);
    $this->db->where('project_code', $projectCode);
    $this->db->order_by('update_date', 'DESC');
    return $this->db->get('tb_lead')->result_array();
  }

  public function leadLimitSales($idSales, $projectCode)
  {
    $this->db->where('sales_id', $idSales);
    $this->db->where('project_code', $projectCode);
    $this->db->limit(3);
    $this->db->order_by('date_add', 'DESC');
    return $this->db->get('tb_lead')->result_array();
  }

  public function leadPmSales($idSales, $status, $projectCode, $paymentMethod)
  {
    $this->db->where('sales_id', $idSales);
    $this->db->where('status', $status);
    $this->db->where('tb_lead.project_code', $projectCode);
    $this->db->where('payment_method', $paymentMethod);
    $this->db->join('tb_home', 'tb_home.id_home = tb_lead.home_id');
    $this->db->order_by('update_date', 'DESC');
    return $this->db->get('tb_lead')->result_array();
  }

  public function leadAndHomeSales($idSales, $status, $projectCode)
  {
    $this->db->where('sales_id', $idSales);
    $this->db->where('status', $status);
    $this->db->where('tb_lead.project_code', $projectCode);
    $this->db->join('tb_home', 'tb_home.id_home = tb_lead.home_id');
    $this->db->order_by('update_date', 'DESC');
    return $this->db->get('tb_lead')->result_array();
  }

  public function leadAndHome($status, $projectCode)
  {
    $this->db->where('status', $status);
    $this->db->where('tb_lead.project_code', $projectCode);
    $this->db->join('tb_home', 'tb_home.id_home = tb_lead.home_id');
    $this->db->order_by('update_date', 'DESC');
    return $this->db->get('tb_lead')->result_array();
  }

  public function lead($status, $projectCode)
  {
    $this->db->where('status', $status);
    $this->db->where('project_code', $projectCode);
    $this->db->order_by('update_date', 'DESC');
    return $this->db->get('tb_lead')->result_array();
  }

  public function leadLimit($projectCode)
  {
    $this->db->where('project_code', $projectCode);
    $this->db->limit(3);
    $this->db->order_by('date_add', 'DESC');
    return $this->db->get('tb_lead')->result_array();
  }

  public function leadPm($status, $projectCode, $paymentMethod)
  {
    $this->db->where('status', $status);
    $this->db->where('tb_lead.project_code', $projectCode);
    $this->db->where('payment_method', $paymentMethod);
    $this->db->join('tb_home', 'tb_home.id_home = tb_lead.home_id');
    $this->db->order_by('update_date', 'DESC');
    return $this->db->get('tb_lead')->result_array();
  }

  public function leadAndHomeMarkom($idMarkom, $status, $projectCode)
  {
    $this->db->where('markom_id', $idMarkom);
    $this->db->where('status', $status);
    $this->db->where('tb_lead.project_code', $projectCode);
    $this->db->join('tb_home', 'tb_home.id_home = tb_lead.home_id');
    $this->db->order_by('update_date', 'DESC');
    return $this->db->get('tb_lead')->result_array();
  }

  public function leadMarkom($idMarkom, $status, $projectCode)
  {
    $this->db->where('markom_id', $idMarkom);
    $this->db->where('status', $status);
    $this->db->where('project_code', $projectCode);
    $this->db->order_by('update_date', 'DESC');
    return $this->db->get('tb_lead')->result_array();
  }

  public function leadLimitMarkom($idMarkom, $projectCode)
  {
    $this->db->where('markom_id', $idMarkom);
    $this->db->where('project_code', $projectCode);
    $this->db->limit(3);
    $this->db->order_by('date_add', 'DESC');
    return $this->db->get('tb_lead')->result_array();
  }

  public function leadPmMarkom($idMarkom, $status, $projectCode, $paymentMethod)
  {
    $this->db->where('markom_id', $idMarkom);
    $this->db->where('status', $status);
    $this->db->where('tb_lead.project_code', $projectCode);
    $this->db->where('payment_method', $paymentMethod);
    $this->db->join('tb_home', 'tb_home.id_home = tb_lead.home_id');
    $this->db->order_by('update_date', 'DESC');
    return $this->db->get('tb_lead')->result_array();
  }

  public function checkCodeMarkom($codeProject, $codeMarkom)
  {
    $this->db->where('code_project', $codeProject);
    $this->db->where('code_markom', $codeMarkom);
    $this->db->limit(1);
    return $this->db->get('tb_project')->result_array();
  }

  public function checkCodeSales($codeProject, $codeSales)
  {
    $this->db->where('code_project', $codeProject);
    $this->db->where('code_sales', $codeSales);
    $this->db->limit(1);
    return $this->db->get('tb_project')->result_array();
  }

  public function checkCodeOwner($codeProject, $codeOwner)
  {
    $this->db->where('code_project', $codeProject);
    $this->db->where('code_sales', $codeOwner);
    $this->db->limit(1);
    return $this->db->get('tb_project')->result_array();
  }

  public function checkCode($codeProject)
  {
    $this->db->where('code_project', $codeProject);
    $this->db->limit(1);
    return $this->db->get('tb_project')->result_array();
  }

  public function editLead($id, $data)
  {
    $this->db->where('id_lead', $id);
    return $this->db->update('tb_lead', $data);
  }

  public function deleteLead($id)
  {
    $this->db->where('id_lead', $id);
    return $this->db->delete('tb_lead');
  }

  public function editDate($id, $data)
  {
    $this->db->where('lead_id', $id);
    return $this->db->update('tb_date', $data);
  }

  public function getUser($id)
  {
    $this->db->where('id_user', $id);
    return $this->db->get('tb_user')->row();
  }

  public function getUserByLevel($level, $projectCode)
  {
    $this->db->where('level', $level);
    $this->db->where('project_code', $projectCode);
    return $this->db->get('tb_user')->result_array();
  }

  public function addVisit($data)
  {
    return $this->db->insert('tb_visit', $data);
  }
  public function editVisit($id, $data)
  {
    $this->db->where('id_visit', $id);
    return $this->db->update('tb_visit', $data);
  }
  public function getVisitSales($idSales, $status, $projectCode)
  {
    $this->db->join('tb_lead', 'tb_lead.id_lead=tb_visit.lead_id');
    $this->db->where('tb_lead.sales_id', $idSales);
    $this->db->where('status_visit', $status);
    $this->db->where('tb_lead.project_code', $projectCode);
    $this->db->order_by('tb_visit.update_date', 'DESC');
    return $this->db->get('tb_visit')->result_array();
  }

  public function getVisitMarkom($idMarkom, $status, $projectCode)
  {
    $this->db->join('tb_lead', 'tb_lead.id_lead=tb_visit.lead_id');
    $this->db->where('tb_lead.markom_id', $idMarkom);
    $this->db->where('status_visit', $status);
    $this->db->where('tb_lead.project_code', $projectCode);
    $this->db->order_by('tb_visit.update_date', 'DESC');
    return $this->db->get('tb_visit')->result_array();
  }

  public function getVisit($status, $projectCode)
  {
    $this->db->join('tb_lead', 'tb_lead.id_lead=tb_visit.lead_id');
    $this->db->where('status_visit', $status);
    $this->db->where('tb_lead.project_code', $projectCode);
    $this->db->order_by('tb_visit.update_date', 'DESC');
    return $this->db->get('tb_visit')->result_array();
  }

  public function getHome($status, $projectCode)
  {
    $this->db->where('status_home', $status);
    $this->db->where('project_code', $projectCode);

    $this->db->order_by('no_home', 'ASC');
    return $this->db->get('tb_home')->result_array();
  }

  public function getHome3($status, $projectCode)
  {
    $this->db->where('status_home', $status);
    $this->db->where('project_code', $projectCode);
    $this->db->order_by('no_home', 'ASC');
    $this->db->limit(3);
    return $this->db->get('tb_home')->result_array();
  }

  public function editHome($id, $data)
  {
    $this->db->where('id_home', $id);
    return $this->db->update('tb_home', $data);
  }

  public function deleteHome($id)
  {
    $this->db->where('id_home', $id);
    return $this->db->delete('tb_home');
  }

  public function getTracking($id)
  {
    $this->db->select('tb_tracking.*, tb_user.user_name');
    $this->db->from('tb_tracking');
    $this->db->join('tb_user', 'tb_user.id_user = tb_tracking.user_id');
    $this->db->where('lead_id', $id);
    $this->db->order_by('tb_tracking.create_date', 'DESC');
    return $this->db->get()->result_array();
  }

  public function getFee($id)
  {
    $this->db->where('lead_id', $id);
    return $this->db->get('tb_fee')->row();
  }

  public function editFee($id, $data)
  {
    $this->db->where('lead_id', $id);
    return $this->db->update('tb_fee', $data);
  }

  public function getDate($id)
  {
    $this->db->where('lead_id', $id);
    return $this->db->get('tb_date')->result_array();
  }

  public function getPayment($id)
  {
    $this->db->where('lead_id', $id);
    return $this->db->get('tb_payment')->result_array();
  }

  public function countLeadDay($projectCode)
  {
    $query = $this->db->query("SELECT COUNT(*) AS count FROM tb_lead WHERE day=DATE(NOW()) AND project_code = '$projectCode'")->row();
    return $query;
  }

  public function countLeadWeek($projectCode)
  {
    $query = $this->db->query("SELECT COUNT(*) AS count FROM tb_lead WHERE YEARWEEK(day)=YEARWEEK(NOW()) AND project_code='$projectCode'")->row();
    return $query;
  }

  public function countLeadMonth($projectCode)
  {
    $query = $this->db->query("SELECT COUNT(*) AS count FROM tb_lead WHERE project_code= '$projectCode' AND CONCAT(YEAR(day),'/',MONTH(day))=CONCAT(YEAR(NOW()),'/',MONTH(NOW()))")->row();
    return $query;
  }

  public function countHome($status, $projectCode)
  {
    $query = $this->db->query("SELECT count(*) as count FROM tb_home WHERE status_home = '$status' AND project_code='$projectCode' ")->row();
    return $query;
  }

  public function countLeadDayMarkom($markomId, $projectCode)
  {
    $query = $this->db->query("SELECT COUNT(*) AS count FROM tb_lead WHERE day=DATE(NOW()) AND project_code = '$projectCode' AND markom_id = '$markomId' ")->row();
    return $query;
  }

  public function countLeadWeekMarkom($markomId, $projectCode)
  {
    $query = $this->db->query("SELECT COUNT(*) AS count FROM tb_lead WHERE YEARWEEK(day)=YEARWEEK(NOW()) AND project_code='$projectCode' AND markom_id = '$markomId' ")->row();
    return $query;
  }

  public function countLeadMonthlyMarkom($markomId, $projectCode)
  {
    $query = $this->db->query("SELECT COUNT(*) AS count FROM tb_lead WHERE project_code= '$projectCode' AND CONCAT(YEAR(day),'/',MONTH(day))=CONCAT(YEAR(NOW()),'/',MONTH(NOW())) AND markom_id = '$markomId'  ")->row();
    return $query;
  }

  public function countLeadDaySales($salesId, $projectCode)
  {
    $query = $this->db->query("SELECT COUNT(*) AS count FROM tb_lead WHERE day=DATE(NOW()) AND project_code = '$projectCode' AND sales_id = '$salesId' ")->row();
    return $query;
  }

  public function countLeadWeekSales($salesId, $projectCode)
  {
    $query = $this->db->query("SELECT COUNT(*) AS count FROM tb_lead WHERE YEARWEEK(day)=YEARWEEK(NOW()) AND project_code='$projectCode' AND sales_id = '$salesId' ")->row();
    return $query;
  }

  public function countLeadMonthlySales($salesId, $projectCode)
  {
    $query = $this->db->query("SELECT COUNT(*) AS count FROM tb_lead WHERE project_code= '$projectCode' AND CONCAT(YEAR(day),'/',MONTH(day))=CONCAT(YEAR(NOW()),'/',MONTH(NOW())) AND sales_id = '$salesId'  ")->row();
    return $query;
  }

  public function getAbsen($projectCode)
  {
    $this->db->join('tb_user', 'tb_user.id_user = tb_absent.user_id');
    $this->db->where('tb_absent.project_code', $projectCode);
    $this->db->order_by('date', 'DESC');
    return $this->db->get('tb_absent')->result_array();
  }

  public function getAbsenToday($projectCode)
  {
    $query = $this->db->query("SELECT * FROM tb_absent INNER JOIN  tb_user ON tb_absent.user_id=tb_user.id_user WHERE YEAR(DATE) = YEAR(NOW()) AND MONTH(DATE) = MONTH(NOW()) AND DAY(DATE) = DAY(NOW()) AND tb_absent.project_code = '$projectCode' ORDER BY date ASC")->result_array();
    return $query;
  }

  public function getInsightDaily($projectCode)
  {
    $query = $this->db->query("SELECT day, COUNT(*) as count_day FROM tb_lead WHERE project_code = '$projectCode' GROUP BY day ORDER BY day DESC")->result_array();
    return $query;
  }

  public  function getInsightWeekly($projectCode)
  {
    $query = $this->db->query("SELECT YEARWEEK(day) AS year_week,COUNT(*) AS count_weekly FROM tb_lead WHERE project_code = '$projectCode' GROUP BY YEARWEEK(day) ORDER BY YEARWEEK(day) DESC")->result_array();
    return $query;
  }
  public  function getInsightMonthly($projectCode)
  {
    $query = $this->db->query("SELECT MONTH(day) AS month, COUNT(*) AS count_month FROM tb_lead WHERE project_code = '$projectCode' GROUP BY MONTH(day) ORDER BY MONTH(day) DESC")->result_array();
    return $query;
  }

  public function getInsightDailySales($salesId, $projectCode)
  {
    $query = $this->db->query("SELECT b.user_name, a.day, COUNT(*) as count_day FROM tb_lead a INNER JOIN tb_user b ON a.sales_id=b.id_user WHERE a.sales_id = '$salesId' AND a.project_code = '$projectCode' GROUP BY a.day ORDER BY a.day DESC")->result_array();
    return $query;
  }

  public function getInsightWeeklySales($salesId, $projectCode)
  {
    $query = $this->db->query("SELECT b.user_name,YEARWEEK(a.day) AS week, COUNT(*) AS count_weekly FROM tb_lead a INNER JOIN tb_user b ON a.sales_id=b.id_user     WHERE a.sales_id  = '$salesId' AND  a.project_code = '$projectCode'    GROUP BY YEARWEEK(a.day) ORDER BY YEARWEEK(a.day) DESC")->result_array();
    return $query;
  }

  public function getInsightMonthlySales($salesId, $projectCode)
  {
    $query = $this->db->query("SELECT b.user_name, MONTH(a.day) AS month, COUNT(*) AS count_month FROM tb_lead a INNER JOIN tb_user b ON a.sales_id=b.id_user WHERE a.sales_id = '$salesId' AND b.project_code = '$projectCode' GROUP BY MONTH(a.day) ORDER BY MONTH(a.day) DESC")->result_array();
    return $query;
  }

  public function getInsightDailyMarkom($markomId, $projectCode)
  {
    $query = $this->db->query("SELECT b.user_name, a.day, COUNT(*) as count_day FROM tb_lead a INNER JOIN tb_user b ON a.markom_id=b.id_user WHERE a.markom_id = '$markomId' AND a.project_code = '$projectCode' GROUP BY a.day ORDER BY a.day DESC")->result_array();
    return $query;
  }

  public function getInsightWeeklyMarkom($markomId, $projectCode)
  {
    $query = $this->db->query("SELECT b.user_name,YEARWEEK(a.day) AS week, COUNT(*) AS count_weekly FROM tb_lead a INNER JOIN tb_user b ON a.markom_id=b.id_user     WHERE a.markom_id  = '$markomId' AND  a.project_code = '$projectCode'    GROUP BY YEARWEEK(a.day) ORDER BY YEARWEEK(a.day) DESC")->result_array();
    return $query;
  }

  public function getInsightMonthlyMarkom($markomId, $projectCode)
  {
    $query = $this->db->query("SELECT b.user_name, MONTH(a.day) AS month, COUNT(*) AS count_month FROM tb_lead a INNER JOIN tb_user b ON a.markom_id=b.id_user WHERE a.markom_id = '$markomId' AND b.project_code = '$projectCode' GROUP BY MONTH(a.day) ORDER BY MONTH(a.day) DESC")->result_array();
    return $query;
  }

  public function getOmset($projectCode)
  {
    $query = $this->db->query("SELECT sum(price) AS count_omset FROM tb_home WHERE project_code = '$projectCode' ")->row();
    return $query;
  }

  public function editUser($id, $data)
  {
    $this->db->where('id_user', $id);
    return $this->db->update('tb_user', $data);
  }
}

/* End of file General_model.php */
/* Location: ./application/models/General_model.php */