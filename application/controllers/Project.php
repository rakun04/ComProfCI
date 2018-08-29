<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Project extends CI_Controller
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
    $this->load->view('project/v_project');
  }

  public function ajax_list()
  {
        $table = 'project';
        $column_order = array(null,"status","dibuat_pada","nama_project",null);
        $search = array("status","tgl_mulai","tgl_selesai","judul_project");
        $order = array("id_project" => "ASC");
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
            $row[] = $l->status;
            $row[] = $l->dibuat_pada;
            $row[] = $l->nama_project;
            $row[] = $l->client;
            $row[] = '<a href="'.$l->link.'">'.$l->link.'</a>';
            $row[] = '<a href="'.base_url().'Project/Detail/'.$l->id_project.'"  class="btn btn-info btn-xs" title="Lihat"><i class="fa fa-eye"></i></a>
                      <a href="javascript:void(0)" onclick="updateProject('.$l->id_project.')" class="btn btn-success btn-xs" title="Edit"><i class="fa fa-edit"></i></a>
                      <a href="javascript:void(0)" onclick="removeProject('.$l->id_project.')" class="btn btn-danger btn-xs" title="Hapus"><i class="fa fa-trash"></i></a>';
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
      $data['detail']=$this->MModel->get("select * from project where id_project='$id'");
      $this->load->view('project/v_detail_project',$data);
    }

    function add()
    {
      $nmfile='project__'.time();
      $config['upload_path'] = './img/project/'; //path folder
      $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp'; //type yang dapat diakses bisa anda sesuaikan
      $config['encrypt_name'] = TRUE; //Enkripsi nama yang terupload
      $config['file_name']=$nmfile;

      $this->upload->initialize($config);
      if(!empty($_FILES['image']['name'])){

          if ($this->upload->do_upload('image')){
              $gbr = $this->upload->data();
              //Compress Image
              $config['image_library']='gd2';
              $config['source_image']='./img/project/'.$gbr['file_name'];
              $config['create_thumb']= FALSE;
              $config['maintain_ratio']= FALSE;
              $config['width']= 600;
              $config['height']= 400;
              $config['new_image']= './img/project/'.$gbr['file_name'];
              $this->load->library('image_lib', $config);
              $this->image_lib->resize();

              $gambar=$gbr['file_name'];
              $data = array(
              'foto_project'=>$gambar,
              'dibuat_pada'=>$this->input->post('dibuat_pada'),
              'client'=>$this->input->post('client'),
              'link'=>$this->input->post('link'),
              'nama_project'=>$_POST['nama_project'],
              'deskripsi'=>$_POST['deskripsi'],
              'status'=>$_POST['status']
            );
            $this->MModel->add("project",$data);
            echo json_encode(array("status" => TRUE));

      }


      }else{
        $data = array(
        'dibuat_pada'=>$this->input->post('dibuat_pada'),
        'client'=>$this->input->post('client'),
        'link'=>$this->input->post('link'),
        'nama_project'=>$_POST['nama_project'],
        'deskripsi'=>$_POST['deskripsi'],
        'status'=>$_POST['status']
      );
            $this->MModel->add("project",$data);
            echo json_encode(array("status" => TRUE));

    }
    }

    function update()
    {
      $nmfile='project__'.time();
      $config['upload_path'] = './img/project/'; //path folder
      $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp'; //type yang dapat diakses bisa anda sesuaikan
      $config['encrypt_name'] = TRUE; //Enkripsi nama yang terupload
      $config['file_name']=$nmfile;

      $this->upload->initialize($config);
      if(!empty($_FILES['image']['name'])){

          if ($this->upload->do_upload('image')){
              $gbr = $this->upload->data();
              //Compress Image
              $config['image_library']='gd2';
              $config['source_image']='./img/project/'.$gbr['file_name'];
              $config['create_thumb']= FALSE;
              $config['maintain_ratio']= FALSE;
              $config['width']= 600;
              $config['height']= 400;
              $config['new_image']= './img/project/'.$gbr['file_name'];
              $this->load->library('image_lib', $config);
              $this->image_lib->resize();

              $gambar=$gbr['file_name'];
              $data = array(
              'foto_project'=>$gambar,
              'dibuat_pada'=>$this->input->post('dibuat_pada'),
              'client'=>$this->input->post('client'),
              'link'=>$this->input->post('link'),
              'nama_project'=>$_POST['nama_project'],
              'deskripsi'=>$_POST['deskripsi'],
              'status'=>$_POST['status']
            );
            $this->MModel->update("id_project",$this->input->post('id'),"project",$data);

            echo json_encode(array("status" => TRUE));

      }


      }else{
        $data = array(
        'dibuat_pada'=>$this->input->post('dibuat_pada'),
        'client'=>$this->input->post('client'),
        'link'=>$this->input->post('link'),
        'nama_project'=>$_POST['nama_project'],
        'deskripsi'=>$_POST['deskripsi'],
        'status'=>$_POST['status']
      );
            $this->MModel->update("id_project",$this->input->post('id'),"project",$data);
            echo json_encode(array("status" => TRUE));

    }
    }

    public function get($id)
    {
      $data=$this->MModel->get("select * from project where id_project='$id'");
      echo json_encode($data);
    }

    public function hapus($id)
    {
      $this->MModel->hapus("id_project",$id,"project");
      echo json_encode(array("status"=>TRUE));

    }



}
