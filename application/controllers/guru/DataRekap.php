<?php
defined('BASEPATH') or exit('No direct script access allowed');

class DataRekap extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model(array('user_m', 'absensi_m', 'kelas_m', 'mapel_m'));
    if ($this->session->userdata('is_login') !== TRUE || $this->session->userdata('tipe') != 88) {
      $this->session->set_flashdata('failed', '<div class="alert alert-danger" role="alert">
                                       Maaf, Anda harus login!
                                       </div>');
      redirect('login');
    }
    //Do your magic here
  }

  public function index()
  {
    $id = $this->session->userdata('id_user');
    $pelajaran = $this->db->query("SELECT * FROM mapel_guru WHERE user_id = '$id'")->result_array();
    $data = [
      'content' => 'backend/guru/dataRekap',
      'title'   => 'Rekap Bulanan',
      'pelajaran' =>  $pelajaran,
      'profile' => $this->user_m->profile($id),
      'userdata' => $id,
      'kelas' => $this->kelas_m->getKelas(),
      'mapel' => $this->mapel_m->getMapel(),
      
    ];
    $this->load->view('backend/layouts/wrapper', $data, FALSE);
    
  }

  public function prints()
  {
    $id_kelas = $this->input->post('kelas');
    $id_mapel = $this->input->post('mapel');

    $mulai = $this->input->post('mulai');
    $akhir = $this->input->post('akhir');
    

    if($akhir <= $mulai) {
      $this->session->set_flashdata("error","Waktu Tidak Valid");
      return redirect("gr/data-rekap");
    }

    $result = $this->db->query("SELECT * FROM rekap_absen WHERE kelas_id = '$id_kelas' AND mapel_id = '$id_mapel' AND created BETWEEN '$mulai' AND '$akhir'")->row_array();
    if(!$result) {
      $this->session->set_flashdata("error",'Data Tidak Ditemukan');
      return redirect("gr/data-rekap");
    }



    
  }
}

/* End of file DataRekap.php */
