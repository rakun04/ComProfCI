<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Client extends CI_Controller
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
    $this->load->view('client/v_client');
  }

  public function ajax_list()
  {
        $table = 'client';
        $column_order = array(null,"nama_client","email",null);
        $search = array("nama_client","email");
        $order = array("id_client" => "ASC");
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
            $row[] = $l->nama_client;
            $row[] = $l->email;
            //if($this->session->userdata('id_anggota_sess')!=0) {
         
              $row[] = ' <a href="'.base_url().'Client/Detail/'.$l->id_client.'" class="btn btn-primary btn-xs" title="View"><i class="fa fa-eye"></i></a>
                      <a href="javascript:void(0)" onclick="updateClient('.$l->id_client.')" class="btn btn-success btn-xs" title="Edit"><i class="fa fa-edit"></i></a>
                      <a href="javascript:void(0)" onclick="removeClient('.$l->id_client.')" class="btn btn-danger btn-xs" title="Hapus"><i class="fa fa-trash"></i></a>';
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
      $data['detail']=$this->MModel->get("select * from client where id_client='$id'");
      $this->load->view('client/v_detail_client',$data);
    }

    function add()
    {
     // $this->_validateClient();
      $data = array(
        'email'=>$this->input->post("email"),
        'nama_client'=>$this->input->post('nama_client'),
        'say'=>$this->input->post('say')
      );
      $this->MModel->add("client",$data);
      echo json_encode(array("status" => TRUE));
    }

    function update()
    {
      $data = array(
        'email'=>$this->input->post("email"),
        'nama_client'=>$this->input->post('nama_client'),
        'say'=>$this->input->post('say')
      );
      $this->MModel->update("id_client",$this->input->post('id'),"client",$data);
      echo json_encode(array("status" => TRUE));

    
    }

    public function get($id)
    {
      $data=$this->MModel->get("select * from client where id_client='$id'");
      echo json_encode($data);
    }

    public function hapus($id)
    {
      $this->MModel->hapus("id_client",$id,"client");
      echo json_encode(array("status"=>TRUE));

    }

    private function _validateClient()
	  {
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

		if(strlen($_POST['nama_client']) == 3)
		{
			$data['inputerror'][] = 'nama_client';
			$data['error_string'][] = 'Nama Client harus diisi';
			$data['status'] = FALSE;
		}

		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}
	}

}
