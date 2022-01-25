<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Realisasi_biaya_training_c extends CI_Controller {
    public function __construct(){
        parent:: __construct();
        $this->load->model('User_model');
        access_login();
    }

    public function index(){
        // $session = $_SESSION;
        // var_dump($session);die;
        $jabatan = $_SESSION['jabatan'];
        $data['navbar_parent'] = $this->User_model->get_navbar_name($jabatan,'Parent')->result_array();
        $data['navbar_child'] = $this->User_model->get_child_name($jabatan,'Child')->result_array();
        $data['title_head'] = 'Realisasi Biaya Training';
        $this->load->view('Templates/Header_v',$data);
        $this->load->view('Templates/Navbar_v',$data);
        $this->load->view('Program_training/Realisasi_biaya_training_v');
        $this->load->view('Templates/Footer_v');
    }

    public function detail_app_realisasi(){
        $jabatan = $_SESSION['jabatan'];
        $data['navbar_parent'] = $this->User_model->get_navbar_name($jabatan,'Parent')->result_array();
        $data['navbar_child'] = $this->User_model->get_child_name($jabatan,'Child')->result_array();
        $data['title_head'] = 'Proses Pengajuan Training';
        $this->load->view('Templates/Header_v',$data);
        $this->load->view('Templates/Navbar_v',$data);
        $this->load->view('Program_training/detail_app_realisasi_v');
        $this->load->view('Templates/Footer_v');
    }
}