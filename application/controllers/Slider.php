<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Slider extends CI_Controller
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
    $this->load->view('slider/v_slider');
  }

  public function ajax_list()
  {
        $table = 'slider';
        $column_order = array(null,"nama_slider","image",null);
        $search = array("nama_slider","image");
        $order = array("id_slider" => "ASC");
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
            $row[] = $l->nama_slider;
            $row[] = '<img src="'.base_url().'img/slider/'.$l->image.'" class="img-thumbnail" height="100px" width="100px">';
            //if($this->session->userdata('id_anggota_sess')!=0) {
            if($l->tampilkan=='Y') {
              $row[]="<a href='".base_url().'Slider/UpdateTampilkan/'.$l->id_slider.'/'.$l->tampilkan."' class='btn btn-success btn-sm'><i class='fa fa-eye'></i></a>";
            }else{
              $row[]="<a href='".base_url().'Slider/UpdateTampilkan/'.$l->id_slider.'/'.$l->tampilkan."' class='btn btn-sm btn-danger'><i class='fa fa-eye-slash'></i></a>";
            }
              $row[] = '
                      <a href="javascript:void(0)" onclick="updateSlider('.$l->id_slider.')" class="btn btn-success btn-xs" title="Edit"><i class="fa fa-edit"></i></a>
                      <a href="javascript:void(0)" onclick="removeSlider('.$l->id_slider.')" class="btn btn-danger btn-xs" title="Hapus"><i class="fa fa-trash"></i></a>';
            //}
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
      $data['detail']=$this->MModel->get("select * from slider where id_slider='$id'");
      $this->load->view('slider/v_detail_slider',$data);
    }

    function add()
    {
      $judul="slider";
      $nmfile=$judul.'--'.time();
      $config['upload_path'] = './img/slider/'; //path folder
      $config['allowed_types'] = 'png|jpg|gif|jpeg'; //type yang dapat diakses bisa anda sesuaikan
      //$config['encrypt_name'] = TRUE; //Enkripsi nama yang terslider
      $config['file_name']=$nmfile;

      $this->upload->initialize($config);
      if(!empty($_FILES['image']['name'])){

          if ($this->upload->do_upload('image')){
              $gbr = $this->upload->data();
              //Compress Image
              $config['image_library']='gd2';
              $config['source_image']='./img/slider/'.$gbr['file_name'];
              $config['create_thumb']= FALSE;
              $config['maintain_ratio']= FALSE;
              $config['width']= 1380 ;//1145; //;
              $config['height']=800; //456;//
              $config['new_image']= './img/slider/'.$gbr['file_name'];
              $this->load->library('image_lib', $config);
              $this->image_lib->resize();

              $gambar=$gbr['file_name'];
              $data = array(
              'image'=>$gambar,
              'nama_slider'=>$this->input->post('nama_slider'),
            );
            $this->MModel->add("slider",$data);
            echo json_encode(array("status" => TRUE));
      }


      }else{
        $data = array(
        'nama_slider'=>$this->input->post('nama_slider'),
      );
            $this->MModel->add("slider",$data);
            echo json_encode(array("status" => TRUE));

    }
    }

    function update()
    {
      $judul="slider";
      $nmfile=$judul.'--'.time();
      $config['upload_path'] = './img/slider/'; //path folder
      $config['allowed_types'] = 'png|jpg|gif|jpeg'; //type yang dapat diakses bisa anda sesuaikan
    //  $config['encrypt_name'] = TRUE; //Enkripsi nama yang terslider
      $config['file_name']=$nmfile;

      $this->upload->initialize($config);
      if(!empty($_FILES['image']['name'])){

          if ($this->upload->do_upload('image')){
              $gbr = $this->upload->data();
              $config['image_library']='gd2';
              $config['source_image']='./img/slider/'.$gbr['file_name'];
              $config['create_thumb']= FALSE;
              $config['maintain_ratio']= FALSE;
              $config['width']= 1380 ;//1145; //;
              $config['height']=800; //456;//
              $config['new_image']= './img/slider/'.$gbr['file_name'];
              $this->load->library('image_lib', $config);
              $this->image_lib->resize();

              $gambar=$gbr['file_name'];
              $data = array(
              'image'=>$gambar,
              'nama_slider'=>$this->input->post('nama_slider'),
            );
            $this->MModel->update("id_slider",$this->input->post('id'),"slider",$data);

            echo json_encode(array("status" => TRUE));

      }


      }else{
        $data = array(
        'nama_slider'=>$this->input->post('nama_slider'),
      );
            $this->MModel->update("id_slider",$this->input->post('id'),"slider",$data);
            echo json_encode(array("status" => TRUE));

    }
    }

    public function get($id)
    {
      $data=$this->MModel->get("select * from slider where id_slider='$id'");
      echo json_encode($data);
    }

    public function hapus($id)
    {
      $hasil=$this->MModel->getData("select * from slider where id_slider='$id'");
      if($hasil)
      {
        unlink(base_url().'img/slider/'.$hasil->image);
      }
      
      $this->MModel->hapus("id_slider",$id,"slider");
      echo json_encode(array("status"=>TRUE));

    }


    function updateTampilkan($id,$status)
    {
      if($status=="Y")
      {
        $data=array("tampilkan"=>"N");
      }
      else
      {
        $data=array("tampilkan"=>"Y");
      }

      $this->MModel->update("id_slider",$id,"slider",$data);
      redirect(base_url().'Slider');
    }



}
