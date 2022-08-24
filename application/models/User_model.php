
<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 *
 * Model User_model
 *
 * This Model for ...
 * 
 * @package		CodeIgniter
 * @category	Model
 * @author    Setiawan Jodi <jodisetiawan@fisip-untirta.ac.id>
 * @link      https://github.com/setdjod/myci-extension/
 * @param     ...
 * @return    ...
 *
 */

class User_model extends CI_Model
{

  public function create($data)
  {
    return $this->db->insert('tb_user', $data);
  }

  public function get($where = null)
  {
    if (isset($where)) {
      $this->db->where($where);
    }
    return $this->db->get('tb_user');
  }

  public function update($data, $where)
  {
    return $this->db->where($where)->update('tb_user', $data);
  }

  public function delete($where)
  {
    return $this->db->where($where)->delete('tb_user');
  }
}

/* End of file User_model.php */
/* Location: ./application/models/User_model.php */