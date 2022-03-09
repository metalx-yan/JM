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
        // untuk USER PIC TRAINING
        $jabatan = $_SESSION['jabatan'];
        $data['navbar_parent'] = navbar_perent($jabatan);
        $data['navbar_child'] = navbar_child($jabatan);
        $data['title_head'] = 'Realisasi Biaya Training';
        $this->load->view('Templates/Header_v',$data);
        $this->load->view('Templates/Navbar_v',$data);
        // $this->load->view('Program_training/Data_realisasi_biaya_training_v'); tampilan di proses pengajuan budget jika statusnya Data Realisasi Biaya Training
        $this->load->view('Program_training/Realisasi_biaya_training_v'); 
        $this->load->view('Templates/Footer_v');
    }

    // tampilan detaill di proses pengajuan budget jika statusnya Data Realisasi Biaya Training
    // public function detail_app_realisasi(){
    //     $jabatan = $_SESSION['jabatan'];
    //     $data['navbar_parent'] = navbar_perent($jabatan);
    //     $data['navbar_child'] = navbar_child($jabatan);
    //     $data['title_head'] = 'Proses Pengajuan Training';
    //     $this->load->view('Templates/Header_v',$data);
    //     $this->load->view('Templates/Navbar_v',$data);
    //     $this->load->view('Program_training/detail_app_realisasi_v');
    //     $this->load->view('Templates/Footer_v');
    // }


}