<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Error404 extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    $this->load->model('MModel');
  }

  function index()
  {
    $this->load->view('v_error_404');

  }

  function cms_error()
  {
    $this->load->view('cms/error404');

  }




}
