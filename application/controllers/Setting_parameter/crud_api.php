<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class fasilitas_biaya_training_c extends CI_Controller {
    public function __construct(){
        parent:: __construct();
        $this->load->model('User_model');
        $this->load->model('M_Datatables');
        $this->load->model('training_parameter');
    }

    public function index(){
        $data['title_head'] = 'Fasilitas Biaya Training';
        $jabatan = $_SESSION['jabatan'];
        $data['navbar_parent'] = $this->User_model->get_navbar_name($jabatan,'Parent')->result_array();
        $data['navbar_child'] = $this->User_model->get_child_name($jabatan,'Child')->result_array();
        $data['list_menu'] = $this->db->get('menu')->result_array();

        $this->load->view('Templates/Header_v',$data);
        $this->load->view('Templates/Navbar_v',$data);
        $this->load->view('Setting_parameter/fasilitas_biaya_training_v',$data);
        $this->load->view('Templates/Footer_v');
    } 

    function view_data_query()
    {
        $kode_fasilitas = $this->input->post('kode_fasilitas');
        $start = $this->input->post('start');
        $length = $this->input->post('length');
        $search = $this->input->post('search');

        $json_encode =  $this->training_parameter->read_data($start,$length,$search['value'],null,null,null); 
        header('Content-Type: application/json');
        echo $json_encode;
    }

    function save_data(){
        $kode_fasilitas = $this->input->post('kode_fasilitas');
        $kode_lokasi = $this->input->post('kode_lokasi');
        $kode_cabang_peserta = $this->input->post('kode_cabang_peserta');

        $save_data = $this->training_parameter->save_data($kode_fasilitas,$kode_lokasi,$kode_cabang_peserta);
        // var_dump($save_data);die;
        redirect('Setting_parameter/fasilitas_biaya_training_c');
    }

    function modal_edit(){
        $array = $this->input->post('arry');
        $kode_fasilitas = $array[0];
        $kode_lokasi = $array[1];
        $kode_cabang_peserta = $array[2];

        $data_fbt = $this->training_parameter->read_data(null,null,null,$kode_fasilitas,$kode_lokasi,$kode_cabang_peserta);
        if (json_decode($data_fbt)->status == true) {
            $data['data_fbt'] = json_decode($data_fbt)->data;
            $modal_html = $this->load->view('Modal/Modal_fbt',$data,TRUE);
            echo $modal_html;
        }else{
            echo json_encode(json_decode($data_fbt)->msg);
        }
    }

    function update_data(){
        $kode_fasilitas = $array[0];
        $kode_lokasi = $array[1];
        $kode_cabang_peserta = $array[2];
        
    }

    
}