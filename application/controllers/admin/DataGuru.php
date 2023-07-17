<?php
defined('BASEPATH') or exit('No direct script access allowed');

class DataGuru extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model(array('user_m', 'admin_m', 'mapel_m'));
    $this->load->library('form_validation');
    if ($this->session->userdata('is_login') !== TRUE || $this->session->userdata('tipe') != 99) {
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

    $this->load->view('backend/layouts/wrapper', [
      'content' => 'backend/admin/dataGuru',
      'title' => 'Data Guru',
      'profile' => $this->user_m->profile($id),
      'userdata' => $id
    ], FALSE);
  }

  public function addGuru()
  {
    $id = $this->session->userdata('id_user');
    $this->load->view('backend/layouts/wrapper', [
      'content' => 'backend/admin/addGuru',
      'title' => 'Tambah Guru',
      'profile' => $this->user_m->profile($id),
      'agama' => $this->admin_m->getAgama(),
      'mapel' => $this->mapel_m->getMapel(),
      'userdata' => $id
    ], FALSE);
  }

  public function unameValid()
  {
    $username = $this->input->post('username');
    $exists = $this->admin_m->usernameExist($username);
    $count = count($exists);
    if (empty($count)) {
      echo true;
    } else {
      echo false;
    }
  }

  public function nipValid()
  {
    $nip = $this->input->post('nip');
    $exists = $this->admin_m->nipExist($nip);
    $count = count($exists);
    if (empty($count)) {
      echo true;
    } else {
      echo false;
    }
  }

  public function saveGuru()
  {
    $id = $this->session->userdata('id_user');
    $input = $this->input->post();

    // $getTanggal = explode('-', $input['tanggal_lahir']);
    // $pass = $getTanggal['0'] . $getTanggal['1'] . $getTanggal['2'];
    
    $this->form_validation->set_rules('username', 'Username', 'required|is_unique[user.username]');
    $this->form_validation->set_rules('nip', 'NIP', 'required|min_length[18]|is_unique[user.nip]');
    if ($this->form_validation->run() == FALSE) {
      $this->form_validation->set_message('is_unique', '%s sudah ada');
      $this->session->set_flashdata("error","Data Gagal Ditambahkan");
        return redirect("add-guru");
    } else {
      $data = [
        'id_mapel'     => 0,
        'id_agama'      => $input['agama'],
        'id_status'     => $input['status'],
        'nip'           => $input['nip'],
        'nama'          => $input['nama'],
        'username'      => $input['username'],
        'password'      => password_hash($input['nip'], PASSWORD_DEFAULT),
        // 'password'      => $input['nip'],
        'no_hp'         => $input['no_hp'],
        'alamat'        => $input['alamat'],
        'tempat_lahir' => $input['tempat_lahir'],
        'tanggal_lahir' => $input['tanggal_lahir'],
        'jenis_kelamin' => $input['gender'],
        'file'        => NULL,
        'tipe'        => 88,
        'submit_at'     => time()
      ];

      $result = $this->admin_m->saveGuru($data);

      $user_id = $this->db->query("SELECT * FROM user ORDER BY id_user DESC")->row_array();
      $guru = $user_id['id_user'];
      $now = date("Y-m-d H:i:s");
      foreach ($input['mapel'] as $row) {
        $this->db->query("INSERT INTO mapel_guru VALUES(
          '',
          '$row',
          '$guru',
          '$now'
      )");
      }
      // var_dump($data);
      if($result) {
        $this->session->set_flashdata("success","Data Berhasil Ditambahkan");
        return redirect("data-guru");
      } else {
        $this->session->set_flashdata("error","Data Gagal Ditambahkan");
        return redirect("add-guru");
      }
    }
  }

  public function getGuru()
  {
    $data = $this->admin_m->dataGuru();
    $peg = [];
    $no = 1;
    foreach ($data as $pegGuru) {
      $explode = explode('-', $pegGuru->tanggal_lahir);
      // $tgl = $explode[2] . '-' . $explode[1] . '-' . $explode[0];
      $temp = [];
      $temp[] = htmlspecialchars($no++, ENT_QUOTES, 'UTF-8');
      $temp[] = htmlspecialchars($pegGuru->username, ENT_QUOTES, 'UTF-8');
      $temp[] = htmlspecialchars($pegGuru->nip, ENT_QUOTES, 'UTF-8');
      $temp[] = htmlspecialchars($pegGuru->nama, ENT_QUOTES, 'UTF-8');
      $temp[] = htmlspecialchars($pegGuru->no_hp, ENT_QUOTES, 'UTF-8');
      $temp[] = htmlspecialchars($pegGuru->alamat, ENT_QUOTES, 'UTF-8');
      $temp[] = htmlspecialchars($pegGuru->agama, ENT_QUOTES, 'UTF-8');
      $temp[] = htmlspecialchars($pegGuru->tempat_lahir . ', ' . $pegGuru->tanggal_lahir, ENT_QUOTES, 'UTF-8');
      $temp[] = htmlspecialchars($pegGuru->jenis_kelamin, ENT_QUOTES, 'UTF-8');
      $temp[] = htmlspecialchars($pegGuru->status, ENT_QUOTES, 'UTF-8');

      // $temp[] = htmlspecialchars(date('d-m-Y / H:i', $pegGuru->submit_at), ENT_QUOTES, 'UTF-8');
      $temp[] = '
      <a href="' . site_url('edit-guru/') . $pegGuru->id_user . '" class="btn btn-default btn-sm" data-toggle="tooltip" title="Detail" target="">
          <i class="glyphicon glyphicon-pencil" style="color:#f39c12"></i>
      </a> 
      <a href="javascript:void(0)" onclick="hapusGuru(' . "'" . $pegGuru->id_user . "'" . ')" class="btn btn-default btn-sm" data-toggle="tooltip" title="Hapus" target="">
          <i class="glyphicon glyphicon-trash" style="color:#ff0000"></i>
      </a>';
      $peg[] = $temp;
    }

    $output['draw'] = intval($this->input->get('draw'));
    $output['recordsTotal'] = $this->admin_m->countAll();
    $output['recordsFiltered'] = $this->admin_m->filtered();
    $output['data'] = $peg;

    echo json_encode($output);
  }

  public function hapusGuru($id)
  {
    $this->admin_m->hapusGuru($id);
    echo json_encode(array("status" => TRUE));
  }

  public function editGuru()
  {
    $id = $this->session->userdata('id_user');
    $id_user = $this->uri->segment(2);
    // var_dump($id_siswa);die();
    $mapels = $this->db->query("SELECT * FROM mapel_guru  WHERE user_id = '$id_user' ORDER BY id DESC")->result_array();
    $this->load->view('backend/layouts/wrapper', [
      'content' => 'backend/admin/editGuru',
      'title'   => 'Edit Data Guru',
      'profile' => $this->user_m->profile($id),
      'agama' => $this->admin_m->getAgama(),
      'mapel' => $this->mapel_m->getMapel(),
      'userdata' => $id,
      'mapels'  =>  $mapels,
      'dataGuru' => $this->user_m->getDataGuru($id_user)
    ], FALSE);
    
  }
  public function saveEdit()
  {
    $input = $this->input->post();
    
    $id_user = $input['id_user'];
    $this->form_validation->set_rules('nip', 'NIP', 'required|min_length[18]|is_unique[user.nip]');
    // var_dump($id_siswa);die();
    // $this->form_validation->set_rules('nis', 'NIS', 'required|min_length[10]|is_unique[siswa.nis]');
    // if (!$this->form_validation->run()) {
    //   echo json_encode(['status' => FALSE]);
    // } else {
    $data = [
      'id_user' => $id_user,
      'id_mapel'     => 0,
      'id_agama'      => $input['agama'],
      'id_status'     => $input['status'],
      'nip'           => $input['nip'],
      'nama'          => $input['nama'],
      'username'      => $input['username'],
      'password'      => password_hash($input['nip'], PASSWORD_DEFAULT),
      // 'password'      => $input['nip'],
      'no_hp'         => $input['no_hp'],
      'alamat'        => $input['alamat'],
      'tempat_lahir' => $input['tempat_lahir'],
      'tanggal_lahir' => $input['tanggal_lahir'],
      'jenis_kelamin' => $input['gender'],
      'file'        => NULL,
      'tipe'        => 88,
      'submit_at'     => time()
    ];

    $result = $this->user_m->saveEditGuru($data, $id_user);
    $mapel_result = $input['mapel_id'];
    foreach($mapel_result as $main) {
      $this->db->query("DELETE FROM mapel_guru WHERE mapel_id = '$main' AND user_id = '$id_user'");
    }

    $now = date("Y-m-d H:i:s");
    foreach($mapel_result as $dua ) {
      $this->db->query("INSERT INTO mapel_guru VALUES('',
      '$dua',
      '$id_user',
      '$now'
      )");
    }
    if($result) {
      $this->session->set_flashdata("success",'Data Berhasil Diupdate');
      return redirect("data-guru");
    } else {
      $this->session->set_flashdata("error",'Data Gagal Diupdate');
      return redirect("edit-guru/" . $id_user);

    }
    echo json_encode(['status' => TRUE]);
    // var_dump($data);
    // }

  }
}

/* End of file DataGuru.php */
