<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Project_model extends CI_Model
{


  public function __construct()
  {
    parent::__construct();
  }

  public function getProject($code = null)
  {
    if ($code === null) {
      return $this->db->get('tb_project')->result_array();
    } else {
      return $this->db->get_where('tb_project', ['code_project' => $code])->result_array();
    }
  }

  public function deleteProject($id)
  {
    $this->db->where('id_project', $id);
    return $this->db->delete('tb_project');
  }
}

/* End of file Project_model.php */
/* Location: ./application/models/Project_model.php */