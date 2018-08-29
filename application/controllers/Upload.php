<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Upload extends CI_Controller
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
    $this->load->view('upload/v_upload');
  }

  public function ajax_list()
  {
        $table = 'upload';
        $column_order = array(null,"judul","file",null);
        $search = array("judul","file");
        $order = array("id_upload" => "ASC");
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
            $row[] = $l->judul;
            $row[] = '<a href="'.base_url().'img/upload/'.$l->file.'">Link Download</a>';
            if($this->session->userdata('id_anggota_sess')!=0) {
            $row[] = '
                      <a href="javascript:void(0)" onclick="updateUpload('.$l->id_upload.')" class="btn btn-success btn-xs" title="Edit"><i class="fa fa-edit"></i></a>
                      <a href="javascript:void(0)" onclick="removeUpload('.$l->id_upload.')" class="btn btn-danger btn-xs" title="Hapus"><i class="fa fa-trash"></i></a>';
            }
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
      $data['detail']=$this->MModel->get("select * from upload where id_upload='$id'");
      $this->load->view('upload/v_detail_upload',$data);
    }

    function add()
    {
      $judul=$this->input->post('judul');
      $nmfile=$judul.'--'.time();
      $config['upload_path'] = './img/upload/'; //path folder
      $config['allowed_types'] = 'pdf|zip|rar|apk|doc|docx'; //type yang dapat diakses bisa anda sesuaikan
      //$config['encrypt_name'] = TRUE; //Enkripsi nama yang terupload
      $config['file_name']=$nmfile;

      $this->upload->initialize($config);
      if(!empty($_FILES['image']['name'])){

          if ($this->upload->do_upload('image')){
              $gbr = $this->upload->data();
              //Compress Image
              $gambar=$gbr['file_name'];
              $data = array(
              'file'=>$gambar,
              'judul'=>$this->input->post('judul'),
            );
            $this->MModel->add("upload",$data);
            echo json_encode(array("status" => TRUE));
      }


      }else{
        $data = array(
        'judul'=>$this->input->post('judul'),
      );
            $this->MModel->add("upload",$data);
            echo json_encode(array("status" => TRUE));

    }
    }

    function update()
    {
      $judul=$this->input->post('judul');
      $nmfile=$judul.'--'.time();
      $config['upload_path'] = './img/upload/'; //path folder
      $config['allowed_types'] = 'pdf|zip|rar|apk|doc|docx'; //type yang dapat diakses bisa anda sesuaikan
    //  $config['encrypt_name'] = TRUE; //Enkripsi nama yang terupload
      $config['file_name']=$nmfile;

      $this->upload->initialize($config);
      if(!empty($_FILES['image']['name'])){

          if ($this->upload->do_upload('image')){
              $gbr = $this->upload->data();


              $gambar=$gbr['file_name'];
              $data = array(
              'file'=>$gambar,
              'judul'=>$this->input->post('judul'),
            );
            $this->MModel->update("id_upload",$this->input->post('id'),"upload",$data);

            echo json_encode(array("status" => TRUE));

      }


      }else{
        $data = array(
        'judul'=>$this->input->post('judul'),
      );
            $this->MModel->update("id_upload",$this->input->post('id'),"upload",$data);
            echo json_encode(array("status" => TRUE));

    }
    }

    public function get($id)
    {
      $data=$this->MModel->get("select * from upload where id_upload='$id'");
      echo json_encode($data);
    }

    public function hapus($id)
    {
      $this->MModel->hapus("id_upload",$id,"upload");
      echo json_encode(array("status"=>TRUE));

    }



}
