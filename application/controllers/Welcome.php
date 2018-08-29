<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    $this->load->model('MModel');
    visitor();
  }

  function index()
  {
    
    $this->load->view('cms/index');

  }

  function about()
  {
    $this->load->view('cms/about');

  }

  function contact()
  {
    $this->load->view('cms/contact');

  }

  function portofolio($page=0)
  {
    $config['base_url'] = base_url().'Welcome/portofolio/';
    $config['total_rows'] = $this->db->count_all_results('product');
    $config['per_page'] = '9';
    $from = $this->uri->segment(3);

    $config['query_string_segment'] = 'start';

    $config['full_tag_open'] = '<nav><ul class="pagination pull-right">';
    $config['full_tag_close'] = '</ul></nav>';

    $config['first_link'] = 'First';
    $config['first_tag_open'] = '<li>';
    $config['first_tag_close'] = '</li>';

    $config['last_link'] = 'Last';
    $config['last_tag_open'] = '<li>';
    $config['last_tag_close'] = '</li>';

    $config['next_link'] = 'Next';
    $config['next_tag_open'] = '<li>';
    $config['next_tag_close'] = '</li>';

    $config['prev_link'] = 'Prev';
    $config['prev_tag_open'] = '<li>';
    $config['prev_tag_close'] = '</li>';

    $config['cur_tag_open'] = '<li class="active"><a>';
    $config['cur_tag_close'] = '</a></li>';

    $config['num_tag_open'] = '<li>';
    $config['num_tag_close'] = '</li>';

    $this->pagination->initialize($config);


    $data['data']=$this->MModel->getLimit($page,'id_product','9','product');
    $data['page']=$this->pagination->create_links();

    $this->load->view('cms/portofolio',$data);

  }

  function info($page=0)
  {
    $config['base_url'] = base_url().'Welcome/info/';
    $config['total_rows'] = $this->db->count_all_results('product');
    $config['per_page'] = '9';
    $from = $this->uri->segment(3);

    $config['query_string_segment'] = 'start';

    $config['full_tag_open'] = '<nav><ul class="pagination pull-right">';
    $config['full_tag_close'] = '</ul></nav>';

    $config['first_link'] = 'First';
    $config['first_tag_open'] = '<li>';
    $config['first_tag_close'] = '</li>';

    $config['last_link'] = 'Last';
    $config['last_tag_open'] = '<li>';
    $config['last_tag_close'] = '</li>';

    $config['next_link'] = 'Next';
    $config['next_tag_open'] = '<li>';
    $config['next_tag_close'] = '</li>';

    $config['prev_link'] = 'Prev';
    $config['prev_tag_open'] = '<li>';
    $config['prev_tag_close'] = '</li>';

    $config['cur_tag_open'] = '<li class="active"><a>';
    $config['cur_tag_close'] = '</a></li>';

    $config['num_tag_open'] = '<li>';
    $config['num_tag_close'] = '</li>';

    $this->pagination->initialize($config);


    $data['data']=$this->MModel->getLimit($page,'id_info','9','info');
    $data['page']=$this->pagination->create_links();

    $this->load->view('cms/info',$data);

  }

  function team($page=0)
  {
    $config['base_url'] = base_url().'Welcome/team/';
    $config['total_rows'] = $this->db->count_all_results('anggota');
    $config['per_page'] = '12';
    $from = $this->uri->segment(3);

    $config['query_string_segment'] = 'start';

    $config['full_tag_open'] = '<nav><ul class="pagination pull-right">';
    $config['full_tag_close'] = '</ul></nav>';

    $config['first_link'] = 'First';
    $config['first_tag_open'] = '<li>';
    $config['first_tag_close'] = '</li>';

    $config['last_link'] = 'Last';
    $config['last_tag_open'] = '<li>';
    $config['last_tag_close'] = '</li>';

    $config['next_link'] = 'Next';
    $config['next_tag_open'] = '<li>';
    $config['next_tag_close'] = '</li>';

    $config['prev_link'] = 'Prev';
    $config['prev_tag_open'] = '<li>';
    $config['prev_tag_close'] = '</li>';

    $config['cur_tag_open'] = '<li class="active"><a>';
    $config['cur_tag_close'] = '</a></li>';

    $config['num_tag_open'] = '<li>';
    $config['num_tag_close'] = '</li>';

    $this->pagination->initialize($config);


    $data['data']=$this->MModel->getLimit($page,'id_anggota','12','anggota');
    $data['page']=$this->pagination->create_links();

    $this->load->view('cms/team',$data);

  }

  function detTeam($id)
  {
    $hasil=$this->MModel->get("select * from anggota where id_anggota='$id'");
    if($hasil)
    {
      $data['detail']=$hasil;
      $this->load->view('cms/detailTeam',$data);
    }
    else
    {
      redirect(base_url().'Error404/cms_error');
    }
    

  }

  function detServis($id)
  {
    $hasil=$this->MModel->get("select * from servis where id_servis='$id'");
    if($hasil)
    {
      $data['detail']=$hasil;
      $this->load->view('cms/detServis',$data);
    }
    else
    {
      redirect(base_url().'Error404/cms_error');
    }
    

  }

  function detProduk($id)
  {
    $hasil=$this->MModel->get("select * from product where id_product='$id'");
    if($hasil)
    {
      $data['detail']=$hasil;
      $this->load->view('cms/detProduk',$data);
    }
    else
    {
      redirect(base_url().'Error404/cms_error');
    }
   

  }

  function getSubServis($id)
  {
    $data=$this->MModel->get("select * from sub_kategori where id_sub_kategori='$id'");
    echo json_encode($data);
  }

  


}
