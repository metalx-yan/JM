<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Proses_pengajuan_training_c extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->model('Training_model');
        $this->load->model('Training_parameter');
        access_login();
    }

    public function index()
    {
        $data['status_data'] = json_decode($this->Training_model->status_data())->data;
        $jabatan = $_SESSION['jabatan'];
        $data['navbar_parent'] = navbar_perent($jabatan);
        $data['navbar_child'] = navbar_child($jabatan);
        // var_dump(($data['navbar_child']));die;
        $data['title_head'] = 'Proses Pengajuan Training';
        $this->load->view('Templates/Header_v', $data);
        $this->load->view('Templates/Navbar_v', $data);
        $this->load->view('Program_training/Proses_pengajuan_training_v', $data);
        $this->load->view('Templates/Footer_v');
    }

    public function detail_ppt()
    {
        $jabatan = $_SESSION['jabatan'];
        $status_proses = 'REVIEW BY ADMIN';
        $no_md = $this->input->get('no_md');
        $get_data =  $this->Training_model->read_data(null, null, null, $no_md, $status_proses);

        $data['get_data'] =  json_decode($get_data)->data;
        $data['navbar_parent'] = navbar_perent($jabatan);
        $data['navbar_child'] = navbar_child($jabatan);
        $data['title_head'] = 'Proses Pengajuan Training';

        // data parameter
        $data['program_training'] = $this->Training_parameter->get_('nama_program')->result_array();
        $data['jenis_pelatihan'] = $this->Training_parameter->get_('jenis_pelatihan')->result_array();
        $data['vendor'] = $this->Training_parameter->get_('vendor')->result_array();
        $data['status_vendor'] = $this->Training_parameter->get_('status_vendor')->result_array();
        $data['fasilitator'] = $this->Training_parameter->get_('fasilitator')->result_array();
        $data['penyelenggara'] = $this->Training_parameter->get_('penyelenggara')->result_array();
        $data['ruangan_training'] = $this->Training_parameter->get_('ruangan_training')->result_array();

        $this->load->view('Templates/Header_v', $data);
        $this->load->view('Templates/Navbar_v', $data);
        $this->load->view('Program_training/Input_ddt_db_v', $data);
        $this->load->view('Templates/Footer_v');
    }


    function view_data_query()
    {
        $status_proses = 'REVIEW BY ADMIN';
        $status_non = $this->input->post('status_non');
        $start = $this->input->post('start');
        $length = $this->input->post('length');
        $search = $this->input->post('search');
        // $no_md = $this->input->post('no_md');

        $json_encode =  $this->Training_model->read_proses_data($start, $length, $search['value'], null, $status_proses,$status_non);
        header('Content-Type: application/json');
        echo $json_encode;
    }


    function detail_peserta()
    {
        $no_md = $this->input->post('no_md');
        $modal = $this->input->post('modal');
        $status = true;
        if ($modal == 'modal') {
            $data_peserta = $this->Training_model->peserta_train($no_md);
            $data['data_peserta'] = json_decode($data_peserta)->data;
            $data['training'] = $this->input->post('training');
            $modal_html = $this->load->view('Modal/Modal_detail_peserta', $data, TRUE);

            echo json_encode(["status" => $status, "modal" => $modal_html]);
        }
    }


    // table realisasi 
    // public function table_realisasi_training(){

    // }

    // check weekend
    function isWeekend($date) {
        return (date('N', strtotime($date)) >= 6);
    }
}
