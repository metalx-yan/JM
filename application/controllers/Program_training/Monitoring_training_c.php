<?php
// header('Access-Control-Allow-Origin: *');
defined('BASEPATH') or exit('No direct script access allowed');

// User SPV HCMG
class Monitoring_training_c extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('User_model');
    $this->load->model('Training_model');
    access_login();
  }

  public function index()
  {
    $jabatan = $_SESSION['jabatan'];
    $data['navbar_parent'] = navbar_perent($jabatan);
    $data['navbar_child'] = navbar_child($jabatan);
    // var_dump($data['navbar_child']);die;
    $data['title_head'] = 'Monitoring Training';
    $this->load->view('Templates/Header_v', $data);
    $this->load->view('Templates/Navbar_v', $data);
    $this->load->view('Program_training/Monitoring_training_v');
    $this->load->view('Templates/Footer_v');
  }
}
