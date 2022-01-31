<?php
// header('Access-Control-Allow-Origin: *');
defined('BASEPATH') or exit('No direct script access allowed');

class MD_pengajuan_training_c extends CI_Controller
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
        $data['navbar_parent'] = $this->User_model->get_navbar_name($jabatan, 'Parent')->result_array();
        $data['navbar_child'] = $this->User_model->get_child_name($jabatan, 'Child')->result_array();
        // var_dump($data['navbar_child']);die;
        $data['title_head'] = 'MD Pengajuan Training';
        $this->load->view('Templates/Header_v', $data);
        $this->load->view('Templates/Navbar_v', $data);
        $this->load->view('Program_training/MD_pengajuan_training_v');
        $this->load->view('Templates/Footer_v');
    }


    function view_data_query()
    {
        $status_proses = 'ADMIN NON MEMO';
        $start = $this->input->post('start');
        $length = $this->input->post('length');
        $search = $this->input->post('search');
        $modal = $this->input->post('modal');
        $no_md = $this->input->post('no_md');
        $admin_hcmg = $this->input->post('staff_hcmg');
        // var_dump($admin_hcmg);

        if ($admin_hcmg) {
            $save_staff = $this->Training_model->save_staff($no_md, $admin_hcmg);
            // $msg = json_decode($save_staff);
            header('Content-Type: application/json');
            // echo $json_encode;
            echo $save_staff;
        } else {
            if ($modal == 'modal') {
                // get data detail by no md
                $data_get =  $this->Training_model->read_data(null, null, null, $no_md, $status_proses);
                // var_dump($data_get);die;
                $status = json_decode($data_get)->status;
                if ($status === true) {
                    $data['datas'] = json_decode($data_get)->data;
                    //  get data staff hcmg
                    $get_staff = $this->Training_model->get_staff();


                    $data['staff'] = json_decode($get_staff)->data;
                    // var_dump($data['staff']);

                    // get script tag html
                    $modal_html = $this->load->view('Modal/Modal_program_training', $data, TRUE);
                    echo json_encode(["status" => $status, "modal" => $modal_html]);
                } else {
                    echo json_encode(["status" => $status, "msg" => json_decode($data_get)->msg]);
                    //  json_decode($data_get)->msg;
                }
            } else {
                $json_encode =  $this->Training_model->read_data($start, $length, $search['value'], null, $status_proses);
                header('Content-Type: application/json');
                echo $json_encode;
            }
        }
    }
}
