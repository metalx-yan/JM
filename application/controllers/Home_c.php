<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home_c extends CI_Controller {
    public function __construct(){
        parent:: __construct();
        $this->load->model('User_model');
        access_login();
    }

    public function index(){
        $data['title_head'] = 'Home';
        
        $jabatan = $_SESSION['jabatan'];
        $data['navbar_parent'] = $this->User_model->get_navbar_name($jabatan,'Parent')->result_array();
        $data['navbar_child'] = $this->User_model->get_navbar_name($jabatan,'Child')->result_array();

        $this->load->view('Templates/Header_v',$data);
        $this->load->view('Templates/Navbar_v',$data);
        $this->load->view('Homev');
        $this->load->view('Templates/Footer_v');
    }
}