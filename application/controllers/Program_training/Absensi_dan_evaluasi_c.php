<?php
// header('Access-Control-Allow-Origin: *');
defined('BASEPATH') or exit('No direct script access allowed');

// User SPV HCMG
class Absensi_dan_evaluasi_c extends CI_Controller
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
    $data['title_head'] = 'Absensi dan Evaluasi Training';
    $this->load->view('Templates/Header_v', $data);
    $this->load->view('Templates/Navbar_v', $data);
    $this->load->view('Program_training/Absensi_dan_evaluasi_v');
    $this->load->view('Templates/Footer_v',$data);
  }
}
