<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Video extends CI_Controller
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
    $this->load->view('video/v_video');
  }

  public function ajax_list()
  {
        $table = 'video';
        $column_order = array(null,"judul_video","video",null);
        $search = array("judul_video","video");
        $order = array("id_video" => "ASC");
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
            $row[] = $l->judul_video;
            $row[] = '<a href="javascript:void(0)" onclick="viewVideo('.$l->id_video.')" > '.$l->video.' </a>';
            //if($this->session->userdata('id_anggota_sess')!=0) 
              $row[] = '
                      <a href="javascript:void(0)" onclick="updateVideo('.$l->id_video.')" class="btn btn-success btn-xs" title="Edit"><i class="fa fa-edit"></i></a>
                      <a href="javascript:void(0)" onclick="removeVideo('.$l->id_video.')" class="btn btn-danger btn-xs" title="Hapus"><i class="fa fa-trash"></i></a>';
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

    function deskripsi()
    {
      $hasil=$this->MModel->get("select * from deskripsi where id_deskripsi='1'");
      if($hasil)
      {
        $data['detail']=$hasil;
        $this->load->view('video/v_deskripsi_video',$data);
      }
      else {
        redirect(base_url("Error404"));
      }
    }

    public function updateDeskripsi()
    {
      $data = array(
        'desc_data_center'=>$this->input->post("deskripsi")
      );
      $this->MModel->update("id_deskripsi",1,"deskripsi",$data);
      echo json_encode(array("status" => TRUE));
    }

    function Detail($id)
    {
      $data['detail']=$this->MModel->get("select * from video where id_video='$id'");
      $this->load->view('video/v_detail_video',$data);
    }

    function add()
    {

/*      $file				= 'image';
      $config['upload_path']		= '.img/video/';
      $config['allowed_types'] 	= 'mov|mpeg|mp4|avi|wmv';
      $config['max_size']		= '50000';
      $config['max_width']  		= '';
      $config['max_height']  		= '';
      
      $this->upload->initialize($config);
      $this->load->library('upload', $config);
      
      if(!$this->upload->do_upload('image'))
      {
        // If there is any error
        $err_msgs .= 'Error in Uploading video '.$this->upload->display_errors().'<br />';
        json_encode(array("status"=>FALSE));
      }
      else
      {
        $data=array('upload_data' => $this->upload->data());
        $video_path = $data['upload_data']['file_name'];
      
        $directory_path 	 = $data['upload_data']['file_path'];
        $directory_path_full      = $data['upload_data']['full_path'];
        $file_name 		= $data['upload_data']['raw_name'];
        
        // ffmpeg command to convert video
              
        exec("ffmpeg -i ".$directory_path_full." ".$directory_path.$file_name.".flv"); 
      // $file_name is same file name that is being uploaded but you can give your custom video name after converting So use something like myfile.flv.
        
        /// In the end update video name in DB 
        $array = array(
          'judul_video'=>$this->input->post("nama_video"),
          'video' => $file_name.'.'.'flv',
          );

        $this->MModel->add("video",$array);
        echo json_encode(array("status"=>TRUE));
        
      }*/


      $judul="video";
      $nmfile= time();
      $config['upload_path'] = './img/video/'; //path folder
      $config['allowed_types'] = 'mov|mpeg|mp4|avi|wmv'; //type yang dapat diakses bisa anda sesuaikan
      //$config['encrypt_name'] = TRUE; //Enkripsi nama yang tervideo
      $config['file_name']=$nmfile;

      $this->upload->initialize($config);
      if(!empty($_FILES['image']['name'])){

          if ($this->upload->do_upload('image')){
              $gbr = $this->upload->data();
              //Compress Image
              /*$config['image_library']='gd2';
              $config['source_image']='./img/video/'.$gbr['file_name'];
              $config['create_thumb']= FALSE;
              $config['maintain_ratio']= FALSE;
              $config['width']= 1380 ;//1145; //;
              $config['height']=800; //456;//
              $config['new_image']= './img/video/'.$gbr['file_name'];
              $this->load->library('image_lib', $config);
              $this->image_lib->resize();*/

              $gambar=$gbr['file_name'];
              $data = array(
              'video'=>$gambar,
              'judul_video'=>$this->input->post('nama_video'),
            );
            $this->MModel->add("video",$data);
            echo json_encode(array("status" => TRUE));
      }


      }else{
        $data = array(
        'nama_video'=>$this->input->post('nama_video'),
      );
            $this->MModel->add("video",$data);
            echo json_encode(array("status" => TRUE));

      }
    }

    function update()
    {
      $judul="video";
      $nmfile=$judul.'--'.time();
      $config['upload_path'] = './img/video/'; //path folder
      $config['allowed_types'] = 'png|jpg|gif|jpeg'; //type yang dapat diakses bisa anda sesuaikan
    //  $config['encrypt_name'] = TRUE; //Enkripsi nama yang tervideo
      $config['file_name']=$nmfile;

      $this->upload->initialize($config);
      if(!empty($_FILES['image']['name'])){

          if ($this->upload->do_upload('image')){
              $gbr = $this->upload->data();
              
              /*$config['image_library']='gd2';
              $config['source_image']='./img/video/'.$gbr['file_name'];
              $config['create_thumb']= FALSE;
              $config['maintain_ratio']= FALSE;
              $config['width']= 1380 ;//1145; //;
              $config['height']=800; //456;//
              $config['new_image']= './img/video/'.$gbr['file_name'];
              $this->load->library('image_lib', $config);
              $this->image_lib->resize();*/

              $gambar=$gbr['file_name'];
              $data = array(
                'video'=>$gambar,
                'judul_video'=>$this->input->post('nama_video'),
              );
            $this->MModel->update("id_video",$this->input->post('id'),"video",$data);

            echo json_encode(array("status" => TRUE));

      }


      }else{
        $data = array(
        'nama_video'=>$this->input->post('nama_video'),
      );
            $this->MModel->update("id_video",$this->input->post('id'),"video",$data);
            echo json_encode(array("status" => TRUE));

    }
    }

    public function get($id)
    {
      $data=$this->MModel->get("select * from video where id_video='$id'");
      echo json_encode($data);
    }

    public function hapus($id)
    {
      $hasil=$this->MModel->getData("select * from video where id_video='$id'");
      if($hasil)
      {
        unlink(base_url().'img/video/'.$hasil->image);
      }
      
      $this->MModel->hapus("id_video",$id,"video");
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

      $this->MModel->update("id_video",$id,"video",$data);
      redirect(base_url().'Video');
    }



}