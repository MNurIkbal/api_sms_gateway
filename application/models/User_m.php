<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User_m extends CI_Model
{
  public function profile($id)
  {
    $this->db->select('*');
    $this->db->from('user u');
    $this->db->join('mapel m', 'u.id_mapel = m.id_mapel', 'left');
    $this->db->join('kelas k', 'u.id_kelas = k.id_kelas', 'left');
    $this->db->where('u.id_user', $id);
    return $this->db->get()->row();
  }
  public function getDataGuru($id_user){
    $this->db->select('*');
    $this->db->from('user');
    $this->db->where('id_user', $id_user);
   return $this->db->get()->row();
  }

  public function saveEditGuru($data, $id_user){
    return $this->db->replace('user', $data, $id_user); 
  }
  public function saveEditKelas($data, $id_user){
    return $this->db->replace('kelas', $data, $id_kelas);
  }
}

/* End of file Admin_m.php */
