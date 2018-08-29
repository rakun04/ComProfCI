<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Servis extends CI_Controller
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
    $this->load->view('servis/v_servis');
  }

  public function ajax_list()
  {
        $table = 'servis';
        $column_order = array(null,"nama_servis",null);
        $search = array("nama_servis");
        $order = array("id_servis" => "ASC");
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
            $row[] = $l->nama_servis;
            $row[] = '<a href="'.base_url().'Servis/Detail/'.$l->id_servis.'"  class="btn btn-info btn-xs" title="Lihat"><i class="fa fa-eye"></i></a>
                      <a href="javascript:void(0)" onclick="updateServis('.$l->id_servis.')" class="btn btn-success btn-xs" title="Edit"><i class="fa fa-edit"></i></a>
                      <a href="javascript:void(0)" onclick="removeServis('.$l->id_servis.')" class="btn btn-danger btn-xs" title="Hapus"><i class="fa fa-trash"></i></a>';
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
      $hasil=$this->MModel->get("select * from servis where id_servis='$id'");
      if($hasil)
      {
        $data['detail']=$hasil;
        $this->load->view('servis/v_detail_servis',$data);
      }
      else {
        redirect(base_url("Error404"));
      }

    }

    function add()
    {
      $nmfile='servis__'.time();
      $config['upload_path'] = './img/servis/'; //path folder
      $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp'; //type yang dapat diakses bisa anda sesuaikan
      $config['encrypt_name'] = TRUE; //Enkripsi nama yang terupload
      $config['file_name']=$nmfile;

      $this->upload->initialize($config);
      if(!empty($_FILES['image']['name'])){

          if ($this->upload->do_upload('image')){
              $gbr = $this->upload->data();
              //Compress Image
              $config['image_library']='gd2';
              $config['source_image']='./img/servis/'.$gbr['file_name'];
              $config['create_thumb']= FALSE;
              $config['maintain_ratio']= FALSE;
              $config['width']= 1680;
              $config['height']= 1000;
              $config['new_image']= './img/servis/'.$gbr['file_name'];
              $this->load->library('image_lib', $config);
              $this->image_lib->resize();

              $gambar=$gbr['file_name'];
              $data = array(
              'img_servis'=>$gambar,
              'nama_servis'=>$this->input->post('nama_servis'),
              'deskripsi'=>$this->input->post('deskripsi')
            );
            $this->MModel->add("servis",$data);
            echo json_encode(array("status" => TRUE));

      }


      }else{
        $data = array(
          'nama_servis'=>$this->input->post('nama_servis'),
          'deskripsi'=>$this->input->post('deskripsi')
        );
            $this->MModel->add("servis",$data);
            echo json_encode(array("status" => TRUE));

    }
    }

    function update()
    {
      $nmfile='servis__'.time();
      $config['upload_path'] = './img/servis/'; //path folder
      $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp'; //type yang dapat diakses bisa anda sesuaikan
      $config['encrypt_name'] = TRUE; //Enkripsi nama yang terupload
      $config['file_name']=$nmfile;

      $this->upload->initialize($config);
      if(!empty($_FILES['image']['name'])){

          if ($this->upload->do_upload('image')){
              $gbr = $this->upload->data();
              //Compress Image
              $config['image_library']='gd2';
              $config['source_image']='./img/servis/'.$gbr['file_name'];
              $config['create_thumb']= FALSE;
              $config['maintain_ratio']= FALSE;
              $config['width']= 1680;
              $config['height']= 1000;
              $config['new_image']= './img/servis/'.$gbr['file_name'];
              $this->load->library('image_lib', $config);
              $this->image_lib->resize();

              $gambar=$gbr['file_name'];
              $data = array(
                'img_servis'=>$gambar,
                'nama_servis'=>$this->input->post('nama_servis'),
                'deskripsi'=>$this->input->post('deskripsi')
              );
            $this->MModel->update("id_servis",$this->input->post('id'),"servis",$data);

            echo json_encode(array("status" => TRUE));

      }


      }else{
        $data = array(
          'nama_servis'=>$this->input->post('nama_servis'),
          'deskripsi'=>$this->input->post('deskripsi')
        );
            $this->MModel->update("id_servis",$this->input->post('id'),"servis",$data);
            echo json_encode(array("status" => TRUE));

    }
    }

    function deskripsi()
    {
      $hasil=$this->MModel->get("select * from deskripsi where id_deskripsi='1'");
      if($hasil)
      {
        $data['detail']=$hasil;
        $this->load->view('servis/v_deskripsi_servis',$data);
      }
      else {
        redirect(base_url("Error404"));
      }
    }

    public function updateDeskripsi()
    {
      $data = array(
        'desc_solution'=>$this->input->post("deskripsi")
      );
      $this->MModel->update("id_deskripsi",1,"deskripsi",$data);
      echo json_encode(array("status" => TRUE));
    }

    public function get($id)
    {
      $data=$this->MModel->get("select * from servis where id_servis='$id'");
      echo json_encode($data);
    }

    public function hapus($id)
    {
      $this->MModel->hapus("id_servis",$id,"servis");
      echo json_encode(array("status"=>TRUE));

    }

    public function addSubServis()
    {
      $nmfile='servis__'.time();
      $config['upload_path'] = './img/servis/sub/'; //path folder
      $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp'; //type yang dapat diakses bisa anda sesuaikan
      $config['encrypt_name'] = TRUE; //Enkripsi nama yang terupload
      $config['file_name']=$nmfile;

      $this->upload->initialize($config);
      if(!empty($_FILES['image']['name'])){

          if ($this->upload->do_upload('image')){
              $gbr = $this->upload->data();
              //Compress Image
              $config['image_library']='gd2';
              $config['source_image']='./img/servis/sub/'.$gbr['file_name'];
              $config['create_thumb']= FALSE;
              $config['maintain_ratio']= FALSE;
              $config['width']= 1280;
              $config['height']= 720;
              $config['new_image']= './img/servis/sub/'.$gbr['file_name'];
              $this->load->library('image_lib', $config);
              $this->image_lib->resize();

              $gambar=$gbr['file_name'];
              $data=array(
                'nama_sub_kategori'=>$this->input->post("nama_sub_kategori"),
                'deskripsi_sub_kategori'=>$this->input->post("deskripsi_sub_kategori"),
                'id_servis'=>$this->input->post("id_servis"),
                'img_sub'=>$gambar
              );
              $this->MModel->add("sub_kategori",$data);
              echo json_encode(array("status" => TRUE));

      }


      }else{
        $data=array(
          'nama_sub_kategori'=>$this->input->post("nama_sub_kategori"),
          'deskripsi_sub_kategori'=>$this->input->post("deskripsi_sub_kategori"),
          'id_servis'=>$this->input->post("id_servis")
        );
        $this->MModel->add("sub_kategori",$data);
        echo json_encode(array("status" => TRUE));

    }


      
    }

    public function updateSubServis()
    {
      $nmfile='servis__'.time();
      $config['upload_path'] = './img/servis/sub/'; //path folder
      $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp'; //type yang dapat diakses bisa anda sesuaikan
      $config['encrypt_name'] = TRUE; //Enkripsi nama yang terupload
      $config['file_name']=$nmfile;

      $this->upload->initialize($config);
      if(!empty($_FILES['image']['name'])){

          if ($this->upload->do_upload('image')){
              $gbr = $this->upload->data();
              //Compress Image
              $config['image_library']='gd2';
              $config['source_image']='./img/servis/sub/'.$gbr['file_name'];
              $config['create_thumb']= FALSE;
              $config['maintain_ratio']= FALSE;
              $config['width']= 1280;
              $config['height']= 720;
              $config['new_image']= './img/servis/sub/'.$gbr['file_name'];
              $this->load->library('image_lib', $config);
              $this->image_lib->resize();

              $gambar=$gbr['file_name'];
              $data=array(
                'nama_sub_kategori'=>$this->input->post("nama_sub_kategori"),
                'deskripsi_sub_kategori'=>$this->input->post("deskripsi_sub_kategori"),
               // 'id_servis'=>$this->input->post("id_servis"),
                'img_sub'=>$gambar
              );
              $this->MModel->update("id_sub_kategori",$this->input->post('id'),"sub_kategori",$data);
              echo json_encode(array("status" => TRUE));

      }


      }else{
        $data=array(
          'nama_sub_kategori'=>$this->input->post("nama_sub_kategori"),
          'deskripsi_sub_kategori'=>$this->input->post("deskripsi_sub_kategori")
         // 'id_servis'=>$this->input->post("id_servis")
        );
        $this->MModel->update("id_sub_kategori",$this->input->post('id'),"sub_kategori",$data);
        echo json_encode(array("status" => TRUE));

    }


      
      
    }

    public function getSubServis($id)
    {
      $data=$this->MModel->get("select * from sub_kategori where id_sub_kategori='$id'");
      echo json_encode($data);
    }

    public function hapusSubServis($id)
    {
      $this->MModel->hapus("id_sub_kategori",$id,"sub_kategori");
      echo json_encode(array("status"=>TRUE));

    }



}
