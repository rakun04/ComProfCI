<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Karir extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    $this->load->model('MModel');
    
  }

  public function index()
  {
    if(!$this->session->userdata('username_sess'))
    {
      redirect(base_url().'__Login');
    }
    else
    {
      $this->load->view('karir/v_karir');
    }
    
  }

  public function ajax_list()
  {
        $table = 'karir';
        $column_order = array(null,"email","upload_cv",null);
        $search = array("email","upload_cv");
        $order = array("id_karir" => "ASC");
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
            $row[] = $l->email;
            $row[] = '<a href="'.base_url().'Karir/Detail/'.$l->id_karir.'"> View</a>';
            //if($this->session->userdata('id_anggota_sess')!=0) {
         
              $row[] = '
                      <a href="javascript:void(0)" onclick="updateKarir('.$l->id_karir.')" class="btn btn-success btn-xs" title="Edit"><i class="fa fa-edit"></i></a>
                      <a href="javascript:void(0)" onclick="removeKarir('.$l->id_karir.')" class="btn btn-danger btn-xs" title="Hapus"><i class="fa fa-trash"></i></a>';
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
      $data['detail']=$this->MModel->get("select * from karir where id_karir='$id'");
      $this->load->view('karir/v_detail_karir',$data);
    }

    function add()
    {
      $judul="karir";
      $nmfile=$judul.'--'.time();
      $config['upload_path'] = './img/karir/'; //path folder
      $config['allowed_types'] = 'pdf|doc|docx'; //type yang dapat diakses bisa anda sesuaikan
      //$config['encrypt_name'] = TRUE; //Enkripsi nama yang terkarir
      $config['file_name']=$nmfile;

      $this->upload->initialize($config);
      if(!empty($_FILES['image']['name'])){

          if ($this->upload->do_upload('image')){
              $gbr = $this->upload->data();
              //Compress Image
             /* $config['image_library']='gd2';
              $config['source_image']='./img/karir/'.$gbr['file_name'];
              $config['create_thumb']= FALSE;
              $config['maintain_ratio']= FALSE;
              $config['width']= 1145;//1380;
              $config['height']= 456;//800;
              $config['new_image']= './img/karir/'.$gbr['file_name'];
              $this->load->library('image_lib', $config);
              $this->image_lib->resize();*/

              $gambar=$gbr['file_name'];
              $data = array(
              'upload_cv'=>$gambar,
              'email'=>$this->input->post('email'),
            );
            $this->MModel->add("karir",$data);
            echo json_encode(array("status" => TRUE));
      }


      }else{
        $data = array(
        'email'=>$this->input->post('email'),
        );
        $this->MModel->add("karir",$data);
        echo json_encode(array("status" => TRUE));

    }
    }

    function update()
    {
      $judul="karir";
      $nmfile=$judul.'--'.time();
      $config['upload_path'] = './img/karir/'; //path folder
      $config['allowed_types'] = 'png|jpg|gif|jpeg'; //type yang dapat diakses bisa anda sesuaikan
    //  $config['encrypt_name'] = TRUE; //Enkripsi nama yang terkarir
      $config['file_name']=$nmfile;

      $this->upload->initialize($config);
      if(!empty($_FILES['image']['name'])){

          if ($this->upload->do_upload('image')){
              $gbr = $this->upload->data();
             /* $config['image_library']='gd2';
              $config['source_image']='./img/karir/'.$gbr['file_name'];
              $config['create_thumb']= FALSE;
              $config['maintain_ratio']= FALSE;
              $config['width']= 1145;//1380;
              $config['height']= 456;//800;
              $config['new_image']= './img/karir/'.$gbr['file_name'];
              $this->load->library('image_lib', $config);
              $this->image_lib->resize();*/

              $gambar=$gbr['file_name'];
              $data = array(
              'image'=>$gambar,
              'nama_karir'=>$this->input->post('nama_karir'),
            );
            $this->MModel->update("id_karir",$this->input->post('id'),"karir",$data);

            echo json_encode(array("status" => TRUE));

      }


      }else{
        $data = array(
        'nama_karir'=>$this->input->post('nama_karir'),
      );
            $this->MModel->update("id_karir",$this->input->post('id'),"karir",$data);
            echo json_encode(array("status" => TRUE));

    }
    }

    public function get($id)
    {
      $data=$this->MModel->get("select * from karir where id_karir='$id'");
      echo json_encode($data);
    }

    public function hapus($id)
    {
      $this->MModel->hapus("id_karir",$id,"karir");
      echo json_encode(array("status"=>TRUE));

    }

}
