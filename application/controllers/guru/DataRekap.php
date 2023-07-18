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
    $id = $this->session->userdata('id_user');
    $id_kelas = $this->input->post('kelas');
    $id_mapel = $this->input->post('mapel');

    $mulai = date("Y-m",strtotime($this->input->post('mulai')));
    


    $result = $this->db->query("SELECT * FROM rekap_absen WHERE kelas_id = '$id_kelas' AND mapel_id = '$id_mapel' AND user_id = '$id' AND  DATE_FORMAT(created, '%Y-%m') = '$mulai' ")->row_array();
    if(!$result) {
      $this->session->set_flashdata("error",'Data Tidak Ditemukan');
      return redirect("gr/data-rekap");
    }

    $hasil = $this->db->query("SELECT * FROM rekap_absen WHERE kelas_id = '$id_kelas' AND user_id = '$id' AND mapel_id = '$id_mapel' AND  DATE_FORMAT(created, '%Y-%m') = '$mulai' ")->result_array();
   

    $pelajaran = $this->db->query("SELECT * FROM mapel_guru WHERE user_id = '$id'")->result_array();
    $data = [
      'content' => 'backend/guru/dataRekap',
      'title'   => 'Rekap Bulanan',
      'pelajaran' =>  $pelajaran,
      'profile' => $this->user_m->profile($id),
      'userdata' => $id,
      'mulai' =>  $mulai,
      'result'  =>  $hasil,
      'kelas' => $this->kelas_m->getKelas(),
      'id_kelas'  =>  $id_kelas,
      'mapel' => $id_mapel,
      
    ];
    $this->load->view('backend/layouts/wrapper', $data, FALSE);
    
  }

  public function cetak()
  {
    $kelas= $this->uri->segment(3);
    $mapel = $this->uri->segment(4);
    $mulai = $this->uri->segment(5);
    
    $id = $this->session->userdata('id_user');
    $hasil = $this->db->query("SELECT * FROM rekap_absen WHERE kelas_id = '$kelas' AND user_id = '$id' AND mapel_id = '$mapel' AND  DATE_FORMAT(created, '%Y-%m') = '$mulai' ")->num_rows();
    if(!$hasil) {
      return redirect("gr/data-rekap");
    }
    $bulan = date("m");
    // var_dump($bulan);die();
    $data = [
      'result'  =>  $this->db->query("SELECT * FROM rekap_absen WHERE kelas_id = '$kelas' AND user_id = '$id' AND mapel_id = '$mapel' AND  DATE_FORMAT(created, '%Y-%m') = '$mulai' ")->result_array(),
      'title'   => 'Cetak Absensi',
      'profile' => $this->user_m->profile($id),
      'bulans' =>  $mulai,
      'userdata' => $id,
      'absensi' => $this->absensi_m->getLaporanPerKelas($kelas, $mapel),
      'cetak' => $this->absensi_m->cetakRekap($kelas, $mapel, $bulan),
      'bulan' => $this->absensi_m->getBulan($kelas, $mapel),
      'kelas' => $this->db->query("SELECT * FROM kelas WHERE id_kelas = '$kelas'")->row_array(),
      'mapel' => $this->db->query("SELECT * FROM mapel WHERE id_mapel = '$mapel'")->row_array()
    ];
    
    $this->load->view('backend/cetak', $data, FALSE);
    
    
  }
}

/* End of file DataRekap.php */
