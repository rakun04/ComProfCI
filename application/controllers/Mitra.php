<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mitra extends CI_Controller
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
    $this->load->view('mitra/v_mitra');
  }

  public function ajax_list()
  {
        $table = 'mitra';
        $column_order = array(null,"nama_mitra","kontak_mitra","email_mitra",null);
        $search = array("nama_mitra","kontak_mitra","email_mitra");
        $order = array("id_mitra" => "ASC");
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
            $row[] = $l->nama_mitra;
            $row[] = $l->kontak_mitra;
            $row[] = $l->email_mitra;
            $row[] = '<a href="'.base_url().'Mitra/Detail/'.$l->id_mitra.'"  class="btn btn-info btn-xs" title="Lihat"><i class="fa fa-eye"></i></a>
                      <a href="javascript:void(0)" onclick="updateMitra('.$l->id_mitra.')" class="btn btn-success btn-xs" title="Edit"><i class="fa fa-edit"></i></a>
                      <a href="javascript:void(0)" onclick="removeMitra('.$l->id_mitra.')" class="btn btn-danger btn-xs" title="Hapus"><i class="fa fa-trash"></i></a>';
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
      $hasil=$this->MModel->get("select * from mitra where id_mitra='$id'");
      if($hasil)
      {
        $data['detail']=$hasil;
        $this->load->view('mitra/v_detail_mitra',$data);
      }
      else {
        redirect(base_url("Error404"));
      }

    }

    function add()
    {
      $nmfile='mitra__'.time();
      $config['upload_path'] = './img/mitra/'; //path folder
      $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp'; //type yang dapat diakses bisa anda sesuaikan
      $config['encrypt_name'] = TRUE; //Enkripsi nama yang terupload
      $config['file_name']=$nmfile;

      $this->upload->initialize($config);
      if(!empty($_FILES['image']['name'])){

          if ($this->upload->do_upload('image')){
              $gbr = $this->upload->data();
              //Compress Image
              /*$config['image_library']='gd2';
              $config['source_image']='./img/mitra/'.$gbr['file_name'];
              $config['create_thumb']= FALSE;
              $config['maintain_ratio']= FALSE;
              $config['width']= 128;
              $config['height']= 64;
              $config['new_image']= './img/mitra/'.$gbr['file_name'];
              $this->load->library('image_lib', $config);
              $this->image_lib->resize();*/ 

              $gambar=$gbr['file_name'];
              $data = array(
              'foto_mitra'=>$gambar,
              'kontak_mitra'=>$this->input->post('kontak_mitra'),
              'email_mitra'=>$this->input->post('email_mitra'),
              'alamat_mitra'=>$this->input->post('alamat_mitra'),
              'nama_mitra'=>$_POST['nama_mitra'],
              'deskripsi'=>$_POST['deskripsi']
            );
            $this->MModel->add("mitra",$data);
            echo json_encode(array("status" => TRUE));

      }


      }else{
        $data = array(
        'kontak_mitra'=>$this->input->post('kontak_mitra'),
        'email_mitra'=>$this->input->post('email_mitra'),
        'alamat_mitra'=>$this->input->post('alamat_mitra'),
        'nama_mitra'=>$_POST['nama_mitra'],
        'deskripsi'=>$_POST['deskripsi']
      );
            $this->MModel->add("mitra",$data);
            echo json_encode(array("status" => TRUE));

    }
    }

    function update()
    {
      $nmfile='mitra__'.time();
      $config['upload_path'] = './img/mitra/'; //path folder
      $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp'; //type yang dapat diakses bisa anda sesuaikan
      $config['encrypt_name'] = TRUE; //Enkripsi nama yang terupload
      $config['file_name']=$nmfile;

      $this->upload->initialize($config);
      if(!empty($_FILES['image']['name'])){

          if ($this->upload->do_upload('image')){
              $gbr = $this->upload->data();
              //Compress Image
             /* $config['image_library']='gd2';
              $config['source_image']='./img/mitra/'.$gbr['file_name'];
              $config['create_thumb']= FALSE;
              $config['maintain_ratio']= FALSE;
              $config['width']= 128;
              $config['height']= 70;
              $config['new_image']= './img/mitra/'.$gbr['file_name'];
              $this->load->library('image_lib', $config);
              $this->image_lib->resize();*/

              $gambar=$gbr['file_name'];
              $data = array(
              'foto_mitra'=>$gambar,
              'kontak_mitra'=>$this->input->post('kontak_mitra'),
              'email_mitra'=>$this->input->post('email_mitra'),
              'alamat_mitra'=>$this->input->post('alamat_mitra'),
              'nama_mitra'=>$_POST['nama_mitra'],
              'deskripsi'=>$_POST['deskripsi']
            );
            $this->MModel->update("id_mitra",$this->input->post('id'),"mitra",$data);

            echo json_encode(array("status" => TRUE));

      }


      }else{
        $data = array(
        'kontak_mitra'=>$this->input->post('kontak_mitra'),
        'email_mitra'=>$this->input->post('email_mitra'),
        'alamat_mitra'=>$this->input->post('alamat_mitra'),
        'nama_mitra'=>$_POST['nama_mitra'],
        'deskripsi'=>$_POST['deskripsi']
      );
            $this->MModel->update("id_mitra",$this->input->post('id'),"mitra",$data);
            echo json_encode(array("status" => TRUE));

    }
    }

    public function get($id)
    {
      $data=$this->MModel->get("select * from mitra where id_mitra='$id'");
      echo json_encode($data);
    }

    public function hapus($id)
    {
      $this->MModel->hapus("id_mitra",$id,"mitra");
      echo json_encode(array("status"=>TRUE));

    }



}
