<?php
defined('BASEPATH') or exit('No direct script access allowed');

use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;

class Absensi extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model(array('user_m', 'kelas_m', 'siswa_m', 'guru_m'));
    if ($this->session->userdata('is_login') !== TRUE || $this->session->userdata('tipe') != 88) {
      $this->session->set_flashdata('failed', '<div class="alert alert-danger" role="alert">
                                       Maaf, Anda harus login!
                                       </div>');
      redirect('login');
    }
  }

  public function index()
  {
    $id = $this->session->userdata('id_user');
    $id_kelas = $this->input->post('kelas');
    $id_mapel = $this->input->post('mapel');
    // echo $id_kelas;
    // // die();id
    $mapel = $this->db->query("SELECT * FROM mapel_guru WHERE user_id = '$id'")->result_array();
    $this->load->view('backend/layouts/wrapper', [
      'content' => 'backend/guru/absensi',
      'title' => 'Absensi',
      'mapel' =>  $mapel,
      'profile' => $this->user_m->profile($id),
      'kelas' => $this->kelas_m->getKelas(),
      'siswa' => $this->siswa_m->getSiswa($id_kelas),
      'userdata' => $id,
      'id_kelas' => $id_kelas,
      'pelajaran'  =>$id_mapel
    ], FALSE);
  }

  public function saveAbsensi()
  {
    $input = $this->input->post();
    $id_mapel = $input['id_mapel'];
    $id_kelas = $input['id_kelas'];
    $siswa = $input['id_siswa'];
    $ket = $input['keterangan'];
    $index = 0;

    foreach ($siswa as $row) {
      $save_siswa = "nama : " . $row .  " - Ket : " . $ket[$index] . "<br>";
      $date = date("Y-m-d");
      $tahun = date("Y");
      $bulan = date("m");
      $hari = date("d");
      $keterangan = $ket[$index];

      $index++;
      $insert = $this->db->query("INSERT INTO absensi VALUES(
      '',
      '$row',
      '$id_mapel',
      '$id_kelas',
      '$date',
      '$hari',
      '$bulan',
      '$tahun',
      '$keterangan'
  )");

      if ($keterangan == "Alpha") {

        $siswa_result = $this->db->query("SELECT * FROM siswa WHERE id_siswa = '$row'")->row_array();
        $tujuan = $siswa_result['no_hp'];
        $nama = $siswa_result['nama'];
        $token = "e2781388bf239590092f08d63af2603b";
        $nama_kelas = $this->db->query("SELECT * FROM kelas WHERE id_kelas = '$id_kelas'")->row_array();
        $nama_mapel = $this->db->query("SELECT * FROM mapel WHERE id_mapel = '$id_mapel'")->row_array();
        $name_kelas = $nama_kelas['kelas'];
        $name_mapel = $nama_mapel['nama_mapel'];
        $waktu = date("d, F Y H:i:s");
        $pesan = "Pemberitahuan siswa bernama $nama kelas $name_kelas pelajaran $name_mapel hari ini tidak masuk sekolah di karenakan Alpha pada tanggal $waktu";
        // $endCode = urlencode($pesan);
        // $url = "https://websms.co.id/api/smsgateway-otp?token=$token&to=$tujuan&msg=$endCode";

        // $header = array(
        //   'Accept: application/json',
        // );

        // $ch = curl_init();
        // curl_setopt($ch, CURLOPT_URL, $url);
        // curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        // curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        // curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        // $result = curl_exec($ch);

        // foreach($siswa as $masuk) {
        //   $total = $this->db->query("SELECT * FROM rekap_absen WHERE siswa_id = '$masuk'")->row_array();
        //   if($total) {

        //   } else {
        //     if($keterangan == "Hadir") {

        //     } elseif($keterangan == "Alpha") {

        //     } elseif($keterangan == "Ijin") {

        //     } elseif($keterangan == "Sakit") {

        //     } 
        //   }
        // }
      }
    }
    $this->session->set_flashdata('success', 'Data Berhasil Ditambahkan');
    return redirect('gr/absensi');
  }
}

/* End of file Absensi.php */
