<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Proses_pengajuan_training_c extends CI_Controller {
    public function __construct(){
        parent:: __construct();
        $this->load->model('User_model');
        $this->load->model('Training_model');
        access_login();
    }

    public function index(){
        $data['status_data'] = json_decode($this->Training_model->status_data())->data;
        $jabatan = $_SESSION['jabatan'];
        $data['navbar_parent'] = $this->User_model->get_navbar_name($jabatan,'Parent')->result_array();
        $data['navbar_child'] = $this->User_model->get_child_name($jabatan,'Child')->result_array();
        $data['title_head'] = 'Proses Pengajuan Training';
        $this->load->view('Templates/Header_v',$data);
        $this->load->view('Templates/Navbar_v',$data);
        $this->load->view('Program_training/Proses_pengajuan_training_v',$data);
        $this->load->view('Templates/Footer_v');
    }

    public function detail_ppt(){
        $status_proses = 'REVIEW BY ADMIN';
        $no_md = $this->input->get('no_md');
        $get_data =  $this->Training_model->read_data(null,null,null,$no_md,$status_proses);
        // var_dump($get_data);die;
        $data['get_data'] =  json_decode($get_data)->data;
        // var_dump($data['get_data']);die;
        $jabatan = $_SESSION['jabatan'];
        $data['navbar_parent'] = $this->User_model->get_navbar_name($jabatan,'Parent')->result_array();
        $data['navbar_child'] = $this->User_model->get_child_name($jabatan,'Child')->result_array();
        $data['title_head'] = 'Proses Pengajuan Training';
        $this->load->view('Templates/Header_v',$data);
        $this->load->view('Templates/Navbar_v',$data);
        $this->load->view('Program_training/Input_ddt_db_v',$data);
        $this->load->view('Templates/Footer_v');
    }


    function view_data_query()
    {
        $status_proses = 'REVIEW BY ADMIN';
        $start = $this->input->post('start');
        $length = $this->input->post('length');
        $search = $this->input->post('search');
        $modal = $this->input->post('modal');
        $no_md = $this->input->post('no_md');
        $admin_hcmg = $this->input->post('staff_hcmg');
        // var_dump($admin_hcmg);

        if ($admin_hcmg) {
            $save_staff = $this->Training_model->save_staff($no_md,$admin_hcmg);
            // $msg = json_decode($save_staff);
            header('Content-Type: application/json');
            // echo $json_encode;
            echo $save_staff;
        }else{
            if($modal == 'modal'){
                // get data detail by no md
                $data_get =  $this->Training_model->read_data(null,null,null,$no_md,$status_proses);
                // var_dump($data_get);die;
                $status = json_decode($data_get)->status;
                if ($status === true) {
                    $data['datas'] = json_decode($data_get)->data;
                     //  get data staff hcmg
                    $get_staff = $this->Training_model->get_staff();
                   

                    $data['staff'] = json_decode($get_staff)->data;
                    // var_dump($data['staff']);

                    // get script tag html
                    $modal_html = $this->load->view('Modal/Modal_program_training',$data,TRUE);
                    echo json_encode(["status"=> $status , "modal"=>$modal_html]);

                }else{

                    echo json_encode(["status"=> $status , "msg"=>json_decode($data_get)->msg]);
                    //  json_decode($data_get)->msg;
                }

               
            }else{
                $json_encode =  $this->Training_model->read_data($start,$length,$search['value'],null,$status_proses); 
                header('Content-Type: application/json');
                echo $json_encode;
            }
        }
    }


    function detail_peserta(){
        $no_md = $this->input->post('no_md');
        $modal = $this->input->post('modal');
        $status = true;
        if ($modal == 'modal') {
            $data_peserta = $this->Training_model->peserta_train($no_md);
            $data['data_peserta'] = json_decode($data_peserta)->data;
            $data['training'] = $this->input->post('training');
            // var_dump(json_decode($data['data_peserta'])->data);
            $modal_html = $this->load->view('Modal/Modal_detail_peserta',$data,TRUE);

            echo json_encode(["status"=> $status , "modal"=>$modal_html]);
        }
    }
    


}