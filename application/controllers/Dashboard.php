<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller
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

  function getDataVisitor()
  {
    $range=$this->input->get("days");
    $data=$this->MModel->getData("select tanggal as date , hits as value from visitor where tanggal >='$range' group by tanggal order by tanggal ASC");
    echo json_encode($data);
  }

  function data()
  {
    $data=$this->MModel->getData("select Sum(hits) as value ,tanggal as label from visitor group by tanggal");
    echo json_encode($data);
  }

  public function index()
  {
    //echo $this->input->ip_address();
    $this->load->view('v_dashboard');
  }

  public function ajax_list()
  {
        $table = 'siswa';
        $column_order = array("nama","tgl","waktu","status",null);
        $search = array("nama","tgl","waktu","status",null);
        $order = array("tgl" => "DESC");
        $join_ref="rfid";
        $join="rfid.id_rfid=siswa.id_rfid";
        $this->MModel->set_data("table",$table);
        $this->MModel->set_data("join_ref",$join_ref);
        $this->MModel->set_data("join",$join);
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
            $row[] = $l->nama;
            $row[] = $l->tgl;
            $row[] = $l->waktu;
            $row[] = $l->status;
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

    




}
