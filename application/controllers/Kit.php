<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kit extends CI_Controller
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
    $this->load->view('kit/v_kit');
  }

  public function ajax_list()
  {
        $table = 'kit';
        $column_order = array(null,"no_seri","versi","status","pembeli",null);
        $search = array("no_seri","versi","status","pembeli");
        $order = array("no_seri" => "ASC");
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
            $row[] = $l->no_seri;
            $row[] = $l->versi;
            $row[] = $l->status;
            if($l->pembeli !="" || $l->pembeli != NULL)
            {
               $row[] = '<a class="btn btn-info btn-xs" href="'.base_url().'kit/Detail/'.$l->id_kit.'"><i class="fa fa-user-secret"></i> '.$l->pembeli.'</a>';
            } else {
              $row[] = '<span class="label label-danger">Belum Ada</span>';
            }
            $row[] = '<a href="javascript:void(0)" onclick="updateKit('.$l->id_kit.')" class="btn btn-success btn-xs" title="Edit"><i class="fa fa-edit"></i></a>
                      <a href="javascript:void(0)" onclick="removeKit('.$l->id_kit.')" class="btn btn-danger btn-xs" title="Hapus"><i class="fa fa-trash"></i></a>';
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
      $data['detail']=$this->MModel->get("select * from kit where id_kit='$id'");
      $this->load->view('kit/v_detail_kit',$data);
    }

    public function add()
    {
      $data=array(
        "versi"=>$this->input->post("versi"),
        "no_seri"=>$this->input->post("no_seri"),
        "status"=>"ready"
      );
      $this->MModel->add("kit",$data);
      echo json_encode(array("status"=>TRUE));
    }

    public function update()
    {
      $data=array(
        "versi"=>$this->input->post("versi"),
        "no_seri"=>$this->input->post("no_seri")
      );
      $this->MModel->update("id_kit",$this->input->post('id'),"kit",$data);
      echo json_encode(array("status"=>TRUE));
    }

    public function get($id)
    {
      $data=$this->MModel->get("select * from kit where id_kit='$id'");
      echo json_encode($data);
    }

    public function hapus($id)
    {
      $this->MModel->hapus("id_kit",$id,"kit");
      echo json_encode(array("status"=>TRUE));

    }



}
