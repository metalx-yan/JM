<?php
// header('Access-Control-Allow-Origin: *');
defined('BASEPATH') OR exit('No direct script access allowed');

class MD_pengajuan_training_c extends CI_Controller {
    public function __construct(){
        parent:: __construct();
        $this->load->model('User_model');
        $this->load->model('Training_model');
        // $this->load->library('pagination');
        access_login();
    }

    public function index(){

        $jabatan = $_SESSION['jabatan'];
        $data['navbar_parent'] = $this->User_model->get_navbar_name($jabatan,'Parent')->result_array();
        $data['navbar_child'] = $this->User_model->get_child_name($jabatan,'Child')->result_array();
        // var_dump($data['navbar_child']);die;
        $data['title_head'] = 'MD Pengajuan Training';
        $this->load->view('Templates/Header_v',$data);
        $this->load->view('Templates/Navbar_v',$data);
        $this->load->view('Program_training/MD_pengajuan_training_v');
        $this->load->view('Templates/Footer_v');
    }

    // function view_data_query()
    // {
    //         $query = 	"SELECT
    //                         ts.id id_sort,
    //                         pv.pos_name,
    //                         ts.uker_id,
    //                         dp.name,
    //                         ts.qty_req,
    //                         ts.post_date,
    //                         ts.number_filled,
    //                         ts.date_filled,
    //                         dp.id as main_id,
    //                         ts.*,
    //                         tuk.*
    //                     FROM tb_sourcing ts
    //                     LEFT JOIN position_vacant pv ON pv.id = ts.pos_id
    //                     LEFT JOIN data_personal dp ON dp.id = ts.main_id
    //                     LEFT JOIN tb_unit_kerja tuk ON tuk.uker_code = ts.uker_id";
    //         $search = array('name','uker_desc', 'pos_name');
    //         $where  = null; 
    //         // $where  = array('nama_kategori' => 'Tutorial');
    //         // jika memakai IS NULL pada where sql
    //         $isWhere = null;
    //         // $isWhere = 'artikel.deleted_at IS NULL';
    //         header('Content-Type: application/json');
    //         echo $this->M_Datatables->get_tables_query($query,$search,$where,$isWhere);
    // }

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

    
}