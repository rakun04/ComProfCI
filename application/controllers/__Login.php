<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class __Login extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    $this->load->model('MModel');
  }

  function index()
  {
    $this->load->view('v_login');
    if($this->session->userdata("id_user_sess"))
    {
      redirect(base_url().'Dashboard');
    }
  }
  



  function addRegister()
  {
    $this->_validate();
    $edit=array(
      "pembeli"=>$this->input->post('pembeli'),
      "kota"=>$this->input->post('kota'),
      "email"=>$this->input->post('email'),
      "status"=>"sold",
      "tanggal_aktivasi"=>date('Y-m-d')
    );
    $add=array(
      "username"=>$this->input->post('username'),
      "password"=>md5($this->input->post('password')),
      "id_anggota"=>0
    );
    $this->MModel->update('no_seri',$this->input->post('no_seri'),'kit',$edit);
    $this->MModel->add("user",$add);
    echo json_encode(array("status"=>TRUE));
  }

  private function _validate()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

    $no_seri=$this->input->post('no_seri',TRUE);

		if($_POST['no_seri'] == '')
		{
			$data['inputerror'][] = 'no_seri';
			$data['error_string'][] = 'No Seri Alat harus diisi !!';
			$data['status'] = FALSE;
		}else {
      $cek=$this->MModel->get("Select * from kit where no_seri='$no_seri' and status='ready'");

      if(!$cek)
      {
        $data['inputerror'][] = 'no_seri';
        $data['error_string'][] = 'No Seri Tidak Terdaftar !!';
        $data['status'] = FALSE;
      }
    }

		if($_POST['pembeli'] == '')
		{
			$data['inputerror'][] = 'pembeli';
			$data['error_string'][] = 'Nama Lengkap harus diisi';
			$data['status'] = FALSE;
		}

    if($_POST['kota'] == '')
		{
			$data['inputerror'][] = 'kota';
			$data['error_string'][] = 'Kota harus diisi';
			$data['status'] = FALSE;
		}
    if($_POST['email'] == '')
		{
			$data['inputerror'][] = 'email';
			$data['error_string'][] = 'Email harus diisi';
			$data['status'] = FALSE;
		}

    if($_POST['username'] == '')
		{
			$data['inputerror'][] = 'username';
			$data['error_string'][] = 'Password  harus diisi';
			$data['status'] = FALSE;
		}else {
      $username=$this->input->post('username',TRUE);
      $cekuser=$this->MModel->get("Select * from user where username='$username'");
      if($cekuser)
      {
        $data['inputerror'][] = 'username';
  			$data['error_string'][] = 'Username ini Sudah digunakan !!';
  			$data['status'] = FALSE;
      }
    }

		if($_POST['password'] == '')
		{
			$data['inputerror'][] = 'password';
			$data['error_string'][] = 'Password  harus diisi';
			$data['status'] = FALSE;
		}

		if($_POST['password'] != $_POST['password2'])
		{
			$data['inputerror'][] = 'password2';
			$data['error_string'][] = 'Retype Password Is Not Match!';
			$data['status'] = FALSE;
		}

		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}
	}


  function detail()
  {
    $id=$_POST['id'];
    $data=$this->MModel->get("select * from post where id_post='$id'");
    echo json_encode($data);
  }


  function do_login()
  {
    $username=$_POST['username'];
    $pass=$_POST['password'];
    $sql="select * from user where username='$username' and password=md5('$pass')";
    $data=$this->MModel->getData($sql);
    if ($data)
    {
      foreach ($data as $dat) {
        $this->session->set_userdata('id_user_sess',$dat['id_user']);
        $this->session->set_userdata('id_anggota_sess',$dat['id_anggota']);
        $this->session->set_userdata('username_sess',$dat['username']);
      }
      redirect(base_url().'Dashboard');
    }
    else {
      $this->session->set_flashdata('status',"username dan password tidak ditemukan");
      redirect(base_url().'__Login');
    }
  }

  function addLoginAnggota()
  {

    $this->_validateLogin();
    $data=array(
      "nama_lengkap"=>$this->input->post('nama_lengkap'),
      "status"=>"P"
    );
    $data2=array(
      "username"=>$this->input->post('username'),
      "password"=>md5($this->input->post('password1')),
      "id_anggota"=>$this->MModel->getMax('id_anggota','anggota')+1,
      "role"=>"1"
    );
    $this->MModel->add('login',$data2);
    $this->MModel->add('anggota',$data);

    echo json_encode(array("status"=>TRUE));

  }

  private function _validatePW()
   {
     $data = array();
     $data['error_string'] = array();
     $data['inputerror'] = array();
     $data['status'] = TRUE;

     if($_POST['passwordLama'] == '')
     {
       $data['inputerror'][] = 'passwordLama';
       $data['error_string'][] = 'Password Lama harus diisi';
       $data['status'] = FALSE;
     }else {
       $pw=$this->input->post('passwordLama');
       $id=$this->session->userdata('id_user_sess');
       $hasil=$this->MModel->get("Select * from user where password=md5('$pw') and id_user='$id'");
       if(!$hasil)
       {
         $data['inputerror'][] = 'passwordLama';
         $data['error_string'][] = 'Password lama salah/tidak ditemukan';
         $data['status'] = FALSE;
       }
     }
     if($_POST['password'] == '')
     {
       $data['inputerror'][] = 'password';
       $data['error_string'][] = 'password harus diisi';
       $data['status'] = FALSE;
     }
     if($_POST['password'] != $_POST['password2'])
     {
       $data['inputerror'][] = 'password2';
       $data['error_string'][] = 'password tidak sama';
       $data['status'] = FALSE;
     }
     if($data['status'] === FALSE)
     {
       echo json_encode($data);
       exit();
     }
   }

   function gantiPassword()
   {
     $this->_validatePW();
     $data=array(
       "password"=>md5($this->input->post('password'))
     );
     $id=$this->session->userdata('id_user_sess');
     $this->MModel->update("id_user",$id,"user",$data);
     echo json_encode(array("status"=>TRUE));
   }



  function keluar()
  {
      $this->session->sess_destroy();
      redirect(base_url().'__Login');
  }

  function send()
  {
    $data = array(
      'body' => "Test",
      'title' => "Oke Siap",
      'icon' => "myIcon",
      'sound' => "MySound"
    );
    gcm($data);
  }


}
