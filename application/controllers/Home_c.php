<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home_c extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model');
        access_login();
    }

    public function index()
    {
        $data['title_head'] = 'Home';
        $jabatan = $_SESSION['jabatan'];
        $data['navbar_parent'] = navbar_perent($jabatan);
        $data['navbar_child'] = navbar_child($jabatan);

        $this->load->view('Templates/Header_v', $data);
        $this->load->view('Templates/Navbar_v', $data);
        $this->load->view('Homev');
        $this->load->view('Templates/Footer_v');
    }
}
