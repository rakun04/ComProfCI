<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    $this->load->model('MModel');
    if(!$this->session->userdata('username_sess'))
    {
      redirect(base_url().'__Login');
    }
  }

  public function index()
  {
    $this->load->view('user/v_user');
  }

  public function ajax_list()
  {
        $table = 'anggota';
        $column_order = array(null,"no_rekening","nama_lengkap","jenis_kelamin","hoby","jabatan",null);
        $search = array("no_rekening","nama_lengkap","jenis_kelamin","hoby","jabatan");
        $order = array("id_anggota" => "ASC");
        $this->MModel->set_data("table",$table);
        $this->MModel->set_data("column_order",$column_order);
        $this->MModel->set_data("column_search",$search);
        $this->MModel->set_data("order",$order);
        $list = $this->MModel->get_datatables();
        $data = array();

        $no = $_POST['start'];
        foreach ($list as $l) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $l->nama_lengkap;
            $row[] = $l->jenis_kelamin;
            $row[] = $l->jabatan;
            $cek=$this->MModel->get("Select * from user where id_anggota='$l->id_anggota'");
            if($cek)
            {
              $row[] = '<a href="javascript:void(0)" onclick="editAkses()" class="btn btn-warning btn-xs"><i class="fa fa-key"></i> Have Akses</a>';
            }
            else {
              $row[] = '<a href="javascript:void(0)" onclick="addAkses()" class="btn btn-danger btn-xs"><i class="fa fa-times"></i> No Akses</a>';
            }
            $row[] = '<a href="'.base_url().'User/Detail/'.$l->id_anggota.'"  class="btn btn-info btn-xs" title="Lihat"><i class="fa fa-eye"></i></a>
                      <a href="javascript:void(0)" onclick="updateUser('.$l->id_anggota.')" class="btn btn-success btn-xs" title="Edit"><i class="fa fa-edit"></i></a>
                      <a href="javascript:void(0)" onclick="removeUser('.$l->id_anggota.')" class="btn btn-danger btn-xs" title="Hapus"><i class="fa fa-trash"></i></a>';
            $data[] = $row;
        }

        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->MModel->count_all(),
                        "recordsFiltered" => $this->MModel->count_filtered(),
                        "data" => $data,
        );

        //output to json format
        echo json_encode($output);
    }

    function Detail($id)
    {
      $hasil=$this->MModel->get("select * from anggota where id_anggota='$id'");
      if($hasil)
      {
        $data['detail']=$hasil;
        $this->load->view('user/v_detail_user',$data);
      }
      else {
        redirect(base_url("Error404"));
      }

    }

    public function add()
    {
      $nmfile='anggota__'.time();
      $config['upload_path'] = './img/anggota/'; //path folder
      $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp'; //type yang dapat diakses bisa anda sesuaikan
      $config['encrypt_name'] = TRUE; //Enkripsi nama yang terupload
      $config['file_name']=$nmfile;

      $this->upload->initialize($config);
      if(!empty($_FILES['image']['name'])){

          if ($this->upload->do_upload('image')){
              $gbr = $this->upload->data();
              //Compress Image
              $config['image_library']='gd2';
              $config['source_image']='./img/anggota/'.$gbr['file_name'];
              $config['create_thumb']= FALSE;
              $config['maintain_ratio']= FALSE;
              $config['width']= 600;
              $config['height']= 800;
              $config['new_image']= './img/anggota/'.$gbr['file_name'];
              $this->load->library('image_lib', $config);
              $this->image_lib->resize();

              $gambar=$gbr['file_name'];
              $data = array(
              'foto'=>$gambar,
              'nama_lengkap'=>$this->input->post('nama_lengkap'),
              'jenis_kelamin'=>$this->input->post('jenis_kelamin'),
              'jabatan'=>$this->input->post('jabatan'),
              'keahlian'=>$this->input->post('keahlian'),
              'email'=>$this->input->post('email'),
              'contact'=>$this->input->post('contact'),
              'akses'=>"N"
            );
            $this->MModel->add("anggota",$data);
            echo json_encode(array("status" => TRUE));

      }


      }else{
        $data = array(
          'nama_lengkap'=>$this->input->post('nama_lengkap'),
          'jenis_kelamin'=>$this->input->post('jenis_kelamin'),
          'jabatan'=>$this->input->post('jabatan'),
          'keahlian'=>$this->input->post('keahlian'),
          'email'=>$this->input->post('email'),
          'contact'=>$this->input->post('contact'),
          'akses'=>"N"
        );
        $this->MModel->add("anggota",$data);
        echo json_encode(array("status" => TRUE));

      }
    }

    public function update()
    {
      $nmfile='anggota__'.time();
      $config['upload_path'] = './img/anggota/'; //path folder
      $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp'; //type yang dapat diakses bisa anda sesuaikan
      $config['encrypt_name'] = TRUE; //Enkripsi nama yang terupload
      $config['file_name']=$nmfile;

      $this->upload->initialize($config);
      if(!empty($_FILES['image']['name'])){

          if ($this->upload->do_upload('image')){
              $gbr = $this->upload->data();
              //Compress Image
              $config['image_library']='gd2';
              $config['source_image']='./img/anggota/'.$gbr['file_name'];
              $config['create_thumb']= FALSE;
              $config['maintain_ratio']= FALSE;
              $config['width']= 600;
              $config['height']= 800;
              $config['new_image']= './img/anggota/'.$gbr['file_name'];
              $this->load->library('image_lib', $config);
              $this->image_lib->resize();

              $gambar=$gbr['file_name'];
              $data = array(
              'foto'=>$gambar,
              'nama_lengkap'=>$this->input->post('nama_lengkap'),
              'jenis_kelamin'=>$this->input->post('jenis_kelamin'),
              'jabatan'=>$this->input->post('jabatan'),
              'keahlian'=>$this->input->post('keahlian'),
              'email'=>$this->input->post('email'),
              'contact'=>$this->input->post('contact')
            );
            $this->MModel->update("id_anggota",$this->input->post("id"),"anggota",$data);
            echo json_encode(array("status" => TRUE));

      }


      }else{
        $data = array(
          'nama_lengkap'=>$this->input->post('nama_lengkap'),
          'jenis_kelamin'=>$this->input->post('jenis_kelamin'),
          'jabatan'=>$this->input->post('jabatan'),
          'keahlian'=>$this->input->post('keahlian'),
          'email'=>$this->input->post('email'),
          'contact'=>$this->input->post('contact')
        );
        $this->MModel->update("id_anggota",$this->input->post("id"),"anggota",$data);
        echo json_encode(array("status" => TRUE));

      }
    }

    public function get($id)
    {
      $data=$this->MModel->get("select * from anggota where id_anggota='$id'");
      echo json_encode($data);
    }

    public function hapus($id)
    {
      $this->MModel->hapus("id_anggota",$id,"anggota");
      echo json_encode(array("status"=>TRUE));

    }



}
