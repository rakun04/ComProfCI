<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller
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
    $data['detail']=$this->MModel->get("select * from profile where id_profile='1'");
    $this->load->view('profile/v_profile',$data);
  }

  public function visi()
  {
    $data['detail']=$this->MModel->get("select * from profile where id_profile='1'");
    $this->load->view('profile/v_visi',$data);
  }


  public function ajax_list()
  {
        $table = 'profile';
        $column_order = array(null,"dibuat_pada","nama_profile",null);
        $search = array("dibuat_pada","nama_profile");
        $order = array("id_profile" => "ASC");
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
            $row[] = $l->dibuat_pada;
            $row[] = $l->nama_profile;
            $row[] = '<a href="'.base_url().'Profile/Detail/'.$l->id_profile.'"  class="btn btn-info btn-xs" title="Lihat"><i class="fa fa-eye"></i></a>
                      <a href="javascript:void(0)" onclick="updateProfile('.$l->id_profile.')" class="btn btn-success btn-xs" title="Edit"><i class="fa fa-edit"></i></a>
                      <a href="javascript:void(0)" onclick="removeProfile('.$l->id_profile.')" class="btn btn-danger btn-xs" title="Hapus"><i class="fa fa-trash"></i></a>';
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
      $data['detail']=$this->MModel->get("select * from profile where id_profile='$id'");
      $this->load->view('profile/v_detail_profile',$data);
    }

    function addVisi()
    {
      $data=array(
        "visi"=>$this->input->post("visi"),
        "misi"=>$this->input->post("misi")
      );
      $this->MModel->update("id_profile",1,"profile",$data);

      echo json_encode(array("status"=>TRUE));
    }

    function add()
    {
      $nmfile='profile__'.time();
      $config['upload_path'] = './img/profile/'; //path folder
      $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp'; //type yang dapat diakses bisa anda sesuaikan
      $config['encrypt_name'] = TRUE; //Enkripsi nama yang terupload
      $config['file_name']=$nmfile;

      $this->upload->initialize($config);

      if(!empty($_FILES['image']['name'])) {

          if ($this->upload->do_upload('image'))
          {
              $gbr = $this->upload->data();
              //Compress Image
              $config['image_library']='gd2';
              $config['source_image']='./img/profile/'.$gbr['file_name'];
              $config['create_thumb']= FALSE;
              $config['maintain_ratio']= FALSE;
              $config['width']= 250;
              $config['height']= 75;
              $config['new_image']= './img/profile/'.$gbr['file_name'];
              $this->load->library('image_lib', $config);
              $this->image_lib->resize();

              $gambar=$gbr['file_name'];
              $data = array(
                'foto_profile'=>$gambar,
                'deskripsi'=>$_POST['deskripsi'],
                'alamat'=>$_POST['alamat'],
                'email'=>$_POST['email'],
                'telepon'=>$_POST['telepon'],
                'fax'=>$_POST['fax'],
                'jam_kerja'=>$_POST['jam_kerja']
              );
            $this->MModel->update("id_profile",1,"profile",$data);
            echo json_encode(array("status" => TRUE));

          }
      } else
      {
        $data = array(
        'deskripsi'=>$this->input->post('deskripsi'),
        'alamat'=>$_POST['alamat'],
        'email'=>$_POST['email'],
        'telepon'=>$_POST['telepon'],
        'fax'=>$_POST['fax'],
        'jam_kerja'=>$_POST['jam_kerja']
      );
      $this->MModel->update("id_profile",1,"profile",$data);
      echo json_encode(array("status" => TRUE));

      }
      
    }



    public function get()
    {
      $data=$this->MModel->get("select * from profile where id_profile='1'");
      echo json_encode($data);
    }





}
