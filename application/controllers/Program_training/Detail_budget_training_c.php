<?php
// header('Access-Control-Allow-Origin: *');
defined('BASEPATH') or exit('No direct script access allowed');

class Detail_budget_training_c extends CI_Controller
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
        $data['title_head'] = 'Detail Budget Training';
        $this->load->view('Templates/Header_v', $data);
        $this->load->view('Templates/Navbar_v', $data);
        $this->load->view('Program_training/Detail_budget_training_v');
        $this->load->view('Templates/Footer_v');
    }

    public function detail_ppt()
    {
        $status_proses = 'REVIEW BY ADMIN';
        $no_md = $this->input->get('no_md');
        // $get_data =  $this->Training_model->read_data(null, null, null, $no_md, $status_proses);
        // $data['get_data'] =  json_decode($get_data)->data;
        $data['get_data'] =  $this->db->get_where('training_inquiry',['nomor_pengajuan'=>$no_md])->row();
        $jabatan = $_SESSION['jabatan'];
        $data['navbar_parent'] = navbar_perent($jabatan);
        $data['navbar_child'] = navbar_child($jabatan);
        $data['title_head'] = 'Data Detail Training dan Detail Budget';
        $this->load->view('Templates/Header_v', $data);
        $this->load->view('Templates/Navbar_v', $data);
        $this->load->view('Program_training/Input_ddt_db_v_copy', $data);
        $this->load->view('Templates/Footer_v');
    }
  }