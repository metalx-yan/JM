<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_Access_c extends CI_Controller {
    public function __construct(){
        parent:: __construct();
        $this->load->model('User_model');
        $this->load->model('M_Datatables');
        $this->load->model('training_parameter');
        $this->load->library('form_validation');
        $this->db_jobmanagement = $this->load->database('jobmanagement', TRUE);
        access_login();
        $this->id = 'user_name';
        $this->now = date_default_timezone_set('Asia/Jakarta'); # add your city to set local time zone
    }

    public function index(){
        $data['title_head'] = 'User Access';
        $jabatan = $_SESSION['jabatan'];
        $data['jabatan'] = $jabatan;
        $data['navbar_parent'] = navbar_perent($jabatan);
        $data['navbar_child'] = navbar_child($jabatan);
        $data['access_crud'] = access_crud($this->id);

        $this->load->view('Templates/Header_v',$data);
        $this->load->view('Templates/Navbar_v',$data);
        $this->load->view('Management/User_Access_v',$data);
        $this->load->view('Templates/Footer_v');
    }

    public function get(){
        $query = "SELECT distinct nama,user_name, CASE
        WHEN jabatan = 100 THEN 'Admin'
        WHEN jabatan = 101 THEN 'PUK Tertinggi'
        ELSE 'HCBP'
        END jabatan FROM jrms_user_access";

        $search = array('nama','user_name');

        $where = null;
        // $where  = array('nama_kategori' => 'Tutorial');
        // jika memakai IS NULL pada where sql
        $isWhere = null;
        // $isWhere = 'artikel.deleted_at IS NULL';
      
        header('Content-Type: application/json');
        echo $this->M_Datatables->get_tables_query_user_access($query,$search,$where,$isWhere);
    }

    public function modal(){
       
        $modal = $this->input->post('modal');
        $id = $this->input->post('id');
        $id_key = $this->input->post('id_key');
        $table_access = 'tb_user';
        $table_user_access = 'jrms_user_access';
        $data['list_user'] = $this->training_parameter->gets_user_access($table_access, 'user_name,nama')->result_array();
        $data['id_job'] = $this->training_parameter->where_user_access($id_key,$table_user_access, 'user_name')->row();
        $data['user_access'] = $this->training_parameter->gets_user_access($table_user_access, 'user_name')->result_array();
        
        $arr = [];
        foreach ($data['user_access'] as $value) {
            $arr[] = $value['user_name'];
        }
        $data['array_user_name'] = $arr;
        // var_dump($data['array_user_name']);die;

        if (is_null($data['id_job'])) {
        } else {
            if ($data['id_job']->jabatan == '100') {
                $data_access = 'Admin';
            } else if($data['id_job']->jabatan == '101'){
                $data_access = 'PUK Tertinggi';
            } else {
                $data_access = 'HCBP';
            }
            $data['access'] = $data_access;
        }
        
        $data['modal_title'] = $modal;
        $data['id'] = $id;
        $html_modal = $this->load->view('Modal/Modal_user_access',$data,TRUE);
        echo $html_modal;
    }

    function save_(){
        $table = 'jrms_user_access';
        $save = '';
      
        foreach($_POST as $key => $val){
            $data[$key] = $val;
        }
        $data_user = explode('-',$data['nama']);
        $data_insert = ['user_name' => $data_user[0],'nama' => $data_user[1],'jabatan' => $data['access']];
        // var_dump($data_insert);die;
        // cek kode 
        // $cek = $this->training_parameter->where_user_access($data_user[0],$table,$field)->num_rows();
        // if ($cek > 0) {
        //     $save = $this->training_parameter->update($data_user[0],$data,$table,$field);
        // }else{
        $save = $this->training_parameter->save_trms($data_insert,$table);
        // }
        
        if ($save == true) {
            $msg = 'Berhasil di Simpan';
        }else{
            $msg = 'Gagal Menyimpan';
        }

        echo $msg;
    }

    function edit_(){
        $table = 'jrms_user_access';
        $field = 'user_name';
   
        foreach($_POST as $key => $val){
            $data[$key] = $val;
        }
        
        $extract = explode('-',$data['nama']);
        
        $cek = $this->training_parameter->where_user_access($extract[0],$table,$field)->num_rows();
        
        $data_update = ['user_name' => $extract[0],'nama' => $extract[1],'jabatan' => $data['access']];

        // var_dump($data_update,$extract[1]);die;
        // Update
        $save = $this->training_parameter->update_user_access($extract[0],$data_update,$table,$field);

        if ($save == true) {
            $msg = 'Berhasil Update';
        }else{
            $msg = 'Gagal Menyimpan';
        }
        echo $msg;
      
    }

    function destroy_(){
        $table = 'jrms_user_access';
        $field = 'user_name';
   
        foreach($_POST as $key => $val){
            $data[$key] = $val;
        }
        
        // Update
        $save = $this->training_parameter->delete_trms($data['user_name'],$table,$field);

        if ($save == true) {
            $msg = 'Berhasil di Hapus';
        }else{
            $msg = 'Gagal Menyimpan';
        }
        echo $msg;
      
    }

    function validate(){
        $this->form_validation->set_error_delimiters('', '');
        foreach($_POST as $key => $val){
            if ($key == 'nama' || $key == 'access')  {
                $require = 'required';
             
            }else{
                $require = '';
            }
            $this->form_validation->set_rules($key,$key,$require);
        }
        if (!$this->form_validation->run()) {
            foreach($_POST as $key => $val){
                $json[$key] = form_error($key, '<span class="mt-3 text-danger">', '</span>');
            }
        }else{
            $json = array(
                'action' => 'ok',
            );
        }

        $this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($json));
    }

    function validate_keyup(){
        $this->form_validation->set_error_delimiters('', '');
        foreach($_POST as $key => $val){
            if ($key == $key) {
                if ($key == 'nama') {
                    $require = 'required';
                }else{
                    $require = 'required';
                }
                $this->form_validation->set_rules($key,$key,$require);
            }
        }

        $this->form_validation->set_message('required', 'You missed the input {field}!');
        // $this->form_validation->set_message('min_length', 'You input {field} kurang!');

        if (!$this->form_validation->run()) {
            foreach($_POST as $key => $val){
                if ($key == $key) {
                    $json[$key] = form_error($key, '<span class="mt-3 text-danger">', '</span>');
                }
            }
        }else{
            foreach($_POST as $key => $val){
                $json = array(
                    $key => '',
                );
            }
        }
        $this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($json));
    }
}

?>